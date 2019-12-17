<?php

namespace tkouleris\CrudPanel;

use Carbon\Laravel\ServiceProvider;
use tkouleris\CrudPanel\Repositories\Interfaces\IMigrationFile;
use tkouleris\CrudPanel\Repositories\Interfaces\IModelFile;
use tkouleris\CrudPanel\Repositories\MigrationFileRepository;
use tkouleris\CrudPanel\Repositories\ModelFileRepository;

class CrudPanelServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views','CrudPanel');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->publishes([
            __DIR__.'public' => public_path('vendor/CrudPanel/public'),
        ], 'tkouleris_public');
    }

    public function register()
    {

        $this->app->bind(IMigrationFile::class, MigrationFileRepository::class);
        $this->app->bind(IModelFile::class, ModelFileRepository::class);
    }
}