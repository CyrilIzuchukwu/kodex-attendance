<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class MaintenanceController extends Controller
{
    public function index()
    {
        $isEnabled = Setting::get('maintenance_mode', '0') === '1';
        return view('admin.maintenance', compact('isEnabled'));
    }

    public function toggle()
    {
        $current = Setting::get('maintenance_mode', '0');
        $new = $current === '1' ? '0' : '1';
        Setting::set('maintenance_mode', $new);

        $message = $new === '1'
            ? 'Maintenance mode enabled. Attendance form is now offline.'
            : 'Maintenance mode disabled. Attendance form is back online.';

        return back()->with('success', $message);
    }
}
