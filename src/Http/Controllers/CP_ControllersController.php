<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use tkouleris\CrudPanel\Repositories\Interfaces\IControllerFile;

class CP_ControllersController extends Controller
{
    protected $r_controller_file;

    public function __construct(IControllerFile $r_controller_file)
    {
        $this->r_controller_file = $r_controller_file;
    }


    public function list()
    {

        $controllerFiles = $this->r_controller_file->list();


        return view('CrudPanel::crud_panel_controllers',compact('controllerFiles'));
    }
}
