<?php

use Illuminate\Support\Facades\Route;
use Modules\Contract\Http\Controllers\Family\ContractController;

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


Route::middleware('auth:family-web')->prefix('/family')->name('family.')->group(function() {
  Route::resource('/contracts', ContractController::class);
});
