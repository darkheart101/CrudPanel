<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use tkouleris\CrudPanel\Services\ControllerService;

class CP_controllersController extends Controller
{
    protected $controller_service;

    public function __construct(ControllerService $controller_service)
    {
        $this->controller_service = $controller_service;
    }

    public function create(Request $request)
    {
        $controller_name = $request->ControllerName;
        $this->controller_service->create($controller_name);
    }

    public function list()
    {
        $controllerFiles = $this->controller_service->list();
        return view('CrudPanel::crud_panel_controllers',compact('controllerFiles'));
    }

    public function delete(Request $request)
    {
        return $this->controller_service->delete($request->ControllerFileId);
    }
}
