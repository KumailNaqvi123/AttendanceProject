<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Attendance
Route::middleware(['auth'])->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/mark', [AttendanceController::class, 'mark'])->name('attendance.mark');
});

// Leave
Route::middleware(['auth'])->group(function () {
    Route::get('/leave/create', [App\Http\Controllers\LeaveController::class, 'create'])->name('leave.create');
    Route::post('/leave', [App\Http\Controllers\LeaveController::class, 'store'])->name('leave.store');
    Route::get('/leave/status', [App\Http\Controllers\LeaveController::class, 'status'])->name('leave.status'); // 👈 add this
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
