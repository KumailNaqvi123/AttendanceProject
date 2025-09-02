@extends('layouts.admin') <!-- your admin layout -->

@section('content')
<h2>Leave Requests</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Student</th>
            <th>From</th>
            <th>To</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($leaves as $leave)
        <tr>
            <td>{{ $leave->user->name }}</td>
            <td>{{ $leave->from_date }}</td>
            <td>{{ $leave->to_date }}</td>
            <td>{{ $leave->reason }}</td>
            <td>{{ $leave->status }}</td>
            <td>
                @if($leave->status === 'Pending')
                <form method="POST" action="{{ route('admin.leaves.approve', $leave) }}" style="display:inline;">
                    @csrf
                    <button class="btn btn-success btn-sm">Approve</button>
                </form>
                <form method="POST" action="{{ route('admin.leaves.reject', $leave) }}" style="display:inline;">
                    @csrf
                    <button class="btn btn-danger btn-sm">Reject</button>
                </form>
                @else
                N/A
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
