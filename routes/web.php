<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get(
    'login',
    function () {
        return view('auth.login');
    }
);

Auth::routes(['register' => false]);
Route::group(
    ['namespace' => 'App\Http\Controllers', 'middleware' => [
        'auth:web',
        'App\Http\Middleware\AutoCheckPermission'
    ]],
    function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
        Route::resource('city', 'CitiesController');
        Route::resource('neighbourhood', 'NeighbourhoodsController');
        Route::resource('category', 'CategoriesController');
        Route::resource('resturants-payments', 'ResturantPaymentsController');
        Route::resource('offer', 'OffersController');
        Route::resource('contact-us', 'ContactsController');
        Route::resource('setting', 'SettingsController');
        Route::resource('payment-method', 'PaymentMethodsController');
        Route::resource('restaurant', 'ResturantsController');
        Route::get('restaurant/{id}/activate', 'ResturantsController@activate');
        Route::get('restaurant/{id}/de-activate', 'ResturantsController@deActivate');
        Route::resource('client', 'ClientsController');
        Route::get('client/{id}/activate', 'ClientsController@activate');
        Route::get('client/{id}/de-activate', 'ClientsController@deActivate');
        Route::resource('order', 'OrdersController');
        Route::get('order/{id}/print', 'OrdersController@printOrder');
        Route::resource('user', 'UsersController');
        Route::resource('role', 'RolesController');
        Route::resource('change-password', 'ChangePasswordController');
    }
);
