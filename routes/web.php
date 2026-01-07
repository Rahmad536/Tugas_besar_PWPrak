<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\PohonController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPohonController;
use App\Http\Controllers\Admin\AdminHistoryController;
use App\Http\Middleware\EnsureUserIsAdmin;

/*
|--------------------------------------------------------------------------
| PUBLIC ACCESS (tanpa login)
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('profile');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
});

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register.form');

Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.submit');

/* Validasi Login dulu*/
Route::get('/event', fn () => view('event'))->name('event');
Route::get('/about', fn () => view('about'))->name('about');
Route::middleware('auth')->group(function () {

    // Pages
    Route::get('/monitoring', fn () => view('monitoring'))->name('monitoring');

    // Donasi 
    Route::get('/donasi', [PohonController::class, 'index'])->name('donasi');
    Route::get('/donasi/success', [DonationController::class, 'success'])->name('donasi.success');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

    // Donation Store
    Route::post('/donation/store', [DonationController::class, 'store'])->name('donation.store');

    // Logout
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    })->name('logout');
    Route::post('/donasi/create', [DonationController::class, 'createDonation'])->name('donasi.create');
    Route::get('/tree/{code}', [DonationController::class, 'getTreeData'])->name('tree.data');

});

/*ADMIN ACCESS */
Route::middleware(['auth', EnsureUserIsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('pohon', AdminPohonController::class);
    
    // History Donasi
    Route::get('/donations', [AdminHistoryController::class, 'index'])->name('donations.index');
    Route::get('/donations/{id}/edit', [AdminHistoryController::class, 'edit'])->name('donations.edit');
    Route::put('/donations/{id}', [AdminHistoryController::class, 'update'])->name('donations.update');
});