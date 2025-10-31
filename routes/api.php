<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\api\CrudApiController;
use App\Http\Controllers\api\ProfileCrudController;

Route::apiResource('crud', CrudApiController::class);
Route::get('/crud/{activityId}/edit', [CrudApiController::class, 'edit']);
Route::post('/crud/create', [CrudApiController::class, 'create']);
Route::apiResource('profile', ProfileCrudController::class);
Route::post('/getProfile', [ProfileCrudController::class, 'getProfile']);

Route::get('/test', [CrudApiController::class, 'test']);
Route::get('/home', [CrudApiController::class, 'home']);
=======
use App\Http\Controllers\CrudApiController;

Route::apiResource('crud', CrudApiController::class);
Route::get('/crud/{activityId}/edit', [CrudApiController::class, 'edit']);
>>>>>>> 5582c58f29a520ba73d8d55abedc6bcf68152c84

?>