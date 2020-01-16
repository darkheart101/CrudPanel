<?php


namespace tkouleris\CrudPanel\Repositories;


use tkouleris\CrudPanel\Models\Migration;
use tkouleris\CrudPanel\Models\ModelFile;
use tkouleris\CrudPanel\Repositories\Interfaces\IMigration;

class MigrationRepository implements IMigration
{

    protected $model;

    public function __construct( Migration $migration)
    {
        $this->model = $migration;
    }

    public function find_by_filename($filename)
    {
        return $this->model::where( 'migration', $filename)->first();
    }

}
