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

/*Route::get('/new', function () {
    return view('layouts.main');
});*/

Auth::routes();
Route::middleware(['cors'])->group(function(){
	Route::get('/dash_labs', 'ChartsController@dashboard_labs')->name('dashboard_labs');
});
// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', 'ChartController@main')->name('main');
Route::middleware(['auth'])->group(function(){

	Route::get('/first', 'ChartController@index')->name('index');
	Route::get('/test', 'ChartsController@test')->name('test');

	Route::middleware(['only_utype:1,2,3'])->group(function(){
		Route::get('/', 'ChartsController@homepage')->name('homepage');

		Route::get('/labs', 'ChartsController@labs')->name('labs');
	});

	Route::prefix('charts')->name('charts.')->group(function(){
		Route::get('daily_view', 'ChartsController@daily_view')->name('daily_view');
		Route::get('county_chart', 'ChartsController@county_chart')->name('county_chart');
		Route::get('gender_pie', 'ChartsController@gender_pie')->name('gender_pie');
		Route::get('pyramid', 'ChartsController@pyramid')->name('pyramid');
		Route::get('outcomes', 'ChartsController@outcomes')->name('outcomes');
		Route::get('map_data', 'ChartsController@map_data')->name('map_data');
	});

	Route::middleware(['only_utype:2'])->group(function(){
		Route::get('covid_sample/index/{param}', 'CovidSampleController@index');
		Route::resource('covid_sample', 'CovidSampleController');
	});

	Route::middleware(['only_utype:1'])->group(function(){
		Route::resource('organisation', 'OrganisationController');
		Route::get('nphl', 'MiscController@nphl_download');
	});

	Route::middleware(['only_utype:3'])->group(function(){
		Route::prefix('kits')->name('covidconsumption')->group(function(){
			Route::get('/', 'CovidConsumptionController@index');
			Route::post('consumption', 'CovidConsumptionController@submitConsumption');
			Route::get('report/{consumption?}', 'CovidConsumptionController@report');
		});
	});

	Route::middleware(['only_utype:4'])->group(function(){
		Route::resource('user', 'UserController');
	});

});

Route::get('verify', 'VerifyController@index');
Route::post('verify', 'VerifyController@qrcode');

