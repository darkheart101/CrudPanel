<?php

namespace tkouleris\CrudPanel\Repositories;


use tkouleris\CrudPanel\Models\TableField;
use tkouleris\CrudPanel\Repositories\Interfaces\ITableField;

class TableFieldRepository implements ITableField
{
    protected $model;


    public function __construct(TableField $tableField)
    {
        $this->model = $tableField;
    }

    public function create( $data )
    {
        return $this->model::create( $data );
    }

    public function list( $filter = null)
    {
        if( $filter == null) return $this->model::all();

        $query = $this->model;
        if(isset($filter->TableFieldMigrationId))
        {
            $query = $query->where('TableFieldMigrationId',$filter->TableFieldMigrationId);
        }

        return $query->get();
    }

}