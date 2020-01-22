<?php

namespace tkouleris\CrudPanel\Repositories;

use tkouleris\CrudPanel\Repositories\Interfaces\IModelFile;
use tkouleris\CrudPanel\Models\ModelFile;

class ModelFileRepository implements IModelFile
{
    protected $model;


    /**
     * ModelFileRepository constructor.
     * @param ModelFile $modelfile
     */
    public function __construct(ModelFile $modelfile)
    {
        $this->model = $modelfile;
    }


    /**
     * @param $filename
     * @return mixed
     */
    public function find_by_filename($filename)
    {
        return $this->model::where('ModelFileName',$filename)->first();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data )
    {
        return $this->model::create( $data );
    }


    /**
     * @param $filter
     * @return \Illuminate\Database\Eloquent\Collection|ModelFile[]
     */
    public function list($filter = null )
    {
        $model_collection = $this->model::all();

        if( isset($filter->limit) && ($filter->limit > 0))
        {
            $model_collection = $model_collection->take( $filter->limit);
        }

        return $model_collection;
    }

}
