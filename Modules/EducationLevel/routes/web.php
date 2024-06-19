<?php

use Illuminate\Support\Facades\Route;
use Modules\EducationLevel\Http\Controllers\Admin\EducationLevelController;

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
  Route::resource('/education-levels', EducationLevelController::class);
});
