<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//--bd -- lagbox

// Route::controller('auth', 'Auth\AuthController', [
//     'getConfirm' => 'auth.confirm',
//     'getResendConfirm' => 'auth.confirm.resend'
// ]);

Route::prefix('auth')->group(function () {
    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');
    
    Route::get('confirm/{confirmation_code}', 'Auth\AuthController@getConfirm')->name('auth.confirm');
    Route::get('resent-confirm/{confirmation_code}', 'Auth\AuthController@getResentConfirm')->name('auth.confirm.resend');
});


//bd Route::controller('password', 'Auth\PasswordController');

Route::prefix('password')->group(function () {
    Route::get('email', 'Auth\PasswordController@getEmail');
    Route::post('email', 'Auth\PasswordController@postEmail');
    Route::get('reset/{token?}', 'Auth\PasswordController@getReset');
    Route::post('reset', 'Auth\PasswordController@postReset');
});



Route::get('/status/{referral_secret?}', [ 'as' => 'user.status', 'uses' => 'UsersController@status' ]);

Route::get('/privacy', [ 'as' => 'privacy', function() {
	return view('static.privacy');
}]);

Route::get('/', [ 'as' => 'user.create', 'middleware' => 'status-page', 'uses' => 'UsersController@create' ]);
Route::get('/homepage', [ 'as' => 'user.create.nostatus', 'uses' => 'UsersController@create' ]);
Route::post('/', [ 'as' => 'user.store', 'uses' => 'UsersController@store' ]);
Route::get('/{referrer_code}', [ 'as' => 'user.referral', 'uses' => 'UsersController@referral' ]);
