<?php

use App\Http\Controllers\Api\Resturant\MainController;
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
        Route::post('contact-us', 'MainController@contactus');
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
                Route::group(
                    ['middleware' => 'auth:restaurant'],
                    function () {
                        Route::post('register-token', 'AuthController@registerToken');
                        Route::post('remove-token', 'AuthController@removeToken');
                        Route::get('products', 'MainController@showProducts');
                        Route::post('add-product', 'MainController@createProducts');
                        Route::post('edit-product', 'MainController@editProducts');
                        Route::post('delete-product', 'MainController@deleteProducts');
                        Route::get('profile', 'MainController@profile');
                        Route::post('edit-profile', 'MainController@editProfile');
                        Route::get('offers', 'MainController@offers');
                        Route::post('add-offer', 'MainController@createOffer');
                        Route::post('delete-offer', 'MainController@deleteOffers');
                        Route::post('edit-offer', 'MainController@editOffer');
                        Route::post('new-orders', 'MainController@newOrders');
                        Route::post('current-orders', 'MainController@currentOrders');
                        Route::post('past-orders', 'MainController@pastOrders');
                        Route::post('accept-order', 'MainController@acceptOrders');
                        Route::post('decline-order', 'MainController@declineOrders');
                        Route::get('commission', 'MainController@settings');
                    }
                );
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
                Route::group(
                    ['middleware' => 'auth:client'],
                    function () {
                        Route::post('register-token', 'AuthController@registerToken');
                        Route::post('remove-token', 'AuthController@removeToken');
                        Route::get('profile', 'MainController@profile');
                        Route::post('edit-profile', 'MainController@editProfile');
                        Route::post('new-order', 'MainController@newOrder');
                        Route::post('order-details', 'MainController@orderDetails');
                        Route::get('current-orders', 'MainController@currentOrders');
                        Route::get('past-orders', 'MainController@pastOrders');
                        Route::post('delivered-orders', 'MainController@deliveredOrder');
                        Route::post('rejected-orders', 'MainController@rejectOrder');
                        Route::post('add-review', 'MainController@reviews');
                    }
                );
            }
        );
    }
);
