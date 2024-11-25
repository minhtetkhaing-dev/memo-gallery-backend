<?php

use App\Http\Controllers\App\AlbumnController;
use App\Http\Controllers\App\AuthController;
use App\Http\Controllers\App\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', [UserController::class, 'index']);
Route::put('/user', [UserController::class, 'update']);
Route::apiResource('/albumns', AlbumnController::class);
