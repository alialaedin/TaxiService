<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Admin\AuthController as AdminAuthController;
use Modules\Auth\Http\Controllers\Company\AuthController as CompanyAuthController;
use Modules\Auth\Http\Controllers\Family\AuthController as FamilyAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/admin')->name('admin.')->group(function () {
  Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login');
  });
  Route::middleware('auth:admin-web')
    ->post('/logout', [AdminAuthController::class, 'logout'])
    ->name('logout');
});

Route::prefix('/company')->name('company.')->group(function () {
  Route::middleware('guest')->group(function () {
    Route::get('/login', [CompanyAuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [CompanyAuthController::class, 'login'])->name('login');
  });
  Route::middleware('auth:company-web')
    ->post('/logout', [CompanyAuthController::class, 'logout'])
    ->name('logout');
});

Route::prefix('/family')->name('family.')->group(function () {
  Route::middleware('guest')->group(function () {

    Route::get('/login', [FamilyAuthController::class, 'showMobileForm'])->name('mobile-form');
    Route::post('/token' , [FamilyAuthController::class, 'sendToken'])->name('send-token');

    Route::get('/login/{mobile}', [FamilyAuthController::class, 'showTokenForm'])->name('verify-form');
    Route::post('/verify' , [FamilyAuthController::class, 'verify'])->name('verify');
    Route::get('/resend-token/{mobile}' , [FamilyAuthController::class, 'resendSmsToken'])->name('resend-token');

    Route::get('/register/{mobile}', [FamilyAuthController::class, 'showRegisterForm'])->name('register-form');
    Route::post('/register' , [FamilyAuthController::class, 'register'])->name('register');
  });
  Route::middleware('auth:family-web')
    ->post('/logout', [FamilyAuthController::class, 'logout'])
    ->name('logout');
});

