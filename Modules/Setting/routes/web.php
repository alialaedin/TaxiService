<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\Http\Controllers\Admin\SettingController;
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

Route::middleware('auth:admin-web')->prefix('/admin')->name('admin.')->group(function () {
  Route::prefix('/settings')->name('settings.')->group(function () {
    Route::get('/edit', [SettingController::class, 'edit'])->name('edit');
    Route::patch('/', [SettingController::class, 'update'])->name('update');
  });
});
