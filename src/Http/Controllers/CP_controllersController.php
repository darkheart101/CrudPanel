<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use tkouleris\CrudPanel\File\FileCreator;
use tkouleris\CrudPanel\Repositories\Interfaces\IControllerFile;

class CP_controllersController extends Controller
{
    protected $r_controller_file;

    public function __construct(IControllerFile $r_controller_file)
    {
        $this->r_controller_file = $r_controller_file;
    }

    public function create(Request $request, FileCreator $file_creator)
    {
        $controller_name = $request->ControllerName.'Controller';
        $controller_output = $file_creator->controller( $controller_name );
        $message = $controller_output['message'];

        $ins_controller_args = array();
        $ins_controller_args['ControllerFileFilename'] = $controller_name;
        return $this->r_controller_file->create($ins_controller_args);
    }

    public function list()
    {
        $controllerFiles = $this->r_controller_file->list();
        return view('CrudPanel::crud_panel_controllers',compact('controllerFiles'));
    }

    public function delete(Request $request)
    {
        $ControllerFileRecord = $this->r_controller_file->delete($request->ControllerFileId);
        unlink(app_path()."/Http/Controllers/".$ControllerFileRecord->ControllerFileFilename.".php");
        return $ControllerFileRecord;
    }
}
