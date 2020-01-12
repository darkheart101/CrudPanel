<?php

namespace tkouleris\CrudPanel\Repositories;

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
}
