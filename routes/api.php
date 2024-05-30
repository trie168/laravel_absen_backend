<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\PermissionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', AuthController::class . '@login');
//logout
Route::post('/logout', AuthController::class . '@logout')->middleware('auth:sanctum');
//company
Route::get('/company', CompanyController::class . '@show')->middleware('auth:sanctum');
//checkin
Route::post('/checkin', AttendanceController::class . '@checkIn')->middleware('auth:sanctum');
//checkout
Route::post('/checkout', AttendanceController::class . '@checkOut')->middleware('auth:sanctum');
//check already checkin
Route::get('/is-checkin', AttendanceController::class . '@isCheckIn')->middleware('auth:sanctum');
//update image profile and face_embedding
Route::post('/update-profile', AuthController::class . '@updateProfile')->middleware('auth:sanctum');
//permission
Route::post('/permission', PermissionController::class . '@store')->middleware('auth:sanctum');
