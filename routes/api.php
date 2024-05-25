<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', AuthController::class . '@login');
//logout
Route::post('/logout', AuthController::class . '@logout')->middleware('auth:sanctum');
