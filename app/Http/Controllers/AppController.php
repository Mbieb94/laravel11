<?php

namespace App\Http\Controllers;

use App\Models\Resources;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Http\Request;

class AppController extends Controller
{
    protected $view;
    protected $model = null;
    protected $segment = null;
    protected $table_name = null;
    protected $segmentName;
    protected $forms;
    protected $reference;
    
    public function __construct (Request $request, Resources $model)
    {
        try {
            $this->segment = $request->segment(1);
            if (file_exists(app_path('Models/' . Str::studly($this->segment)) . '.php')) {
                $this->model = app("App\Models\\" . Str::studly($this->segment));
            } else {
                if ($model->checkTableExists($this->segment)) {
                    $this->model = $model;
                    $this->model->setTable($this->segment);
                }
            }

            if (!$this->model) abort(404);

            $this->view = 'admin.' . $this->segment;
            $this->table_name = $this->segment;
            $this->segmentName = Str::studly($this->segment);
            $this->forms = $this->model->getForms();
            $this->reference = $this->model->getReference();
        } catch (Exception $e) {
            abort(500);
        }
    }
}

