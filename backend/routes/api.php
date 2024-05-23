<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UsersController;

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

Route::group(['middleware' => 'api'], function ($router) {

    Route::get('users', 'UsersController@index');
    Route::get('users/{id}', 'UsersController@show');
    Route::post('users/create', 'UsersController@create');
    Route::delete('users/delete/{id}', 'UsersController@delete');
    Route::put('user/edit/{id}', 'UsersController@edit');
    Route::post('/logout', 'UsersController@logout');

    Route::get('reserves', 'ReservesController@index');
    Route::get('reserves/{id}', 'ReservesController@show');
    Route::post('reserves/create', 'ReservesController@create');
    Route::delete('reserves/delete/{id}', 'ReservesController@delete');
    Route::put('reserves/edit/{id}', 'ReservesController@edit');

    Route::get('services', 'ServicesController@index');
    Route::get('services/{id}', 'ServicesController@show');
    Route::get('services/create', 'ServicesController@create');
    Route::delete('services/delete/{id}', 'ServicesController@delete');
    Route::put('services/edit/{id}', 'ServicesController@edit');

    Route::get('/login', 'UsersController@showLoginForm');
    Route::post('/login', 'UsersController@login')->name('login');

});