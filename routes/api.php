<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Ganti auth:sanctum jadi auth biasa
Route::middleware('auth')->group(function () {
    
    // Create donation
    Route::post('/donasi/create', [DonationController::class, 'createDonation']);
    
    // Get tree data by tracking code
    Route::get('/tree/{code}', [DonationController::class, 'getTreeData']);
    
});