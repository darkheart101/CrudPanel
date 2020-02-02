<?php


namespace tkouleris\CrudPanel\File;


class FileDeleter
{
    protected $controllers_path;
    protected $models_path;
    protected $migrations_path;
    /**
     * FileDeleter constructor.
     */
    public function __construct()
    {
        $this->controllers_path = app_path()."/Http/Controllers/";
        $this->models_path = app_path()."/";
        $this->migrations_path = database_path()."/migrations/";
    }


    public function controller($filename)
    {
        unlink($this->controllers_path.$filename.".php");
    }

    public function model($model_filename)
    {
        unlink($this->models_path.$model_filename.".php");
    }

    public function migration($migration_filename)
    {
        unlink(database_path()."/migrations/".$migration_filename.".php");
    }
}
