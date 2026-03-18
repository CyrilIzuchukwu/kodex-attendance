<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\StaffAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    // public function index()
    // {
    //     $today = Carbon::today('Africa/Lagos');

    //     $totalStudents    = Attendance::distinct('phone')->count('phone');
    //     $signedToday      = Attendance::whereDate('date', $today)->count();
    //     $signedThisWeek   = Attendance::whereBetween('date', [
    //         $today->copy()->startOfWeek(),
    //         $today->copy()->endOfWeek()
    //     ])->count();
    //     $latestToday      = Attendance::whereDate('date', $today)
    //         ->orderBy('time_in', 'asc')
    //         ->take(10)
    //         ->get();

    //     return view('admin.index', compact(
    //         'totalStudents',
    //         'signedToday',
    //         'signedThisWeek',
    //         'latestToday'
    //     ));
    // }

    public function index()
    {
        $today = Carbon::today('Africa/Lagos');

        // Students
        $totalStudents  = Attendance::distinct('phone')->count('phone');
        $signedToday    = Attendance::whereDate('date', $today)->count();
        $signedThisWeek = Attendance::whereBetween('date', [
            $today->copy()->startOfWeek(),
            $today->copy()->endOfWeek()
        ])->count();
        $latestToday    = Attendance::whereDate('date', $today)
            ->orderBy('time_in', 'asc')->take(10)->get();

        // Staff
        $totalStaff          = StaffAttendance::distinct('phone')->count('phone');
        $staffSignedToday    = StaffAttendance::whereDate('date', $today)->count();
        $staffLatestToday    = StaffAttendance::whereDate('date', $today)
            ->orderBy('time_in', 'asc')->take(10)->get();

        $staffSignedThisWeek = StaffAttendance::whereBetween('date', [
            $today->copy()->startOfWeek(),
            $today->copy()->endOfWeek()
        ])->count();

        return view('admin.index', compact(
            'totalStudents',
            'signedToday',
            'signedThisWeek',
            'latestToday',
            'totalStaff',
            'staffSignedToday',
            'staffLatestToday',
            'staffSignedThisWeek'
        ));
    }


    public function studentQr()
    {
        $attendanceUrl = route('attendance.form');
        return view('admin.qr.student', compact('attendanceUrl'));
    }

    public function staffQr()
    {
        $attendanceUrl = route('staff.attendance.form');
        return view('admin.qr.staff', compact('attendanceUrl'));
    }




    public function studentAttendanceIndex(Request $request)
    {
        $date = $request->input('date', Carbon::today('Africa/Lagos')->toDateString());
        $attendances = Attendance::whereDate('date', $date)
            ->orderBy('time_in', 'asc')
            ->get();
        return view('admin.attendance.student', compact('attendances', 'date'));
    }


    public function staffAttendanceIndex(Request $request)
    {
        $date = $request->input('date', Carbon::today('Africa/Lagos')->toDateString());
        $attendances = StaffAttendance::whereDate('date', $date)
            ->orderBy('time_in', 'asc')
            ->get();
        return view('admin.attendance.staff', compact('attendances', 'date'));
    }
}
