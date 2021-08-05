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
        Route::post('/register', 'AuthController@register');
        Route::post('/forgot-password', 'AuthController@forgotPassword');
        Route::get('/reset-password/{token}', fn ($token) => redirect()->to(env('FE_HOST') . '/reset-password/' . $token));
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('/current-user',  'CurrentUserController@show');
    });
    Route::put('/current-user',  'CurrentUserController@update');
});
