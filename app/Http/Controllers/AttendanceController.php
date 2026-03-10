<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // QR Code Generator Page (admin/teacher side)
    public function qrIndex()
    {
        $attendanceUrl = route('attendance.form');
        return view('qr.index', compact('attendanceUrl'));
    }


    // Attendance Form Page (student side — opened via QR scan)
    public function showForm()
    {
        return view('attendance.student');
    }



    // Handle Form Submission
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:20',
            'course'    => 'required|string|max:255',
        ]);

        // Check if already submitted today
        $alreadyMarked = Attendance::where('phone', $validated['phone'])
            ->whereDate('date', Carbon::today())
            ->exists();

        if ($alreadyMarked) {
            return response()->json([
                'success' => false,
                'message' => 'You have already marked attendance today.',
            ], 409);
        }

        Attendance::create([
            ...$validated,
            'date'       => Carbon::today(),
            'time_in'    => Carbon::now()->format('H:i:s'),
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Attendance marked successfully! Welcome, ' . $validated['full_name'] . '.',
        ]);
    }
}
