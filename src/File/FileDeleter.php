<?php


namespace tkouleris\CrudPanel\File;


class FileDeleter
{
    protected $controllers_path;

    /**
     * FileDeleter constructor.
     * @param $controllers_path
     */
    public function __construct()
    {
        $this->controllers_path = app_path()."/Http/Controllers/";
    }


    public function controller($filename)
    {
        unlink($this->controllers_path.$filename.".php");
    }
}
