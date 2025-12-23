<?php

use App\Http\Controllers\Api\PortofolioController;
use App\Http\Controllers\Api\SertifikatController;
use App\Http\Controllers\Api\DataSiswaController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::apiResource('datasiswa', DataSiswaController::class);
Route::apiResource('portofolio', PortofolioController::class);
Route::apiResource('sertifikat', SertifikatController::class);



Route::options('{any}', function() {
    return response()->json([], 200);
})->where('any', '.*');

// Public routes - no auth needed
Route::post('/login', [AuthController::class, 'login']);

// Protected routes - use custom auth middleware
Route::middleware(\App\Http\Middleware\CustomSanctumAuth::class)->group(function () {
    Route::get('/datasiswa', [DataSiswaController::class, 'index']);
    Route::get('/datasiswa/{id}', [DataSiswaController::class, 'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
});