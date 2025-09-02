<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\User\TaskController as UserTaskController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;


app('router')->aliasMiddleware('role', RoleMiddleware::class);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ----------------- Attendance -----------------
Route::middleware(['auth'])->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/mark', [AttendanceController::class, 'mark'])->name('attendance.mark');
});

// ----------------- Leave -----------------
Route::middleware(['auth'])->group(function () {
    Route::get('/leave/create', [App\Http\Controllers\LeaveController::class, 'create'])->name('leave.create');
    Route::post('/leave', [App\Http\Controllers\LeaveController::class, 'store'])->name('leave.store');
    Route::get('/leave/status', [App\Http\Controllers\LeaveController::class, 'status'])->name('leave.status');
});

// ----------------- Profile -----------------
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// ----------------- User Task Management -----------------
Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [UserTaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/{task}', [UserTaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks/{task}/submit', [UserTaskController::class, 'submit'])->name('tasks.submit');
});






    // ----------------- Admin Login -----------------
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login']);
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    });

    // ----------------- Protected Admin Routes -----------------
    Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');

    // Leave management
    Route::get('/leaves', [App\Http\Controllers\Admin\LeaveController::class, 'index'])->name('leaves.index');
    Route::get('/leaves/{leave}', [App\Http\Controllers\Admin\LeaveController::class, 'show'])->name('leaves.show');
    Route::post('/leaves/{leave}/approve', [App\Http\Controllers\Admin\LeaveController::class, 'approve'])->name('leaves.approve');
    Route::post('/leaves/{leave}/reject', [App\Http\Controllers\Admin\LeaveController::class, 'reject'])->name('leaves.reject');

    // Attendance reports
    Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');

    // Task Management
    Route::get('/tasks', [AdminTaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [AdminTaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [AdminTaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}', [AdminTaskController::class, 'show'])->name('tasks.show');
    Route::post('/tasks/{response}/review', [AdminTaskController::class, 'review'])->name('tasks.review');
});


// Testing Twilio Integration

// Route::get('/test-whatsapp', function () {
//     $sid = env('TWILIO_SID');
//     $token = env('TWILIO_AUTH_TOKEN');
//     $from = env('TWILIO_WHATSAPP_FROM');
//     $to = 'whatsapp:+923165279519'; // your phone number joined to sandbox

//     $response = Http::withBasicAuth($sid, $token)
//     ->asForm() // important!
//     ->post("https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json", [
//         'From' => $from,
//         'To' => $to,
//         'Body' => 'Hello! This is a test WhatsApp message from Laravel.',
//     ]);

//     dd($response->body());
// });

require __DIR__.'/auth.php';
