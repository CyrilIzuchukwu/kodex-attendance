@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="page-header">
        <div class="page-title">
            <h4 class="fw-bold">Staff Attendance</h4>
            <h6>Showing records for {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</h6>
        </div>
        <ul class="table-top-head">
            <li>
                <a href="{{ route('admin.attendance.staff') }}" data-bs-toggle="tooltip" title="Refresh">
                    <i class="ti ti-refresh"></i>
                </a>
            </li>
        </ul>
    </div>

    {{-- Date Filter --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.attendance.staff') }}"
                class="d-flex align-items-center gap-3 flex-wrap">
                <div class="input-icon-start position-relative">
                    <span class="input-icon-addon fs-16 text-gray-9">
                        <i class="ti ti-calendar"></i>
                    </span>
                    <input type="date" name="date" class="form-control"
                        value="{{ $date }}"
                        max="{{ now('Africa/Lagos')->toDateString() }}">
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="ti ti-search me-1"></i> Filter
                </button>
                <a href="{{ route('admin.attendance.staff', ['date' => now('Africa/Lagos')->subDay()->toDateString()]) }}"
                    class="btn btn-outline-secondary btn-sm">Yesterday</a>
                <a href="{{ route('admin.attendance.staff', ['date' => now('Africa/Lagos')->startOfWeek()->toDateString()]) }}"
                    class="btn btn-outline-secondary btn-sm">This Week</a>
                <a href="{{ route('admin.attendance.staff') }}"
                    class="btn btn-outline-primary btn-sm">Today</a>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">
                Sign-Ins
                <span class="badge bg-primary ms-2">{{ $attendances->count() }}</span>
            </h5>
        </div>
        <div class="card-body p-0">
            @if($attendances->isEmpty())
                <div class="text-center py-5 text-muted">
                    <i class="ti ti-mood-empty fs-1 d-block mb-2"></i>
                    No staff attendance records found for this date.
                </div>
            @else
            <div class="table-responsive">
                <table class="table table-borderless custom-table mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Staff Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Designation</th>
                            <th>Time In</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $i => $record)
                        <tr>
                            <td class="text-muted fs-13">{{ $i + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="avatar avatar-sm bg-secondary bg-opacity-10 text-secondary fw-bold rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:34px;height:34px;font-size:13px;">
                                        {{ strtoupper(substr($record->full_name, 0, 1)) }}
                                    </span>
                                    <span class="fw-semibold">{{ $record->full_name }}</span>
                                </div>
                            </td>
                            <td class="text-muted">{{ $record->phone }}</td>
                            <td class="text-muted">{{ $record->email ?? '—' }}</td>
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
@endsection
