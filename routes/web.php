<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


// // Admin reports
// Route::group(['prefix' => 'admin'], function () {
//     Route::get('/export/excel', [AdminController::class, 'exportExcel'])->name('admin.export.excel');
//     Route::get('/export/pdf', [ReportController::class, 'exportPDF'])->name('admin.export.pdf');
// });
// require __DIR__ . '/auth.php';





// Public routes
// Route::get('/', function () {
//     return view('welcome');
// });

// Registration routes
Route::get('/', [RegistrationController::class, 'create'])->name('registration.create');
Route::prefix('register')->group(function () {
    Route::get('/', [RegistrationController::class, 'create'])->name('registration.create');
    Route::post('/', [RegistrationController::class, 'store'])->name('registration.store');
    // Route::get('/success', [RegistrationController::class, 'success'])->name('registration.success');
    Route::get('/register/success/{attendee_id}', [RegistrationController::class, 'success'])
        ->name('registration.success');
});

// Authentication routes (from Breeze)
require __DIR__ . '/auth.php';

// Protected admin routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/attendees', [AdminController::class, 'index'])->name('admin.attendees.index');
    Route::post('/attendees/{id}/confirm', [AdminController::class, 'confirm'])->name('admin.attendees.confirm');
    Route::get('/export/excel', [AdminController::class, 'exportExcel'])->name('admin.export.excel');
    Route::get('/export/pdf', [ReportController::class, 'exportPDF'])->name('admin.export.pdf');
    Route::get('/attendance/confirm', [AttendanceController::class, 'showForm'])->name('attendance.form');
    Route::post('/attendance/confirm', [AttendanceController::class, 'confirmAttendance'])->name('attendance.confirm');
});

// Attendance confirmation routes
