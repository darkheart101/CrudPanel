<?php


namespace tkouleris\CrudPanel\Repositories\Interfaces;


interface IControllerFile
{
    public function create($data);
    public function delete($ControllerFileId);
}
