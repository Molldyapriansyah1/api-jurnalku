<?php

use App\Http\Controllers\Api\PortofolioController;
use App\Http\Controllers\Api\SertifikatController;
use App\Http\Controllers\Api\DataSiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::apiResource('datasiswa', DataSiswaController::class);
Route::apiResource('portofolio', PortofolioController::class);
Route::apiResource('sertifikat', SertifikatController::class);

    