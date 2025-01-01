<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IdController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name( 'admin');

Route::get('/student', [App\Http\Controllers\StudentController::class, 'index'])->name('student');
Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');
Route::resource('students', StudentController::class);
Route::resource('employees', EmployeeController::class);
Route::post('/save-edits', [StudentController::class, 'saveEdits'])->name('students.saveEdits');
Route::get('/front/{id}', [IdController::class, 'index']);
