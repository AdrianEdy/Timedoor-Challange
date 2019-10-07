<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register/confirm', 'Auth\RegisterController@confirmRegister')->name('confirm.register');
Route::post('register/save', 'Auth\RegisterController@register')->name('save.register');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

// Home page routes
Route::get('', 'BoardController@index')->name('home');
Route::post('store', 'BoardController@store')->name('store');
Route::post('delete/{id}', 'BoardController@delete')->name('delete');
Route::post('destroy/{id}', 'BoardController@destroy')->name('destroy');
Route::post('edit/{id}', 'BoardController@edit')->name('edit');
Route::post('update/{id}', 'BoardController@update')->name('update');

// Dashboard routes
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::post('dashboard/destroy/{id}', 'DashboardController@destroy')->name('dashboard.destroy');
Route::post('dashboard/destroy/multiple', 'DashboardController@destroyMultiple')->name('dashboard.destroy.multiple');
Route::post('dashboard/destroy/image/{id}', 'DashboardController@destroyImage')->name('dashboard.destroy.image');

