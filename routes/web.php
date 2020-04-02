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

Route::get('/new', function () {
    return view('layouts.main');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/labs', 'ChartController@labs')->name('labs');

Route::prefix('charts')->name('charts.')->group(function(){
	Route::get('daily_view', 'ChartController@daily_view')->name('daily_view');
	Route::get('map_data', 'ChartController@map_data')->name('map_data');
});

Route::get('/first', 'ChartController@index')->name('index');
Route::get('/test', 'ChartController@test')->name('test');
Route::get('/', 'ChartController@main')->name('main');


