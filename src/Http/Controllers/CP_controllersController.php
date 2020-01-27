<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use tkouleris\CrudPanel\Repositories\Interfaces\IControllerFile;

class CP_controllersController extends Controller
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

    public function delete(Request $request)
    {
        $ControllerFileRecord = $this->r_controller_file->delete($request->ControllerFileId);
        unlink(app_path()."/Http/Controllers/".$ControllerFileRecord->ControllerFileFilename.".php");
        return $ControllerFileRecord;
    }
}
