<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use tkouleris\CrudPanel\Models\ModelFile;

class CrudPanelController extends Controller
{
    // View Controllers
    public function index()
    {
        return view('CrudPanel::crud_panel_index');
    }

    public function modelsIndex()
    {
        return view('CrudPanel::crud_panel_models');
    }

    // Other Requests
    public function create_model(Request $request, ModelFile $mf)
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

        $model = $mf::where('ModelFileName',$request->model_name)->first();

        if( $model == null)
        {
            $data = [
                'ModelFileName' =>$request->model_name
            ];
            $record = $mf::create($data);
            dd($record);
        }


        $results['success'] = true;
        $results['message'] = $message;
        return $results;
    }
}
