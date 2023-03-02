<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/test1', [UserController::class, 'createUser']);

Route::group(['prefix' => 'auth'], function () {

    Route::post('/login', [authController::class, 'login']);
    Route::post('/register', [authController::class, 'create']);

});


Route::middleware(['auth:api'])->group(function () {

    Route::group(['prefix' => 'test'], function () {
    
        Route::get('/test', [TestController::class, 'test']);
    
    });

});
