@extends('layouts.app')

@section('content')
<h2>Mark Attendance</h2>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div style="color: red;">{{ session('error') }}</div>
@endif

{{--//this one is without the duplicate logic--}}
<form method="POST" action="{{ route('attendance.mark') }}">
    @csrf
    <button type="submit">
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
