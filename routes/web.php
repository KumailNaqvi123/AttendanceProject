<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\Admin\Auth\AdminLoginController;

app('router')->aliasMiddleware('role', RoleMiddleware::class);

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
    Route::get('/leave/status', [App\Http\Controllers\LeaveController::class, 'status'])->name('leave.status');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin
// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin login page
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');

        // Leave management
        Route::get('/leaves', [App\Http\Controllers\Admin\LeaveController::class, 'index'])->name('leaves.index');
        Route::get('/leaves/{leave}', [App\Http\Controllers\Admin\LeaveController::class, 'show'])->name('leaves.show');
        Route::post('/leaves/{leave}/approve', [App\Http\Controllers\Admin\LeaveController::class, 'approve'])->name('leaves.approve');
        Route::post('/leaves/{leave}/reject', [App\Http\Controllers\Admin\LeaveController::class, 'reject'])->name('leaves.reject');

        // Attendance Reports
        Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    });
});

require __DIR__.'/auth.php';