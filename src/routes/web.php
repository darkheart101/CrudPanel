<?php

use Illuminate\Http\Request;

Route::group(['namespace'=>'tkouleris\CrudPanel\Http\Controllers','middleware' => 'web'], function(){
    Route::get('crudpanel', 'CrudPanelController@index');

    // models
    Route::post('crudpanel/model/create', 'CrudPanelController@create_model');

    // migrations
    Route::post('crudpanel/migration/create', 'CP_migrationController@create_migration');
    Route::get('crudpanel/migration/editor', 'CP_migrationController@migration_editor');

    // table fields
    Route::post('crudpanel/tablefields/create', 'CrudPanelController@create_table_field');
    Route::delete('crudpanel/tablefields/delete/{id}', 'CrudPanelController@delete_table_field');

    Route::get('crudpaneltest','CrudPanelController@testIndex');
    Route::get('crudpanel/models','CrudPanelController@modelsIndex');
});

