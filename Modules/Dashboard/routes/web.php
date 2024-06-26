<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\Http\Controllers\Family\DashboardController as FamilyDashboardController;
use Modules\Admin\Http\Controllers\DashboardController as AdminDashboardController;
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

Route::middleware('auth:family-web')
  ->get('/family/dashboard', [FamilyDashboardController::class, 'index'])
  ->name('family.dashboard');

Route::middleware('auth:admin-web')
  ->get('/admin/dashboard', [AdminDashboardController::class, 'index'])
  ->name('admin.dashboard');
