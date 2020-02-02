<?php

use Illuminate\Http\Request;

Route::group(['namespace'=>'tkouleris\CrudPanel\Http\Controllers','middleware' => 'web'], function(){

    Route::get('crudpanel', 'CP_indexController@index');

    // models
    Route::post('crudpanel/model/create', 'CP_indexController@create_model'); // Must go to models controller
    Route::get('crudpanel/model/list','CP_modelsController@list');
    Route::post('crudpanel/model/delete','CP_modelsController@delete');

    // migrations
    Route::post('crudpanel/migration/create', 'CP_migrationController@create_migration');
    Route::get('crudpanel/migration/editor', 'CP_migrationController@migration_editor');
    Route::get('crudpanel/migration/list', 'CP_migrationController@list');
    Route::post('crudpanel/migration/delete', 'CP_migrationController@delete');


    // controllers
    Route::get('crudpanel/controller/list','CP_controllersController@list');
    Route::post('crudpanel/controller/create','CP_controllersController@create');
    Route::post('crudpanel/controller/delete','CP_controllersController@delete');

    // table fields
    Route::post('crudpanel/tablefields/create', 'CP_migrationController@create_table_field');
    Route::delete('crudpanel/tablefields/delete/{id}', 'CP_migrationController@delete_table_field');
});

