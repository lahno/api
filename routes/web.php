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

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::group(['middleware' => 'auth'], function () {
    Route::get('changePasswordForm','PostController@showChangePasswordForm')->name('changePasswordForm');
    Route::get('deletingAccountForm','PostController@deletingAccountForm')->name('deletingAccountForm');
    Route::get('oAuthClients','PostController@oAuthClients')->name('oAuthClients');
    Route::get('contacts','ContactsController@contacts')->name('contacts');

    /* Posts request */
    Route::post('changePassword','PostController@changePassword')->name('changePassword');
    Route::post('deletingAccount','PostController@deletingAccount')->name('deletingAccount');
});


/* Log view */
Route::get('l_v_', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
