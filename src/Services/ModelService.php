<?php


namespace tkouleris\CrudPanel\Services;


use tkouleris\CrudPanel\File\FileCreator;
use tkouleris\CrudPanel\File\FileDeleter;
use tkouleris\CrudPanel\Repositories\Interfaces\IModelFile;

class ModelService
{
    protected $R_model_file;
    protected $file_creator;
    protected $file_deleter;

    /**
     * ModelService constructor.
     * @param IModelFile $R_model_file
     * @param FileCreator $file_creator
     * @param FileDeleter $file_deleter
     */
    public function __construct(IModelFile $R_model_file, FileCreator $file_creator, FileDeleter $file_deleter)
    {
        $this->R_model_file = $R_model_file;
        $this->file_creator = $file_creator;
        $this->file_deleter = $file_deleter;
    }


    public function create($model_name)
    {
        $model = $this->R_model_file->find_by_filename($model_name);
        if( $model != null)
        {
            $output['message'] = "model exists";
            return $output;
        }
        $data = [
            'ModelFileName' =>$model_name
        ];
        $model_record = $this->R_model_file->create($data);
        $fc_output = $this->file_creator->model($model_name);

        $output['message'] = $fc_output['message'];
        $output['file'] = $fc_output['file'];
        $output['data'] = $model_record;
        return $output;
    }

    public function list($filter = null)
    {
        return $this->R_model_file->list($filter);
    }

    public function delete($ModelFileId)
    {
        $ModelFileRecord = $this->R_model_file->delete($ModelFileId);
        $this->file_deleter->model($ModelFileRecord->ModelFileName);
        return $ModelFileRecord;
    }
}
