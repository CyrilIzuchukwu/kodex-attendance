<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaffAttendanceController;
use Illuminate\Support\Facades\Route;



// QR Generator (teacher/admin)
Route::get('/qr-generator', [AttendanceController::class, 'qrIndex'])->name('qr.index');

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

// Student Attendance
Route::middleware('maintenance')->group(
    function () {
        Route::get('/attendance/student', [AttendanceController::class, 'showForm'])->name('attendance.form');
        Route::post('/attendance/student', [AttendanceController::class, 'submit'])->name('attendance.submit');
    }
);

// Staff Attendance
Route::middleware('maintenance')->group(function () {
    Route::get('/attendance/staff', [StaffAttendanceController::class, 'showForm'])->name('staff.attendance.form');
    Route::post('/attendance/staff', [StaffAttendanceController::class, 'submit'])->name('staff.attendance.submit');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
