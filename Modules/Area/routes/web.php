<?php

use Illuminate\Support\Facades\Route;
use Modules\Area\Http\Controllers\Admin\CityController;
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
  Route::post('/get-cities-by-province-id', [CityController::class, 'getCities'])->name('get-cities-by-province-id');
});
