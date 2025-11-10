<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CrudApiController;
use App\Http\Controllers\api\ProfileCrudController;
use App\Http\Controllers\Api\PerformaCrudController;

Route::apiResource('crud', CrudApiController::class);
Route::get('/crud/{activityId}/edit', [CrudApiController::class, 'edit']);
Route::post('/crud/create', [CrudApiController::class, 'create']);
Route::apiResource('profile', ProfileCrudController::class);
Route::post('/getProfile', [ProfileCrudController::class, 'getProfile']);
Route::apiResource('performa', PerformaCrudController::class);

Route::get('/test', [CrudApiController::class, 'test']);
Route::get('/home', [CrudApiController::class, 'home']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});
?>