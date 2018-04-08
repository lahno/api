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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/changePasswordForm','PostController@showChangePasswordForm')->name('changePasswordForm');
Route::get('/deletingAccountForm','PostController@deletingAccountForm')->name('deletingAccountForm');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');


/* Posts request */
Route::post('/changePassword','PostController@changePassword')->name('changePassword');
Route::post('/deletingAccount','PostController@deletingAccount')->name('deletingAccount');
