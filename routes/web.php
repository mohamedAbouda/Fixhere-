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
        Route::get('user/{id}/edit/wallet','ClientController@editWallet')->name('admin.edit.wallet.user');
        Route::post('store/user/wallet/transaction','ClientController@storeWalletTransaction')->name('store.user.wallet.transaction');

        /**
        * Cities
        */
        Route::resource('cities','CityController');

        /**
        * Services
        */
        Route::resource('services','ServiceController');

        /**
        * Promo codes
        */
        Route::resource('promo_codes','PromoCodeController');

        /**
        * Regions
        */
        Route::resource('regions','RegionController');
        /**
        * Refers
        */
        Route::resource('refers','ReferController');

        /**
        * Request spell
        */
        Route::resource('spellRequests','SpellRequestController');
        Route::post('update/part/status','SpellRequestController@updateStatus')->name('part.update.status');

        /**
        * Brands
        */
        Route::resource('brands','BrandController');
        /**
        * Models
        */
        Route::resource('models','ModelController');
        /**
        * Products
        */
        Route::resource('products','ProductController');
    });

    /**
    * Orders
    */
    Route::resource('orders','OrderController');
    Route::get('order/{id}/location','OrderController@location')->name('order.location');

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

    /**
    * Chat
    */
    Route::group(['prefix' => 'chats','as' => 'chats.','middleware' => ['role:admin|superadmin']] , function(){
        Route::get('/','ChatController@chats')->name('index');
        Route::get('/{order}','ChatController@chat')->name('show');
        Route::post('/{order}','ChatController@send')->name('send');
    });
    /**
    * FAQs
    */
    Route::resource('faqs','FAQController');
});
