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
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'role:superadmin|admin|center'] ,'namespace' => 'Dashboard'], function () {
    Route::get('/','HomeController@index')->name('index');

    /**
    * Admins
    */
    Route::group(['middleware' => ['role:superadmin']],function(){
        Route::resource('admins','AdminController');
    });

    Route::group(['middleware' => ['role:superadmin|admin']],function(){
        /**
        * Centers
        */
        Route::resource('centers','CenterController');

        /**
        * Clients
        */
        Route::resource('clients','ClientController');
    });

    /**
    * Orders
    */
    Route::resource('orders','OrderController');

    /**
    * Agents
    */
    Route::resource('agents','AgentController');

    Route::group(['prefix' => 'enquiries','as' => 'enquiries.','middleware' => ['role:center']],function(){
        Route::get('/','SupportController@index')->name('index');
        Route::get('show/{group}','SupportController@show')->name('show');
        Route::post('show/{group}','SupportController@reply')->name('reply');
        Route::delete('/','SupportController@index')->name('destroy');
    });
});
