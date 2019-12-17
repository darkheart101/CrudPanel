<?php

namespace tkouleris\CrudPanel\Repositories;

use tkouleris\CrudPanel\Repositories\Interfaces\IModelFile;
use tkouleris\CrudPanel\Models\ModelFile;

class ModelFileRepository implements IModelFile
{
    protected $model;


    public function __construct(ModelFile $modelfile)
    {
        $this->model = $modelfile;
    }


    public function find_by_filename($filename)
    {
        return $this->model::where('ModelFileName',$filename)->first();
    }

    public function create( $data )
    {
        return $this->model::create( $data );
    }

    public function list( $filter )
    {
        $model_collection = $this->model::all();

        if( isset($filter->limit) && ($filter->limit > 0))
        {
            $model_collection = $model_collection->take( $filter->limit);
        }

        return $model_collection;
    }

}