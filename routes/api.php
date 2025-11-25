<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CrudApiController;
use App\Http\Controllers\api\ProfileCrudController;
use App\Http\Controllers\Api\UserDataApiController;
use App\Http\Controllers\Api\PerformaCrudController;

Route::apiResource('crud', CrudApiController::class);
Route::get('/crud/{activityId}/edit', [CrudApiController::class, 'edit']);
Route::post('/crud/create', [CrudApiController::class, 'create']);
Route::apiResource('profile', ProfileCrudController::class);
Route::post('/getProfile', [ProfileCrudController::class, 'getProfile']);
Route::apiResource('performa', PerformaCrudController::class);

Route::post('/user', [UserDataApiController::class, 'userData']);
Route::get('/user/detailData/{id}', [UserDataApiController::class, 'detailData']);
Route::post('/user/portofolio', [UserDataApiController::class, 'portofolioData']);

Route::get('/test', [CrudApiController::class, 'test']);
Route::get('/home', [CrudApiController::class, 'home']);

?>