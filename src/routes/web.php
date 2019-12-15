<?php

use Illuminate\Http\Request;

Route::group(['namespace'=>'tkouleris\CrudPanel\Http\Controllers','middleware' => 'web'], function(){
    Route::get('crudpanel', 'CrudPanelController@index');

    Route::post('crudpanel/model/create', 'CrudPanelController@create_model');

    Route::post('crudpanel/migration/create', 'CrudPanelController@create_migration');
    Route::get('crudpanel/migration/editor', 'CrudPanelController@migration_editor');

    Route::get('crudpaneltest','CrudPanelController@testIndex');
    Route::get('crudpanel/models','CrudPanelController@modelsIndex');
});

