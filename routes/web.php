<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeScheduleController;

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
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Employee Routes
    |--------------------------------------------------------------------------
    */
    Route::get('employees', [EmployeeController::class, 'index'])->name('employees');
    Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::get('employees/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees.delete');
    Route::get('employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::get('employees/show/{id}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::post('employees/store', [EmployeeController::class, 'store'])->name('employees.store');
    Route::post('employees/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');

    /*
    |--------------------------------------------------------------------------
    | Employee Schedule Routes
    |--------------------------------------------------------------------------
    */
    Route::get('schedules', [EmployeeScheduleController::class, 'index'])->name('schedules');
    Route::get('schedules/create', [EmployeeScheduleController::class, 'create'])->name('schedules.create');
    Route::get('schedules/delete/{id}', [EmployeeScheduleController::class, 'destroy'])->name('schedules.delete');
    Route::get('schedules/edit/{id}', [EmployeeScheduleController::class, 'edit'])->name('schedules.edit');
    Route::get('schedules/show/{id}', [EmployeeScheduleController::class, 'show'])->name('schedules.show');
    Route::post('schedules/store', [EmployeeScheduleController::class, 'store'])->name('schedules.store');
    Route::post('schedules/update/{id}', [EmployeeScheduleController::class, 'update'])->name('schedules.update');
});

