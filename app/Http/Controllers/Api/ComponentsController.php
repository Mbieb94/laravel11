<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Response\ApiResponse;
use App\Models\Parameters;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComponentsController extends Controller
{
    protected $response;
    public function __construct (Request $request, ApiResponse $response)
    {
        $this->response = $response;
    }

    public function select2refence (Request $request)
    {
        $tableName = $request->model;
        $key = $request->key;
        $display = $request->display;

        $displayExplode = explode('|', $display);
        $concat = implode(", ' - ', ", $displayExplode);
        $orderBy = "tb." . $displayExplode[0];

        try {
            $query = "SELECT $key AS id, CONCAT($concat) AS 'text' FROM $tableName AS tb WHERE tb.deleted_at IS NULL ORDER BY $orderBy ASC";
            $result = DB::select($query);

            return $this->response->data($result)->send();
        } catch (Exception $e) {
            return $this->response
                ->status(500)
                ->message('Error: '.$e->getMessage())
                ->send();
        }
    }

    public function sysparamReference (Request $request)
    {
        $group = $request->group;
        try {
            $result = Parameters::where('groups', $group)->get(['key', 'value']);
         
            return $this->response->data($result)->send();
        } catch (Exception $e) {
            return $this->response
                ->status(500)
                ->message('Error: '.$e->getMessage())
                ->send();
        }
    }
}
