<!-- filepath: resources/views/attendance/index.blade.php -->
@extends('layouts.app')

@section('content')
    @if(session('success')) <div>{{ session('success') }}</div> @endif
    @if(session('error')) <div>{{ session('error') }}</div> @endif

    <form method="POST" action="{{ route('attendance.mark') }}">
        @csrf
        <button type="submit"
            @if($attendances->first() && $attendances->first()->date == now()->toDateString()) disabled @endif>
            Mark Attendance
        </button>
    </form>

    <h3>Your Attendance Records</h3>
    <ul>
        @foreach($attendances as $attendance)
            <li>{{ $attendance->date }}</li>
        @endforeach
    </ul>
@endsection