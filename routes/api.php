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

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);

Route::group(
    ['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api'],
    function () {
        Route::get('cities', 'MainController@cities');
        Route::get('neighbourhoods', 'MainController@neighbourhoods');
        Route::get('categories', 'MainController@categories');
        Route::get('products', 'MainController@products');
        Route::post('reviews', 'MainController@reviews');
        Route::post('resturants', 'MainController@resturants');
        Route::post('resturant', 'MainController@aboutResturant');
        Route::get('contact-us', 'MainController@contacts');
        Route::get('offers', 'MainController@offers');
        Route::get('settings', 'MainController@settings');
        Route::get('payment-methods', 'MainController@paymentMethod');

        // Resturant Routes
        Route::group(
            ['prefix' => 'restaurant', 'namespace' => 'Resturant'],
            function () {
                Route::post('register', 'AuthController@register');
                Route::post('login', 'AuthController@login');
                Route::post('reset-password', 'AuthController@resetPassword');
                Route::post('new-password', 'AuthController@newPassword');
            }
        );
        // Client Routes
        Route::group(
            ['prefix' => 'client', 'namespace' => 'Client'],
            function () {
                Route::post('register', 'AuthController@register');
                Route::post('login', 'AuthController@login');
                Route::post('reset-password', 'AuthController@resetPassword');
                Route::post('new-password', 'AuthController@newPassword');
            }
        );
    }
);
