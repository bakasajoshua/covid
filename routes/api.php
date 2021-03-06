<?php

use Illuminate\Http\Request;
use Dingo\Api\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['namespace' => 'App\\Api\\V1\\Controllers'], function(Router $api) {
        $api->group(['prefix' => 'auth'], function(Router $api) {
            // $api->post('signup', 'SignUpController@signUp');

            // $api->group(['middleware' => 'api.throttle', 'limit' => 1, 'expires' => 1], function(Router $api) {
                $api->post('login', 'LoginController@login');
            // });

            $api->post('recovery', 'ForgotPasswordController@sendResetEmail');
            $api->post('reset', 'ResetPasswordController@resetPassword');

            $api->post('logout', 'LogoutController@logout');
            $api->post('refresh', 'RefreshController@refresh');
            // $api->get('me', 'UserController@me');
        });

        $api->group(['middleware' => 'jwt.auth'], function(Router $api) {

            $api->get('verify/{id}', 'VerifySampleController@show');

            $api->group(['prefix' => 'covid_sample'], function(Router $api) {
                $api->get('cif', 'CovidSampleController@cif_samples');
                $api->post('cif', 'CovidSampleController@cif');
            });   
            $api->resource('covid_sample', 'CovidSampleController');            
            $api->resource('quarantine_site', 'QuarantineSiteController');

            $api->group(['prefix' => 'update'], function(Router $api) {

                $api->post('covid_samples', 'CovidSampleController@update_samples');
                $api->post('covid_patients', 'CovidSampleController@update_patients');
            });

            $api->group(['prefix' => 'insert'], function(Router $api) {
                $api->post('consumptions', 'ConsumptionsController@create');
                $api->post('covidconsumption', 'ConsumptionsController@create_covid');
            });
        });

        $api->group(['prefix' => 'covid'], function(Router $api) {
            $api->post('nhrl', 'CovidController@nhrl');

            $api->post('save_multiple', 'CovidController@save_multiple');
            $api->post('results/{id}', 'CovidController@results');
            $api->group(['middleware' => 'api.throttle', 'limit' => 250, 'expires' => 1], function(Router $api) {
                $api->post('search', 'CovidController@search');
            });
        });
        $api->resource('covid', 'CovidController');
        
        $api->group(['prefix' => 'test'], function(Router $api) {
            $api->group(['prefix' => 'covid'], function(Router $api) {
                $api->post('search', 'CovidController@search');
            });
            $api->resource('covid', 'CovidController');
        });
        
        $api->resource('credential_request', 'CredentialRequestController');

        $api->get('hello', function() {
            return response()->json([
                'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
            ]);
        });

        
    });
});
