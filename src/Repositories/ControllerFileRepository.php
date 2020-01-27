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


    /**
     * @param $filter
     * @return \Illuminate\Database\Eloquent\Collection|ControllerFile[]
     */
    public function list($filter = null)
    {
        $controller_collection = $this->model::all();

        if( isset($filter->limit) && ($filter->limit > 0))
        {
            $controller_collection = $controller_collection->take( $filter->limit);
        }

        return $controller_collection;
    }

    public function delete($ControllerFileId)
    {
        $ControllerFileRecord = $this->model::where('ControllerFileId',$ControllerFileId)->first();
        if($ControllerFileRecord == null) return null;
        $ControllerFileRecord->delete();

        return $ControllerFileRecord;
    }
}
