@extends('layouts.app')
@section('content')


<div class="mb-4">
    <a href="{{ route('admin.leaves.index') }}" class="btn btn-primary">
        Leave Approval
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('admin.reports.index') }}" class="btn btn-info">
        Attendance Reports
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('admin.tasks.index') }}" class="btn btn-success">
        Task Management
    </a>
</div>
@endsection
