<?php

// Dashboard routes
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::post('dashboard/destroy/{id}', 'DashboardController@destroy')->name('dashboard.destroy');
Route::post('dashboard/destroy-multiple', 'DashboardController@destroyMultiple')->name('dashboard.destroy.multiple');
Route::post('dashboard/destroy/image/{id}', 'DashboardController@destroyImage')->name('dashboard.destroy.image');
Route::post('dashboard/restore/{id}', 'DashboardController@restore')->name('dashboard.restore');

