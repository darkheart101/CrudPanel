<?php

namespace tkouleris\CrudPanel;

use Carbon\Laravel\ServiceProvider;

class CrudPanelServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views','CrudPanel');
    }

    public function register()
    {


    }
}