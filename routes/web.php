<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminProfileController;
use App\Http\Controllers\Admin\SanghController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login/check-pincode', [LoginController::class, 'checkPincode'])->name('login.check-pincode');
Route::post('/login/send-otp', [LoginController::class, 'sendOtp'])->name('login.send-otp');
Route::get('/otp-verify', [LoginController::class, 'showOtpForm'])->name('otp.verify');
Route::post('/otp-verify', [LoginController::class, 'verifyOtp'])->name('otp.verify.post');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/admin/login', [AdminLoginController::class, 'show'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
    Route::post('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});

Route::middleware(['auth'])->prefix('admin/sangh')->name('admin.sangh.')->group(function () {
    Route::get('/', [SanghController::class, 'index'])->name('index');
    Route::get('/datatable', [SanghController::class, 'datatable'])->name('datatable');
    Route::get('/create', [SanghController::class, 'create'])->name('create');
    Route::post('/', [SanghController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [SanghController::class, 'edit'])->name('edit');
    Route::put('/{user}', [SanghController::class, 'update'])->name('update');
    Route::delete('/{user}', [SanghController::class, 'destroy'])->name('destroy');
    Route::post('/{user}/status', [SanghController::class, 'changeStatus'])->name('status');
});
