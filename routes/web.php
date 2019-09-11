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
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('confirm-register', 'Auth\RegisterController@confirmRegister')->name('confirm.register');
Route::post('save-register', 'Auth\RegisterController@register')->name('save.register');

Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');

//Other page routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('/save', 'HomeController@create');
Route::post('/store', 'BoardController@store')->name('store');
Route::post('/delete/{id}', 'BoardController@delete')->name('delete');
Route::get('/destroy/{id}', 'BoardController@destroy')->name('destroy');
Route::post('/edit/{id}', 'BoardController@edit')->name('edit');
Route::post('/update/{id}', 'BoardController@update')->name('update');
