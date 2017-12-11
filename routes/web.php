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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::match(['get', 'post'], '/lich-su-nhan-dien', ['as' => 'history', 'uses' => 'ManagerController@history']);
    Route::match(['get', 'post'], '/lich-su-nhan-dien/action', ['as' => 'history.action', 'uses' => 'ManagerController@history_action']);
    Route::match(['get', 'post'], '/khong-nhan-dien', ['as' => 'unknown', 'uses' => 'ManagerController@unknown']);
    Route::match(['get', 'post'], '/khong-nhan-dien/action', ['as' => 'unknown.action', 'uses' => 'ManagerController@unknown_action']);
    Route::match(['get', 'post'], '/camera', ['as' => 'camera', 'uses' => 'ManagerController@camera']);

});
