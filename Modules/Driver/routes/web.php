<?php

use Illuminate\Support\Facades\Route;
use Modules\Driver\Http\Controllers\Admin\DriverController as AdminDriverController;
use Modules\Driver\Http\Controllers\Company\DriverController as CompanyDriverController;
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
  Route::resource('/drivers', AdminDriverController::class);
});

Route::middleware('auth:company-web')->prefix('/company')->name('company.')->group(function() {
  Route::resource('/drivers', CompanyDriverController::class);
});
