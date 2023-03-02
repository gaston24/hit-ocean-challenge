<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CombatController;
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


Route::group(['prefix' => 'auth'], function () {

    Route::post('/register', [authController::class, 'create']);
    Route::post('/login', [authController::class, 'login']);

});


Route::middleware(['auth:api'])->group(function () {

    Route::group(['prefix' => 'user'], function () {
        Route::get('/{id?}', [UserController::class, 'getUser']);

        Route::group(['prefix' => 'item'], function () {
            Route::get('/get-all', [UserController::class, 'getItems']);
            Route::get('/add/{item_id}', [UserController::class, 'addItemToInventory']);
            Route::get('/delete/{item_id}', [UserController::class, 'deleteItemToInventory']);
        });

        Route::group(['prefix' => 'equipped'], function () {
            Route::get('/get-all', [UserController::class, 'getEquippedItems']);
            Route::get('/add/{item_id}', [UserController::class, 'addItemEquipped']);
            Route::get('/delete/{item_id}', [UserController::class, 'deleteItemEquipped']);
        });

        Route::group(['prefix' => 'combat'], function () {
            Route::post('/attack/{player_1}/{player_2}/{type_attack}', [CombatController::class, 'attackAction']);
    
        });

    });

    Route::group(['prefix' => 'admin'], function () {
        Route::post('/create-user', [UserController::class, 'createUserAdmin']);
        Route::post('/create-item', [UserController::class, 'createItemAdmin']);
        Route::post('/update-item/{item_id}', [UserController::class, 'updateItemAdmin']);
        
        Route::get('/show-ulti', [UserController::class, 'showUlti']);


    });






    Route::group(['prefix' => 'test'], function () {
        Route::get('/test', [TestController::class, 'test']);
    });

});
