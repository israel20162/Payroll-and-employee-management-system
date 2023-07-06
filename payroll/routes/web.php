<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
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

// Route::controller(EmployeeController::class)->group(function () {
//     Route::get('/', 'index');
//     Route::post('/orders', 'store');
// });



Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->middleware(['auth'])->name('dashboard');
    Route::post('/orders', 'store');
});
Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employees', 'index')->middleware(['auth'])->name('employees');
    Route::any('/search','search')->name('search');
    Route::post('/orders', 'store');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })

require __DIR__.'/auth.php';
