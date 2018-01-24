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
Auth::routes();

Route::get('/','HomeController@index')->name('home');

/*
* Admin Dashbord Routes
*/
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'role:superadmin|admin'] ,'namespace' => 'Dashboard'], function () {
    Route::get('/','HomeController@index')->name('index');

    /**
    * Admins
    */
    Route::group(['middleware' => ['auth', 'role:superadmin']],function(){
        Route::resource('admins','AdminController');
    });

    /**
    * Centers
    */
    Route::resource('centers','CenterController');

    /**
    * Clients
    */
    Route::resource('clients','ClientController');

    /**
    * Orders
    */
    Route::resource('orders','OrderController');

});
