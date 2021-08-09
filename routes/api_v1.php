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

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/login', 'AuthController@login');
        Route::get('/logout', 'AuthController@logout');
        Route::post('/register', 'AuthController@register');
        Route::post('/forgot-password', 'AuthController@forgotPassword');
        Route::get('/reset-password/{token}', fn ($token) => redirect()->to(env('FE_HOST') . '/reset-password/' . $token));
        Route::post('/reset-password/{token}', 'AuthController@resetPassword');
    });

    Route::middleware('auth:api')->group(function () {
        Route::prefix('current-user')->group(function () {
            Route::get('/',  'CurrentUserController@show');
            Route::put('/change-avatar',  'CurrentUserController@changeAvatar');
            Route::put('/change-password',  'CurrentUserController@changePassword');
            Route::put('/change-profile',  'CurrentUserController@changeProfile'); 
        });
    });
});
