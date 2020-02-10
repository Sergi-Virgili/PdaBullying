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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Resource API Routes

Route::namespace('Api')->group(function(){
    //Auth
    Route::post('/register','AuthController@register');
    Route::post('/login','AuthController@login');
    //Refuges
    Route::post('/refuges','RefugeController@store')->middleware('auth:api');
    Route::get('/refuges','RefugeController@index');
    Route::get('/refugesPublish', 'RefugeController@indexPublish');
    Route::put('/refuges/{refuge}', 'RefugeController@update')->middleware('auth:api');
    Route::get('/refuges/{refuge}','RefugeController@show');
    Route::delete('/refuges/{refugeId}','RefugeController@destroy')->middleware('auth:api');
    //Users
    Route::post('/users', 'UserController@store');
    Route::put('/users/{id}', 'UserController@update');
    //TYPES ROUTES

    Route::get('/types','Typecontroller@index');

    Route::group(['middleware' => ['auth:api', 'admin']], function(){
        Route::post('/types', 'Typecontroller@store');
        Route::delete('/types/{type}','Typecontroller@destroy');
        Route::put('/types/{type}','Typecontroller@update');
        Route::patch('/refuges/publish','RefugeController@publish');
        Route::patch('/refuges/hidde','RefugeController@hidde');
    });

    //MAP ROUTES
    Route::get('/maps/{userId}','MapController@show');
    Route::get('/maps/attach/{refugeId}','MapController@attachRefuge')->middleware('auth:api');
    Route::get('/maps/detach/{refugeId}','MapController@detachRefuge')->middleware('auth:api');
    Route::patch('/maps/{mapId}', 'MapController@updateProperties');

    //USERS ROUTES
    Route::put('/users/{type}','Typecontroller@update');

    //ADMIN USERS ROUTES
    Route::group(['middleware' => ['auth:api', 'admin']], function(){
        Route::get('/users','Usercontroller@index');

        Route::delete('/users/{type}','Usercontroller@destroy');
    });
});
