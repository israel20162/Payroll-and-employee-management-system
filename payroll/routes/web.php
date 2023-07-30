<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentsController;
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

Route::controller(DepartmentsController::class)->group(function () {
    Route::get('/departments', 'index')->name('departments');
    Route::any('/import', 'importExcel')->name('import.excel');

    Route::post('/orders', 'store');
});
Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employees', 'index')->middleware(['auth'])->name('employees');
    Route::any('/search','search')->name('search');
    Route::get('/employees/add-new', 'create')->name('employees.create');
    //saves employee data to the database
    Route::post('/employees/store','store')->name('employees.store');



    Route::get('/export', 'exportEmployeesToExcel');

    Route::post('/orders', 'store');
    Route::any('/employee/login', 'login')->name('employee.login');
    Route::get('/employee/dashboard', 'dashboard')->name('employee.dashboard');
    Route::get('/employee/calender', 'calender')->name('employee.calender');

    Route::get('/','loginForm')->name('');

    Route::post('/logout')->name('employee.logout');
});
Route::controller(PaymentsController::class)->group(function () {
    Route::get('/employee/payments/history', 'payHistory')->name('employee.payHistory');
    Route::get('/employee/payments/history/{id}', 'payslip')->name('employee.payslip');
    Route::get('/employee/payments/history/{id?}/pdf', 'generatePdf')->name('employee.pdf');


    Route::any('/employees/payments', 'viewEmployeePayments')->name('employees.payments');
    Route::get('/employees/payments/{id?}', 'viewEmployeePayment')->name('employees.payment.view');
    Route::post('/employees/payments/{id?}/{action?}','setPaymentStatus')->name('employees.payment.status');
    Route::get('/employees/payment/create', 'createEmployeePayments')->name('employees.payments.create');
    Route::get('/export/payments/{month?}/{year?}', 'exportPaymentsToExcel');
    Route::get('/employees/payments/create/{employee?}', 'createEmployeePayment')->name('employees.payment.create');
    Route::post('/employees/payments/generate-payslip/{id}/{action?}','storeEmployeePayment')->name('employees.payments.store');
    Route::post('/employees/payments/generate-payslips', 'storeAllEmployeePayments')->name('employees.payments.all.store');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })

require __DIR__.'/auth.php';
