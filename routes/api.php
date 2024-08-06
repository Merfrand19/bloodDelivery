<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HospitalController;
use App\Http\Controllers\API\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::post('/hospitals', [HospitalController::class, 'store']);
// Route::get('/hospitals', [HospitalController::class, 'index']);
// Route::get('/hospitals/{hospital}', [HospitalController::class, 'show']);
// Route::put('/hospitals/{hospital}', [HospitalController::class, 'update']);
// Route::delete('/hospitals/{hospital}', [HospitalController::class, 'destroy']);

Route::apiResource('hospitals', HospitalController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});