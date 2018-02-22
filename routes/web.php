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

    Route::prefix('database')->group(function () {
        Route::get('status', 'DatabaseController@serverStatus')->name('mysqladminStatus');
        Route::get('logs', 'DatabaseController@logs')->name('logs');
        Route::get('variables', 'DatabaseController@serverVariables')->name('mysqladminVariables');
        Route::get('process', 'DatabaseController@serverProcessList')->name('mysqladminProcessList');
        Route::get('/', 'DatabaseController@index')->name('database');

        Route::prefix('maintenance')->group(function () {
            Route::get('check/quick', 'DatabaseController@checkQuick')->name('maintenanceCheckQuick');
            Route::get('check/extended', 'DatabaseController@checkExtended')->name('maintenanceCheckExtended');
            Route::get('analyze', 'DatabaseController@analyze')->name('maintenanceAnalyze');
            Route::get('repair', 'DatabaseController@repair')->name('maintenanceRepair');
            Route::get('optimize', 'DatabaseController@optimize')->name('maintenanceOptimize');
        });
    });
});
