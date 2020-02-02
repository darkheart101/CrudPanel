<?php


namespace tkouleris\CrudPanel\File;


class FileDeleter
{
    protected $controllers_path;
    protected $models_path;

    /**
     * FileDeleter constructor.
     */
    public function __construct()
    {
        $this->controllers_path = app_path()."/Http/Controllers/";
        $this->models_path = app_path()."/";
    }


    public function controller($filename)
    {
        unlink($this->controllers_path.$filename.".php");
    }

    public function model($model_filename)
    {
        unlink($this->models_path.$model_filename.".php");
    }
}
