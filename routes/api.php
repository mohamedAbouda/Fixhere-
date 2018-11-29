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
    Route::get('/all/cities','CityController@allCities');
    Route::post('contact/us','ClientController@contactUs');
    Route::get('about/us','ClientController@aboutUs');
    Route::post('verfiy/phone','ClientController@verfiyPhone');
    Route::group(['middleware'=>['JWT.auth']],function (){
        Route::post('auth/change/password','AuthController@changePassword');
        Route::post('/auth/token','AuthController@deviceToken');
        Route::post('/auth/confirm','AuthController@confirm');
        Route::post('/auth/resend/code','AuthController@resendCode');
        Route::post('/auth/create/refer','AuthController@createRefer');
        Route::get('orders/requests','RequestController@ordersRequests');
        Route::group(['prefix' => 'profile'] , function(){
            Route::get('/','ClientController@show');
            Route::post('/edit','ClientController@edit');

        });

         Route::group(['prefix' => 'cart'] , function(){
            Route::post('add','CartController@add');
            Route::get('get','CartController@get');
            Route::post('update','CartController@update');
            Route::post('remove','CartController@remove');
            Route::post('destroy','CartController@destroy');
            Route::get('checkout','CartController@checkout');
            Route::post('agent/change/status','CartController@agentAccept');

        });
         Route::get('orders','CartController@orders');
         Route::get('order/details','CartController@orderDetails');
         Route::group(['prefix' => 'request'] , function(){
            Route::post('/send','RequestController@send');
            Route::post('/schedule','RequestController@Schedule');
            Route::post('/accept','RequestController@accept');
            Route::get('/get','RequestController@getRequests');
            Route::get('agent/get','RequestController@agentGetRequests');
        });
        Route::post('request/spell/part','AgentController@requestSpellPart');
        Route::post('user/promo/codes','ClientController@userPromoCodes');
        Route::post('promo/code','ClientController@promoCode');
        Route::post('/nearby/centers','CenterController@nearbyCenters');
        Route::get('/recent/centers','CenterController@recentCenters');

        Route::get('/all/services','ServiceController@allServices');
        Route::get('/all/regions','RegionController@allRegions');

        Route::post('/center/details','CenterController@centerDetails');
        Route::post('client/review/agent','AgentController@review');
        Route::group(['prefix' => 'order'] , function(){
            Route::post('/create','OrderController@store');
            Route::post('/update','OrderController@update');
            Route::post('/pending','OrderController@pending');
            Route::post('/history','OrderController@history');
            Route::post('details','OrderController@show');
            Route::post('pickup','OrderController@pickup');
            Route::post('create/review','OrderController@createReview');
        });

        Route::group(['prefix' => 'enquiries'] , function(){
            Route::post('/','SupportController@index');
            Route::post('/show/{group}','SupportController@show');
            Route::post('/new','SupportController@newChat');
            Route::post('/reply/{group}','SupportController@reply');
        });

        Route::group(['prefix' => 'agents'] , function(){
            Route::get('/','AgentController@index');
            Route::get('/profile','AgentController@show');
            Route::get('/{agent}','AgentController@show');
        });

        Route::group(['prefix' => 'chats'] , function(){
            Route::get('/','ChatController@chats');
            Route::post('/show','ChatController@chat');
            Route::post('/send','ChatController@send');
        });
        Route::get('faqs','FAQController@index');

        Route::get('brands','BrandController@index');
        Route::get('models','ModelController@index');
        Route::get('maintenance-services','MaintenanceServiceController@index');
        Route::get('parts','ProductController@index');
        Route::get('parts/{part}/related','ProductController@related');
    });
});
