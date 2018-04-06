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

Route::group(['prefix' => 'v1.0'], function () {
    Route::middleware('auth:api')->post('contacts', 'Api\PostController@contacts');
    Route::middleware('auth:api')->delete('contacts/delete/{contact}', 'Api\PostController@delete');
});
