<?php

namespace tkouleris\CrudPanel\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use stdClass;

use tkouleris\CrudPanel\Services\ControllerService;
use tkouleris\CrudPanel\Services\MigrationService;
use tkouleris\CrudPanel\Services\ModelService;

class CP_indexController extends Controller
{
    protected $controller_service;
    protected $model_service;
    protected $migration_service;

    /**
     * CrudPanelController constructor.
     * @param ControllerService $controller_service
     * @param ModelService $model_service
     * @param MigrationService $migration_service
     */
    public function __construct(
        ControllerService $controller_service,
        ModelService $model_service,
        MigrationService $migration_service
    ){
        $this->controller_service = $controller_service;
        $this->model_service = $model_service;
        $this->migration_service = $migration_service;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $filter = new stdClass();
        $filter->limit = 10;
        $modelFiles = $this->model_service->list($filter);
        $migrationFiles = $this->migration_service->list($filter);
        $controllerFiles = $this->controller_service->list($filter);
        return view('CrudPanel::crud_panel_index',
            compact('modelFiles','migrationFiles','controllerFiles'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function create_model(Request $request)
    {
        $validation = $this->validate_create_model_request($request);
        if($validation['success'] = false)
        {
            $results['success'] = false;
            $results['message'] = $validation['message'];
            return $results;
        }

        $message = "";
        $model_creation_output = $this->model_service->create($request->model_name);
        $message .= $model_creation_output['message'];
        $model_id = $model_creation_output['data']->ModelFileId;

        if( $this->create_migration_is_selected($request))
        {
            $migration_creation_output = $this->migration_service->create($request->model_name,$model_id);
            $message .= $migration_creation_output['message'];
        }

        if( $this->create_controller_is_selected($request))
        {
            $output = $this->controller_service->create($request->model_name);
            $message .= $output['message'];
        }

        $results['success'] = true;
        $results['message'] = $message;
        return $results;
    }

    /**
     * @param $request
     * @return mixed
     */
    private function validate_create_model_request($request)
    {
        if(($request->model_name == null) || (!$request->has('model_name')) )
        {
            $results['success'] = false;
            $results['message'] = "No model name selected!";
            return $results;
        }

        if ($request->model_name == trim($request->model_name) && strpos($request->model_name, ' ') !== false) {
            $results['success'] = false;
            $results['message'] = "Model name must not contain spaces!";
            return $results;
        }

        $results['success'] = true;
        return $results;
    }

    /**
     * @param $request
     * @return bool
     */
    private function create_migration_is_selected($request)
    {
        if($request->create_migration == 1) return true;
        return false;
    }

    /**
     * @param $request
     * @return bool
     */
    private function create_controller_is_selected($request)
    {
        if( $request->create_controller == 1 ) return true;
        return false;
    }

}
