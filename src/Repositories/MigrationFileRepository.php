<?php

namespace tkouleris\CrudPanel\Repositories;

use tkouleris\CrudPanel\Models\ModelFile;
use tkouleris\CrudPanel\Repositories\Interfaces\IMigrationFile;
use tkouleris\CrudPanel\Models\MigrationFile;

class MigrationFileRepository implements IMigrationFile
{
    protected $model;

    /**
     * MigrationFileRepository constructor.
     * @param MigrationFile $migrationFile
     */
    public function __construct(MigrationFile $migrationFile)
    {
        $this->model = $migrationFile;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find_by_id($id)
    {
        return $this->model::where('MigrationFileId',$id)->first();
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
    public function list( $filter )
    {
        $migration_collection = $this->model::all();

        if( isset($filter->limit) && ($filter->limit > 0))
        {
            $migration_collection = $migration_collection->take( $filter->limit);
        }

        return $migration_collection;
    }
}
