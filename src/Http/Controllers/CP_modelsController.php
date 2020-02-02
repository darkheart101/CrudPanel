<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use tkouleris\CrudPanel\Services\ModelService;

class CP_modelsController extends Controller
{

    protected $model_service;

    public function __construct(ModelService $model_service)
    {
        $this->model_service = $model_service;
    }


    public function list()
    {
        $modelFiles = $this->model_service->list();
        return view('CrudPanel::crud_panel_models',compact('modelFiles'));
    }

    public function delete(Request $request)
    {
        return $this->model_service->delete($request->ModelFileId);
    }
}
