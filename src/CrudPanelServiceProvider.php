<?php

namespace tkouleris\CrudPanel;

use Carbon\Laravel\ServiceProvider;

class CrudPanelServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

    public function register()
    {


    }
}