<?php

namespace tkouleris\CrudPanel\Repositories\Interfaces;

interface IModelFile
{
    public function find_by_filename( $filename );
    public function create( $data );
    public function list( $filter );
    public function delete( $ModelFileId );
}
