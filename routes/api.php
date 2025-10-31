<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudApiController;

Route::apiResource('crud', CrudApiController::class);
Route::get('/crud/{activityId}/edit', [CrudApiController::class, 'edit']);

?>