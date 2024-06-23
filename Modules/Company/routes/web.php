<?php

use Illuminate\Support\Facades\Route;
use Modules\Company\Http\Controllers\Admin\CompanyController;
use Modules\Company\Http\Controllers\Company\ProfileController as CompanyProfileController;

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
Route::middleware('auth:admin-web')->prefix('/admin')->name('admin.')->group(function() {
  Route::resource('/companies', CompanyController::class);
});

Route::middleware('auth:company-web')->prefix('/company')->name('company.')->group(function() {
  Route::get('/profile/edit', [CompanyProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [CompanyProfileController::class, 'update'])->name('profile.update');
});
