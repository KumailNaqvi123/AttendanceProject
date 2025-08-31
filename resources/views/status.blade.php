@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">My Leave Requests</h2>
    @if($leaves->isEmpty())
        <p>You haven’t submitted any leave requests yet.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Reason</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $leave->reason ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->from_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->to_date)->format('d M Y') }}</td>
                        <td>
                            @if($leave->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($leave->status == 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($leave->status == 'rejected')
                                <span class="badge bg-danger">Rejected</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($leave->status) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
