<?php
Route::group(['prefix' => 'manager-laravel'], function () {
    $controllers = 'Aqjw\ManagerLaravel\Controllers\\';

    Route::get('', $controllers . 'DashboardController@index')->name('managerl.home');
    Route::get('models', $controllers . 'ModelsController@index')->name('managerl.models');
    Route::get('models/{name}', $controllers . 'ModelsController@view')->name('managerl.models.view');
});
