<?php

namespace tkouleris\CrudPanel\Repositories;


use tkouleris\CrudPanel\Models\TableField;
use tkouleris\CrudPanel\Repositories\Interfaces\ITableField;

class TableFieldRepository implements ITableField
{
    protected $model;


    /**
     * TableFieldRepository constructor.
     * @param TableField $tableField
     */
    public function __construct(TableField $tableField)
    {
        $this->model = $tableField;
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
     * @param null $filter
     * @return \Illuminate\Database\Eloquent\Collection|TableField[]
     */
    public function list($filter = null)
    {
        if( $filter == null) return $this->model::all();

        $query = $this->model;
        if(isset($filter->TableFieldMigrationId))
        {
            $query = $query->where('TableFieldMigrationId',$filter->TableFieldMigrationId);
        }

        return $query->get();
    }

    /**
     * @param $TableFieldMigrationId
     * @return int
     */
    public function next_migration_file_available_line($TableFieldMigrationId )
    {
        $max_line = $this->model::where('TableFieldMigrationId',$TableFieldMigrationId)
            ->max('TableFieldLineNumber');

        if( $max_line == null ) return 17;

        return $max_line + 1;
    }

    /**
     * @param $TableFieldId
     * @return mixed
     */
    public function delete($TableFieldId )
    {
        $table_field_record = $this->model::leftJoin('cp_migration_files','MigrationFileId','TableFieldMigrationId')
            ->where('TableFieldId', $TableFieldId)
            ->first();

        if( $table_field_record !== null ) $table_field_record->delete();

        return $table_field_record;
    }

}
