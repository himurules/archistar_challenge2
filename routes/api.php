<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')
    ->get(
        '/user',
        function (Request $request) {
            return $request->user();
        }
    );

Route::group(
    ['middleware' => 'auth:api'],
    function () {
        Route::post(
            'properties',
            'PropertiesController@store'
        );
        Route::post(
            'properties/analytic',
            'PropertiesController@updateAnalytic'
        );
        Route::get(
            'properties',
            'PropertiesController@index'
        );
        Route::get(
            'properties/{properties}',
            'PropertiesController@show'
        );
        Route::get(
            'properties/{properties}/analytics',
            'PropertiesController@propertyAnalytics'
        );
        Route::get(
            'properties/analytics/{type}/{suburb}',
            'PropertiesController@analyticsSummary'
        );
        Route::put(
            'properties/{properties}',
            'PropertiesController@update'
        );

        Route::delete(
            'properties/{properties}',
            'PropertiesController@delete'
        );
    }
);

Route::post(
    'register',
    'Auth\RegisterController@register'
);

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
