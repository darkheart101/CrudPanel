<?php

namespace tkouleris\CrudPanel\Repositories\Interfaces;

interface ITableField
{
    public function create( $data );
    public function list( $filter = null);
    public function next_migration_file_available_line( $TableFieldMigrationId);
}
