<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth', 'can:access-admin-dashboard')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');


        // Profile Management
        Route::prefix('profile')
            ->name('profile.')
            ->controller(ProfileController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::patch('/', 'update')->name('update');
                Route::patch('/password', 'updatePassword')->name('password');
            });



        // Student
        Route::get('/attendance/student', [AdminDashboardController::class, 'studentAttendanceIndex'])->name('attendance.student');

        // Staff
        Route::get('/attendance/staff', [AdminDashboardController::class, 'staffAttendanceIndex'])->name('attendance.staff');

        // QR Codes — separate pages
        Route::get('/qr/student', [AdminDashboardController::class, 'studentQr'])->name('qr.student');
        Route::get('/qr/staff', [AdminDashboardController::class, 'staffQr'])->name('qr.staff');

        // Maintenance
        Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('maintenance.index');
        Route::post('/maintenance/toggle', [MaintenanceController::class, 'toggle'])->name('maintenance.toggle');
    });
