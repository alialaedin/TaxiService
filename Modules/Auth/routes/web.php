<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Admin\AuthController as AdminAuthController;
use Modules\Auth\Http\Controllers\Company\AuthController as CompanyAuthController;

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

Route::get('/', function () {
  return view('auth::admin.login');
});

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

