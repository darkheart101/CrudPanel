<?php

namespace tkouleris\CrudPanel\File;

use Illuminate\Support\Facades\Artisan;

class FileCreator
{


    public function migration( $migration_name )
    {
        Artisan::call('make:migration '.$migration_name);
        $MigrationOutput = Artisan::output();
        $MigrationFile = trim(substr($MigrationOutput,19));

        $output['message'] = $MigrationOutput;
        $output['file'] = $MigrationFile;

        return $output;
    }

    public function controller( $controller_name)
    {
        Artisan::call('make:controller '.$controller_name);

        $output['message'] = Artisan::output();
        $output['file'] = $controller_name;

        return $output;
    }

    public function model( $model_name )
    {
        Artisan::call('make:model '.$model_name);
        $output['message'] = Artisan::output();
        $output['file'] = $model_name;

        return $output;
    }

}