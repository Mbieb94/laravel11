<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resources;
use Exception;
use Illuminate\Support\Str;
use App\Http\Response\ApiResponse;
use App\Library\Component;
use Illuminate\Http\Request;

class AppController extends Controller
{
    private $model;
    protected $reference;
    protected $forms;
    protected $segment;
    protected $response;

    public function __construct(Request $request, Resources $model, ApiResponse $response)
    {
        try {
            $this->segment = $request->segment(3);
            if (file_exists(app_path('Models/' . Str::studly($this->segment)) . '.php')) {
                $this->model = app("App\Models\\" . Str::studly($this->segment));
            } else {
                if ($model->checkTableExists($this->segment)) {
                    $this->model = $model;
                    $this->model->setTable($this->segment);
                }
            }

            $this->reference = $this->model->getReference();
            $this->forms = $this->model->getForms();
            $this->response = $response;
        } catch (Exception $e) { 
            return $response->message($e->getMessage())->send();
        }
    }

    public function fetchDataTable (Request $request)
    {
        try {
            $reference = $this->reference;
            $offset = $request->get('start') ? $request->get('start') : 0;
            $limit = $request->get('length') ? $request->get('length') : 10;
            $search = $request->get('search');
            $orderBy = $request->get('order');
            $params = $request->get('params');
            $status = $request->get('status');
            
            $model = $this->model;
            $fields = $model->getFields();

            $forms = ['id'];
            foreach ($this->forms as $items) {
                if ($items['display']) $forms[] = $items['name'];
            }
            
            if ($status == 2) $model = $model->onlyTrashed();

            if (count($reference) > 0) $model = $model->with($reference);
            
            $model = $this->getSearch($model, $fields, $search);
            $model = $this->advanceSearch($model, $params);

            $total = $model->count();
            $order = 'desc';
            if ($orderBy[0]['column']) {
                $order = $orderBy[0]['dir'];
            }

            $model = $model->orderBy($forms[$orderBy[0]['column']], $order);
            $model = $model->offset($offset);
            $model = $model->limit($limit);
            $model = $model->get();

            $forms = [];
            foreach ($this->forms as $items) {
                $forms[$items['name']]['name'] = $items['type'];
                if(in_array($items['type'], ['select2', 'multiselect2'])) 
                    $forms[$items['name']]['options'] = $items['options'];
            }
            $dataTable = [];
            foreach ($model->toArray() as $key => $items) {
                foreach ($items as $q => $value) {
                    $data = $value;
                    if (isset($forms[$q]['name'])) {
                        $func = ucfirst($forms[$q]['name']);
                        $data = Component::$func($value, $forms[$q]);
                    }
                    $dataTable[$key][$q] = $data;
                }
            }

            $draw = 1;
            if (!empty($request->get('draw'))) $draw = $request->get('draw');

            $data = [
                'draw' => $draw,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $dataTable
            ];
            
            // return $this->response->data($data)->send();
            return response($data);
        } catch (Exception $e) {
            return $this->response->message($e->getMessage())->send();
        }
    }

    public function getSearch ($model, $fields, $search) {
        if (empty($search)) return $model;

        return $model->whereAny($fields, 'LIKE', $search . '%');
    }

    public function advanceSearch($model, $params) {
        if(empty($params)) return $model;
        foreach ($params as $key => $item) {
            if (empty($item['value'])) continue;
            $operator = explode('!', $item['name']);

            if(count($operator) <= 1) {
                $model = $model->where($item['name'], $item['value']);
                continue;
            }

            switch ($operator[1]) {
                case 'in':
                    $model = $model->whereIn($operator[0], json_decode($item['value'], true));
                    break;
                
                default:
                    $model = $model->where($operator[0], $item['value']);
                    break;
            }
        }

        return $model;
    }
}
