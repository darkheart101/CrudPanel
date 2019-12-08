<?php

use Illuminate\Http\Request;

Route::group(['namespace'=>'tkouleris\CrudPanel\Http\Controllers'], function(){
    Route::get('crudpanel', 'CrudPanelController@index');

    Route::post('model/create', 'CrudPanelController@create_model');

    Route::get('crudpaneltest','CrudPanelController@testIndex');
    Route::get('crudpanel/models','CrudPanelController@modelsIndex');
});

