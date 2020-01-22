<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use tkouleris\CrudPanel\Repositories\Interfaces\IModelFile;

class CP_modelsController extends Controller
{

    protected $r_model_file;

    public function __construct(IModelFile $r_model_file)
    {
        $this->r_model_file = $r_model_file;
    }


    public function list()
    {
        $modelFiles = $this->r_model_file->list();


        return view('CrudPanel::crud_panel_models',compact('modelFiles'));
    }
}
