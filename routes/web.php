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

Route::get('/get_users', ['as' => 'get_users', 'uses' => 'UsersController@get_users']);
Route::match(['get', 'post'],'/insert_history', ['as' => 'insert_history', 'uses' => 'ManagerController@insert_history']);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::match(['get', 'post'], '/lich-su-nhan-dien', ['as' => 'history', 'uses' => 'ManagerController@history']);
    Route::match(['get', 'post'], '/lich-su-nhan-dien/action', ['as' => 'history.action', 'uses' => 'ManagerController@history_action']);
    Route::match(['get', 'post'], '/khong-nhan-dien', ['as' => 'unknown', 'uses' => 'ManagerController@unknown']);
    Route::match(['get', 'post'], '/khong-nhan-dien/action', ['as' => 'unknown.action', 'uses' => 'ManagerController@unknown_action']);
    Route::match(['get', 'post'], '/camera', ['as' => 'camera', 'uses' => 'ManagerController@camera']);
    Route::match(['get', 'post'], '/camera/{id}', ['as' => 'camera_detail', 'uses' => 'ManagerController@camera_detail']);
    Route::match(['get', 'post'], '/cham-cong', ['as' => 'chamcong', 'uses' => 'ManagerController@leave']);
    Route::match(['get', 'post'], '/huan-luyen-lai', ['as' => 'retrain', 'uses' => 'ManagerController@retrain']);
    Route::get('/camera-train', ['as' => 'camera_train', 'uses' => 'ManagerController@camera_train']);
});
