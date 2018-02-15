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
});
