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
    });
});
