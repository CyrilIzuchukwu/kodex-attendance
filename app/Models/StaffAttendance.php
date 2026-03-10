<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'designation',
        'date',
        'time_in',
        'ip_address'
    ];
}
