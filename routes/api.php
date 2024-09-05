<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HospitalController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BloodInventoryController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\DetailTransactionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


 


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

Route::get('/email/verify', function () {
   // return view('auth.verify-email');
    return response()->json(['message' => 'Email verification message sent.'], 200);
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
    return response()->json(['message' => 'Email verification message sent.'], 200);
})->name('verification.verify'); 

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['throttle:6,1'])->name('verification.send');