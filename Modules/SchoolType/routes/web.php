<?php

use Illuminate\Support\Facades\Route;
use Modules\SchoolType\Http\Controllers\Admin\SchoolTypeController;

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
  Route::resource('/school-types', SchoolTypeController::class);
});
