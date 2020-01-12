<?php


namespace tkouleris\CrudPanel\Repositories\Interfaces;


interface IMigration
{
    public function find_by_filename( $filename );
}
