<?php
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

Route::get('access_token', 'AccessTokenController@generate_token');
Route::group(['prefix' => 'v1' , 'as' => 'Api.'],function (){
    Route::group(['prefix' => 'Chat'] , function (){
        Route::get('ChatStore' , 'ApiController@ChatStore');



        Route::get('Chat' , 'ApiController@ChatGet');
        Route::get('ChatAdmin' , 'ApiController@ChatGetAdmin');

        //hasan start here

        Route::get("newChat","ApiController@newChat");
        Route::get("newChatAdmin","ApiController@newChatAdmin");
        Route::get("newChatDestroy","ApiController@newChatDestroy");
        Route::get("newChatAdminDestroy","ApiController@newChatAdminDestroy");
        Route::get("emailSender","ApiController@emailSender");


        //hasan end here

        Route::get('ChatAdminStore' , 'ApiController@ChatStoreAdmin');
    });
    Route::group(['prefix' => 'AuditoriumChat'] , function (){
        Route::get('Get' , 'ApiController@AudituriumChatGet')->name('AudituriumGet');
        Route::post('Post' , 'ApiController@AudituriumChat')->name('AudituriumPost');
    });
    Route::group(['prefix' => 'Lounge'] , function (){
        Route::get('Get/{id?}' , 'ApiController@LoungeGet')->name('LoungeGet');
        Route::post('Post' , 'ApiController@LoungePost')->name('LoungePost');
        Route::get('Count/{id?}' , 'ApiController@LoungeCount')->name('LoungeCount');
    });
    Route::get('WhatIsUserName/{user_id?}' , 'ApiController@WhatIsUserName')->name('WhatIsUserName');
    Route::post('Login' , 'ApiController@Login');
    Route::post('LoginShowroom' , 'ApiController@LoginShowroom');
    Route::get('Images' , 'ApiController@Images');
    Route::get('test' , 'WebController@test');
    Route::get('UserDetails/{ID}' , 'ApiController@UserDetails');
    Route::get('Booth/{ID}' , 'ApiController@BoothGet');
    Route::get('color/{Color}' , 'ApiController@hexToRgb');
    Route::get('ContactUs' , 'ApiController@ContactUs');
    Route::get('Statistics' , 'ApiController@Statistics');
    Route::get('hall/full/{HallName}' , 'ApiController@HallIsFull');
    Route::get('booth/occupied/{HallName}/{Position}' , 'ApiController@PositionIsAvailable');
    Route::get('JobDetails/{JobID}' , 'ApiController@JobDetails');

    //hasan start here

    Route::get("BoothOnline/{id}","ApiController@BoothOnline");
    Route::get("autoLogin","ApiController@autoLogin");
    Route::get("ios/rotation1","ApiController@rotation1");
    Route::get("ios/rotation2","ApiController@rotation2");
    Route::get("ios/rotation3","ApiController@rotation3");
    Route::get("ios/rotation4","ApiController@rotation4");
    Route::get("ios/rotation5","ApiController@rotation5");
    Route::get("ios/rotation6","ApiController@rotation6");

    Route::get("/autoLoginApp","ApiController@autoLoginApp")->name("autoLoginApp");
    Route::get("/autoLoginAppDestroy","ApiController@autoLoginApiDestroy")->name("autoLoginApiDestroy");
    Route::get("/url","ApiController@url");

    //hasan end here

});


