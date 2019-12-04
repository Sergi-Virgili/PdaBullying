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
    Route::post('/refuges','RefugeController@store');
    Route::get('/refuges','RefugeController@index');
    Route::get('/refuges/{resource}','RefugeController@show');
    Route::delete('/refuges/{resource}','RefugeController@destroy');

    //MAP ROUTES
    Route::get('/maps/{userId}','MapController@show');
    Route::get('/maps/attach/{refugeId}','MapController@attachRefuge');
    Route::get('/maps/detach/{refugeId}','MapController@detachRefuge');
});
