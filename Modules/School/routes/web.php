<?php

use Illuminate\Support\Facades\Route;
use Modules\School\Http\Controllers\Admin\EducationLevelController;
use Modules\School\Http\Controllers\Admin\SchoolController;
use Modules\School\Http\Controllers\Admin\SchoolTypeController;
use Modules\School\Http\Controllers\Admin\ShiftController;

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
  Route::resource('/schools', SchoolController::class);
  Route::resource('/education-levels', EducationLevelController::class);
  Route::resource('/school-types', SchoolTypeController::class);
  Route::resource('/shifts', ShiftController::class);
});
