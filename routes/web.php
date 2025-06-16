<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminProfileController;
use App\Http\Controllers\Admin\SanghController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SanghProfileController;
use App\Http\Controllers\Admin\ParyushanEventController;

Route::get('/', function () {
    return redirect('login');
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
    
    Route::get('/sangh/dashboard', function () {
        return view('admin.dashboard');
    })->name('sangh.dashboard');
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile');
    Route::post('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
});

Route::middleware(['auth'])->prefix('admin/sangh')->name('admin.sangh.')->group(function () {
    Route::get('/', [SanghController::class, 'index'])->name('index');
    Route::get('/datatable', [SanghController::class, 'datatable'])->name('datatable');
    Route::get('/create', [SanghController::class, 'create'])->name('create');
    Route::post('/', [SanghController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [SanghController::class, 'adminEdit'])->name('edit');
    Route::delete('/{user}', [SanghController::class, 'destroy'])->name('destroy');
    Route::post('/{user}/status', [SanghController::class, 'changeStatus'])->name('status');
    Route::get('/{user}/view', [SanghController::class, 'adminView'])->name('view');
    Route::get('/{user}/download-pdf', [SanghController::class, 'downloadPdf'])->name('downloadPdf');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/sangh/profile', [SanghProfileController::class, 'show'])->name('sangh.profile');
    Route::get('/sangh/profile/edit', [SanghProfileController::class, 'edit'])->name('sangh.profile.edit');
    Route::post('/sangh', [SanghController::class, 'store'])->name('sangh.store');
});

Route::prefix('sangh/paryushan')->name('sangh.paryushan.')->middleware(['auth'])->group(function () {
    Route::get('events', [ParyushanEventController::class, 'index'])->name('events.index');
    Route::get('events/create', [ParyushanEventController::class, 'create'])->name('events.create');
    Route::get('events/datatable', [ParyushanEventController::class, 'datatable'])->name('events.datatable');
    Route::post('events', [ParyushanEventController::class, 'store'])->name('events.store');
    Route::post('events/update-status', [ParyushanEventController::class, 'updateStatus'])->name('events.update-status');
    Route::get('events/{id}/view', [\App\Http\Controllers\Admin\ParyushanEventController::class, 'show'])->name('events.show');
    Route::get('events/{id}/download-pdf', [\App\Http\Controllers\Admin\ParyushanEventController::class, 'downloadPdf'])->name('events.download-pdf');
    Route::get('events/{id}/edit', [ParyushanEventController::class, 'edit'])->name('events.edit');
    Route::put('events/{id}', [ParyushanEventController::class, 'update'])->name('events.update');
    Route::delete('events/{id}', [ParyushanEventController::class, 'destroy'])->name('events.destroy');
});

