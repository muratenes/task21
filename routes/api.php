<?php

use Illuminate\Support\Facades\Route;

// AuthRoutes
Route::post('/register', [\App\Http\Controllers\Auth\UserAuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Auth\UserAuthController::class, 'login']);


Route::apiResource('/tasks', \App\Http\Controllers\TaskController::class)
    ->middleware(['auth:api']);
