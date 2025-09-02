@extends('layouts.app')
@section('content')

<div class="mb-4">
    <a href="{{ route('attendance.index') }}" class="btn btn-primary">
        Mark Attendance
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('leave.create') }}" class="btn btn-info">
        Create Leave Request
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('leave.status') }}" class="btn btn-success">
        Check Leave Status
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('tasks.index') }}" class="btn btn-warning">
        My Tasks
    </a>
@endsection

{{--@extends('layouts.app')
@section('content')

    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <a href="{{ route('attendance.index') }}">
            <button>Mark Attendance</button>
        </a>
        <a href="{{ route('leave.create') }}">
            <button>Mark Leave</button>
        </a>
        <a href="{{ route('leave.status') }}">
            <button>View Leave Status</button>
    </div>
@endsection --}}
