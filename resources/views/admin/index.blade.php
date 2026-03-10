@extends('layouts.admin')
@section('content')
<div class="content">

    {{-- Header --}}
    <div class="d-lg-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="mb-1">Dashboard</h2>
            <p class="text-muted mb-0">{{ now('Africa/Lagos')->format('l, F j, Y') }}</p>
        </div>
    </div>

    {{-- Welcome Banner --}}
    <div class="welcome-wrap mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div class="mb-3">
                <h2 class="mb-1 text-white">Welcome Back, {{ Auth::user()->name }}</h2>
                <p class="text-light">Here's what's happening with attendance today.</p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                <a href="{{ route('admin.attendance.student') }}" class="btn btn-light btn-md mb-2">
                    <i class="ti ti-school me-1"></i> Student Attendance
                </a>
                <a href="{{ route('admin.attendance.staff') }}" class="btn btn-light btn-md mb-2">
                    <i class="ti ti-briefcase me-1"></i> Staff Attendance
                </a>
            </div>
        </div>
        <div class="welcome-bg">
            <img src="{{ asset('dashboard_assets/img/bg/welcome-bg-02.svg') }}" alt="" class="welcome-bg-01">
            <img src="{{ asset('dashboard_assets/img/bg/welcome-bg-01.svg') }}" alt="" class="welcome-bg-03">
        </div>
    </div>

    {{-- Student Stat Cards --}}
    <p class="fw-semibold text-muted mb-2 fs-13 text-uppercase" style="letter-spacing:.05em;">
        <i class="ti ti-school me-1"></i> Students
    </p>
    <div class="row mb-2">
        <div class="col-xl-4 col-sm-6 col-12 d-flex">
            <div class="card bg-secondary sale-widget flex-fill">
                <div class="card-body d-flex align-items-center">
                    <span class="sale-icon bg-white text-primary">
                        <i class="ti ti-users fs-24"></i>
                    </span>
                    <div class="ms-2">
                        <p class="text-white mb-1">Total Unique Students</p>
                        <h4 class="text-white">{{ number_format($totalStudents) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12 d-flex">
            <div class="card bg-secondary sale-widget flex-fill">
                <div class="card-body d-flex align-items-center">
                    <span class="sale-icon bg-white text-primary">
                        <i class="ti ti-user-check fs-24"></i>
                    </span>
                    <div class="ms-2">
                        <p class="text-white mb-1">Students Signed In Today</p>
                        <h4 class="text-white">{{ number_format($signedToday) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12 d-flex">
            <div class="card bg-secondary sale-widget flex-fill">
                <div class="card-body d-flex align-items-center">
                    <span class="sale-icon bg-white text-primary">
                        <i class="ti ti-calendar-stats fs-24"></i>
                    </span>
                    <div class="ms-2">
                        <p class="text-white mb-1">Students Signed This Week</p>
                        <h4 class="text-white">{{ number_format($signedThisWeek) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Staff Stat Cards --}}
    <p class="fw-semibold text-muted mb-2 fs-13 text-uppercase" style="letter-spacing:.05em;">
        <i class="ti ti-briefcase me-1"></i> Staff
    </p>
    <div class="row mb-4">
        <div class="col-xl-4 col-sm-6 col-12 d-flex">
            <div class="card bg-primary sale-widget flex-fill">
                <div class="card-body d-flex align-items-center">
                    <span class="sale-icon bg-white text-secondary">
                        <i class="ti ti-users fs-24"></i>
                    </span>
                    <div class="ms-2">
                        <p class="text-white mb-1">Total Unique Staff</p>
                        <h4 class="text-white">{{ number_format($totalStaff) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12 d-flex">
            <div class="card bg-primary sale-widget flex-fill">
                <div class="card-body d-flex align-items-center">
                    <span class="sale-icon bg-white text-secondary">
                        <i class="ti ti-user-check fs-24"></i>
                    </span>
                    <div class="ms-2">
                        <p class="text-white mb-1">Staff Signed In Today</p>
                        <h4 class="text-white">{{ number_format($staffSignedToday) }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12 d-flex">
            <div class="card bg-primary sale-widget flex-fill">
                <div class="card-body d-flex align-items-center">
                    <span class="sale-icon bg-white text-secondary">
                        <i class="ti ti-calendar-stats fs-24"></i>
                    </span>
                    <div class="ms-2">
                        <p class="text-white mb-1">Staff Signed This Week</p>
                        <h4 class="text-white">{{ number_format($staffSignedThisWeek) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Today's Tables: Student + Staff side by side --}}
    <div class="row g-4 mb-4">

        {{-- Students Today --}}
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-inline-flex align-items-center">
                        <span class="title-icon bg-soft-primary fs-16 me-2">
                            <i class="ti ti-school"></i>
                        </span>
                        <h5 class="card-title mb-0">Today's Students</h5>
                        <span class="badge bg-primary ms-2">{{ $signedToday }}</span>
                    </div>
                    <a href="{{ route('admin.attendance.student') }}" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($latestToday->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="ti ti-mood-empty fs-1 d-block mb-2"></i>
                            No students signed in yet today.
                        </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-borderless custom-table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Time In</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestToday as $record)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="avatar avatar-sm bg-primary bg-opacity-10 text-primary fw-bold rounded-circle d-flex align-items-center justify-content-center"
                                                style="width:32px;height:32px;font-size:12px;">
                                                {{ strtoupper(substr($record->full_name, 0, 1)) }}
                                            </span>
                                            <span class="fw-semibold fs-13">{{ $record->full_name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-soft-info text-info">
                                            {{ ucwords(str_replace('-', ' ', $record->course)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-soft-success text-success">
                                            {{ \Carbon\Carbon::parse($record->time_in)->format('g:i A') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Staff Today --}}
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-inline-flex align-items-center">
                        <span class="title-icon bg-soft-warning fs-16 me-2">
                            <i class="ti ti-briefcase"></i>
                        </span>
                        <h5 class="card-title mb-0">Today's Staff</h5>
                        <span class="badge bg-secondary ms-2">{{ $staffSignedToday }}</span>
                    </div>
                    <a href="{{ route('admin.attendance.staff') }}" class="btn btn-sm btn-outline-secondary">
                        View All
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($staffLatestToday->isEmpty())
                        <div class="text-center py-5 text-muted">
                            <i class="ti ti-mood-empty fs-1 d-block mb-2"></i>
                            No staff signed in yet today.
                        </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-borderless custom-table mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Time In</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffLatestToday as $record)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="avatar avatar-sm bg-secondary bg-opacity-10 text-secondary fw-bold rounded-circle d-flex align-items-center justify-content-center"
                                                style="width:32px;height:32px;font-size:12px;">
                                                {{ strtoupper(substr($record->full_name, 0, 1)) }}
                                            </span>
                                            <span class="fw-semibold fs-13">{{ $record->full_name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-soft-warning text-warning">
                                            {{ ucwords(str_replace('-', ' ', $record->designation)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-soft-success text-success">
                                            {{ \Carbon\Carbon::parse($record->time_in)->format('g:i A') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
