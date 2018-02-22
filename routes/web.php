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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('accounts', 'AccountController');
    Route::resource('users', 'UserController');
    Route::resource('ads', 'AdController');
    Route::resource('autotasks', 'AutoTaskController');
    Route::resource('diseases', 'DiseaseController');
    Route::resource('indicators', 'IndicatorController');
    Route::resource('infrastructures', 'InfrastructureController');
    Route::resource('items', 'ItemController');
    Route::resource('horses', 'HorseController');
    Route::resource('atts', 'AttsController');
    Route::resource('news', 'NewsController');
    Route::get('/database/inspect', function () {
        return json_encode(shell_exec('../database/maintenance.sh inspect'));
    });
    Route::get('/database', 'DatabaseController@index')->name('database');
    Route::get('/logs', 'DatabaseController@logs');
});
