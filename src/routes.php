<?php
Route::group(['prefix' => 'manager-laravel', 'namespace' => 'Aqjw\ManagerLaravel\Controllers'], function () {
    Route::get('', 'DashboardController@index')->name('managerl.home');
    Route::get('models', 'ModelsController@index')->name('managerl.models');
    Route::get('models/{name}', 'ModelsController@view')->name('managerl.models.view');
});
