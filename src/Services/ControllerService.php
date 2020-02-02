<?php


namespace tkouleris\CrudPanel\Services;


use tkouleris\CrudPanel\File\FileCreator;
use tkouleris\CrudPanel\File\FileDeleter;
use tkouleris\CrudPanel\Repositories\Interfaces\IControllerFile;

class ControllerService
{
    protected $file_creator;
    protected $R_ControllerFile;
    protected $file_deleter;

    /**
     * ControllerService constructor.
     * @param FileCreator $file_creator
     * @param FileDeleter $file_deleter
     * @param IControllerFile $R_ControllerFile
     */
    public function __construct(FileCreator $file_creator, FileDeleter $file_deleter, IControllerFile $R_ControllerFile)
    {
        $this->file_creator = $file_creator;
        $this->file_deleter = $file_deleter;
        $this->R_ControllerFile = $R_ControllerFile;
    }


    /** creates a controller
     * @param $controller_name
     * @return array
     */
    public function create($controller_name)
    {
        $controller_name = $controller_name.'Controller';
        $controller_output = $this->file_creator->controller( $controller_name );
        $message = $controller_output['message'];

        $ins_controller_args = array();
        $ins_controller_args['ControllerFileFilename'] = $controller_name;
        $controller_record = $this->R_ControllerFile->create($ins_controller_args);

        $output = array();
        $output["message"] = $message;
        $output["data"] = $controller_record;
        return $output;
    }

    public function list()
    {
        return $controllerFiles = $this->R_ControllerFile->list();
    }


    /**
     * Deletes a controller
     * @param $controller_file_id
     * @return mixed
     */
    public function delete($controller_file_id)
    {
        $ControllerFileRecord = $this->R_ControllerFile->delete($controller_file_id);
        $this->file_deleter->controller($ControllerFileRecord->ControllerFileFilename);
        return $ControllerFileRecord;
    }
}
