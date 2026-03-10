@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="mb-4">
        <h2 class="mb-1">Maintenance Mode</h2>
        <p class="text-muted">Control public access to the student attendance form.</p>
    </div>

    <div class="card border-0 shadow-sm" style="max-width: 500px;">
        <div class="card-body p-4">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h5 class="mb-1">Attendance Form</h5>
                    <p class="text-muted fs-13 mb-0">
                        When enabled, students will see a maintenance page instead of the form.
                    </p>
                </div>
                <span class="badge {{ $isEnabled ? 'bg-danger' : 'bg-success' }} fs-13 ms-3">
                    {{ $isEnabled ? 'Offline' : 'Online' }}
                </span>
            </div>

            <div class="alert {{ $isEnabled ? 'alert-danger' : 'alert-success' }} d-flex align-items-center">
                <i class="ti ti-{{ $isEnabled ? 'alert-triangle' : 'circle-check' }} me-2 fs-16"></i>
                <span>
                    Attendance form is currently <strong>{{ $isEnabled ? 'offline' : 'online' }}</strong>.
                </span>
            </div>

            <form method="POST" action="{{ route('admin.maintenance.toggle') }}">
                @csrf
                <button type="submit"
                    class="btn w-100 {{ $isEnabled ? 'btn-success' : 'btn-danger' }}">
                    <i class="ti ti-power me-1"></i>
                    {{ $isEnabled ? 'Disable Maintenance Mode' : 'Enable Maintenance Mode' }}
                </button>
            </form>

        </div>
    </div>

</div>
@endsection
