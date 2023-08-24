<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApiAuthenticate;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'job'], function () {
    Route::get('/', [JobController::class, 'index']);
    Route::get('/{id}', [JobController::class, 'show']);
    Route::post('/', [JobController::class, 'store'])->middleware(ApiAuthenticate::class);
    Route::put('/{id}', [JobController::class, 'update'])->middleware(ApiAuthenticate::class);
    Route::delete('/{id}', [JobController::class, 'destroy'])->middleware(ApiAuthenticate::class);
    Route::post('/register/{id}', [JobController::class, 'register'])->middleware(ApiAuthenticate::class);
});

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
});
