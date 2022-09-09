<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\WageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('employees', [EmployeeController::class, 'create'])->name('employees.create');
Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('employees/{id}', [EmployeeController::class, 'show'])->name('employees.show');
Route::patch('employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::delete('employees/{id}', [EmployeeController::class, 'delete'])->name('employees.delete');

Route::post('wages', [WageController::class, 'create'])->name('wages.create');
Route::get('wages', [WageController::class, 'index'])->name('wages.index');
Route::get('wages/{id}', [WageController::class, 'show'])->name('wages.show');
Route::patch('wages/{id}', [WageController::class, 'update'])->name('wages.update');
Route::delete('wages/{id}', [WageController::class, 'delete'])->name('wages.delete');