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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/points', 'PointController@index')->name('point_balance');
Route::get('/requests', 'PointController@requests')->name('point_requests');
Route::get('/send', 'PointController@send')->name('send_points');
Route::post('/send/{receiver}', 'PointController@store')->name('store_points');
Route::post('/accept/{tx_id}', 'PointController@accept')->name('accept');
