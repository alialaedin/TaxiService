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

  Route::prefix('/contracts')->name('contracts.')->group(function() {
    Route::post('/load-education-levels', [ContractController::class, 'loadEducationLevels'])->name('load-education-levels');
    Route::post('/load-companies', [ContractController::class, 'loadCompanies'])->name('load-companies');
    Route::post('/load-schools', [ContractController::class, 'loadSchools'])->name('load-schools');
  });

  Route::resource('/contracts', ContractController::class);
});
