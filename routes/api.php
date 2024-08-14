<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HospitalController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BloodInventoryController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\DetailTransactionController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route::post('/hospitals', [HospitalController::class, 'store']);
// Route::get('/hospitals', [HospitalController::class, 'index']);
// Route::get('/hospitals/{hospital}', [HospitalController::class, 'show']);
// Route::put('/hospitals/{hospital}', [HospitalController::class, 'update']);
// Route::delete('/hospitals/{hospital}', [HospitalController::class, 'destroy']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    //Hospital
    Route::apiResource('hospitals', HospitalController::class);

    //BloodInventory
    Route::apiResource('blood_inventories', BloodInventoryController::class);

    //Transactions
    Route::apiResource('transactions', TransactionController::class);

    //DetailTransactions
    Route::apiResource('detail_transactions', DetailTransactionController::class);
    
});
