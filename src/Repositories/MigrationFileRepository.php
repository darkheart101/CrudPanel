<?php

namespace tkouleris\CrudPanel\Repositories;

use tkouleris\CrudPanel\Repositories\Interfaces\IMigrationFile;
use tkouleris\CrudPanel\Models\MigrationFile;

class MigrationFileRepository implements IMigrationFile
{
    protected $model;

    public function __construct(MigrationFile $migrationFile)
    {
        $this->model = $migrationFile;
    }

    public function find_by_id($id)
    {
        return $this->model::where('MigrationFileId',$id)->first();
    }

    public function create( $data )
    {
        return $this->model::create( $data );
    }
}