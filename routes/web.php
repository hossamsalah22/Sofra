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
    ]],
    function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
        Route::resource('city', 'CitiesController');
        Route::resource('neighbourhood', 'NeighbourhoodsController');
        Route::resource('category', 'CategoriesController');
        Route::resource('payment-method', 'PaymentMethodsController');
        Route::resource('offer', 'OffersController');
    }
);
