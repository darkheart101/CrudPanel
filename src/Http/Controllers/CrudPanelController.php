<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class CrudPanelController extends Controller
{
    public function index()
    {
        return view('CrudPanel::crud_panel_index');
    }

    public function create_model(Request $request)
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

        Artisan::call('make:model '.$request->model_name);
        $message = Artisan::output();

        $results['success'] = true;
        $results['message'] = $message;
        return $results;
    }
}
