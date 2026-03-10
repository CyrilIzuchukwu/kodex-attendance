<?php

namespace App\Http\Controllers;

use App\Models\StaffAttendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffAttendanceController extends Controller
{
    public function showForm()
    {
        return view('attendance.staff');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'full_name'   => 'required|string|max:255',
            'email'       => 'nullable|email|max:255',
            'phone'       => 'required|string|max:20',
            'designation' => 'nullable|string|max:255',
        ]);

        $alreadyMarked = StaffAttendance::where('phone', $validated['phone'])
            ->whereDate('date', Carbon::today('Africa/Lagos'))
            ->exists();

        if ($alreadyMarked) {
            return response()->json([
                'success' => false,
                'message' => 'You have already marked attendance today.',
            ], 409);
        }

        StaffAttendance::create([
            ...$validated,
            'date'       => Carbon::now('Africa/Lagos')->toDateString(),
            'time_in'    => Carbon::now('Africa/Lagos')->format('H:i:s'),
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Attendance marked successfully! Welcome, ' . $validated['full_name'] . '.',
        ]);
    }
}
