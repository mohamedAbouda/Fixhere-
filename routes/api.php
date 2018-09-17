<?php

use Illuminate\Http\Request;

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

Route::group(['prefix'=>'v1','namespace' => 'Apis'],function(){
    Route::post('/auth/register','AuthController@register');
    Route::post('/auth/login','AuthController@login');
    Route::post('/auth/social/register','AuthController@socialRegister');
    Route::post('/auth/social/login','AuthController@socialLogin');
    Route::post('/auth/forget','AuthController@forgetPassword');

    Route::group(['middleware'=>['JWT.auth']],function (){
        Route::post('/auth/confirm','AuthController@confirm');
        Route::post('/auth/resend/code','AuthController@resendCode');

        Route::group(['prefix' => 'profile'] , function(){
            Route::get('/','ClientController@show');
            Route::post('/edit','ClientController@edit');
        });

        Route::post('/nearby/centers','CenterController@nearbyCenters');
        Route::get('/recent/centers','CenterController@recentCenters');
        Route::get('/all/cities','CityController@allCities');
        Route::get('/all/services','ServiceController@allServices');
        Route::get('/all/regions','RegionController@allRegions');

        Route::post('/center/details','CenterController@centerDetails');

        Route::group(['prefix' => 'order'] , function(){
            Route::post('/create','OrderController@store');
            Route::get('/{order}','OrderController@show');
        });

        Route::group(['prefix' => 'chat'] , function(){
            Route::post('/','SupportController@index');
            Route::post('/show/{group}','SupportController@show');
            Route::post('/new','SupportController@newChat');
            Route::post('/reply/{group}','SupportController@reply');
        });
    });
});
