@extends('layouts.app')

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
@endsection
