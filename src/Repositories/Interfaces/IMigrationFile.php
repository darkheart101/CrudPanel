<?php

namespace tkouleris\CrudPanel\Repositories\Interfaces;

interface IMigrationFile
{
    public function find_by_id( $id );
    public function create( $data );
    public function list( $filter );
}
