<!-- filepath: resources/views/leave/leave.blade.php -->
@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('leave.store') }}">
        @csrf
        <label>From Date:</label>
        <input type="date" name="from_date" required><br><br>
        <label>To Date:</label>
        <input type="date" name="to_date" required><br><br>
        <label>Reason:</label>
        <input type="text" name="reason" required><br><br>
        <button type="submit">Send Leave Request</button>
    </form>
@endsection