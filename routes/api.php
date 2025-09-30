<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CrudApiController;
use App\Http\Controllers\api\ProfileCrudController;

Route::apiResource('crud', CrudApiController::class);
Route::get('/crud/{activityId}/edit', [CrudApiController::class, 'edit']);
Route::post('/crud/create', [CrudApiController::class, 'create']);
Route::apiResource('profile', ProfileCrudController::class);
Route::post('/getProfile', [ProfileCrudController::class, 'getProfile']);

?>