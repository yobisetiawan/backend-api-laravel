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

    Route::middleware('auth:api')->group(function () {
        Route::get('/current-user',  'CurrentUserController@show');
        Route::put('/current-user',  'CurrentUserController@update');
    });


    Route::prefix('auth')->group(function () {
        // Route::post('/login',  function (Request $request) {
        //     return $request->user();
        // });
        // Route::post('/register',  function (Request $request) {
        //     return $request->user();
        // });
        // Route::post('/forgot-password',  function (Request $request) {
        //     return $request->user();
        // });
    });
});
