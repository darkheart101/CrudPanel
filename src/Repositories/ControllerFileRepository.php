<?php


namespace tkouleris\CrudPanel\Repositories;


use tkouleris\CrudPanel\Models\ControllerFile;
use tkouleris\CrudPanel\Repositories\Interfaces\IControllerFile;

class ControllerFileRepository implements IControllerFile
{

    protected $model;

    /**
     * ControllerFileRepository constructor.
     * @param $model
     */
    public function __construct(ControllerFile $model)
    {
        $this->model = $model;
    }


    public function create($data)
    {
        return $this->model::create( $data );
    }
}
