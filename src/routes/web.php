<?php

use Illuminate\Http\Request;

Route::group(['namespace'=>'tkouleris\CrudPanel\Http\Controllers','middleware' => 'web'], function(){

    Route::get('crudpanel', 'CrudPanelController@index');

    // models
    Route::post('crudpanel/model/create', 'CrudPanelController@create_model'); // Must go to models controller
    Route::get('crudpanel/model/list','CP_modelsController@list');

    // migrations
    Route::post('crudpanel/migration/create', 'CP_migrationController@create_migration');
    Route::get('crudpanel/migration/editor', 'CP_migrationController@migration_editor');

    // controllers
    Route::get('crudpanel/controller/list','CP_ControllersController@list');

    // table fields
    Route::post('crudpanel/tablefields/create', 'CrudPanelController@create_table_field');
    Route::delete('crudpanel/tablefields/delete/{id}', 'CrudPanelController@delete_table_field');

    Route::get('crudpaneltest','CrudPanelController@testIndex');
    Route::get('crudpanel/models','CrudPanelController@modelsIndex');
});

