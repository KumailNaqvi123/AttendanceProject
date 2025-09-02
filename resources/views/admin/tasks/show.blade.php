@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Task Details</h2>

    <div class="border p-3 mb-3">
        <strong>Assigned To:</strong> {{ $task->user->name }} <br>
        <strong>Assigned By:</strong> {{ $task->admin->name }} <br>
        <strong>Created At:</strong> {{ $task->created_at->format('d M Y H:i') }} <br>
        <strong>Status:</strong> {{ ucfirst($task->status) }} <br>

        <hr>
        <strong>Description:</strong>
        <div class="mt-2">{!! $task->content !!}</div>
    </div>

    <h3 class="mt-4">User Response</h3>

    @if($task->response)
        <div class="border p-3 mb-3">
            <p><strong>User:</strong> {{ $task->user->name }}</p>
            <p><strong>Submitted At:</strong> {{ $task->response->created_at->format('d M Y H:i') }}</p>
            <div class="mb-2">{!! $task->response->response !!}</div>


            {{-- Review Buttons --}}
            @if($task->response->status === 'submitted')
                <form action="{{ route('admin.tasks.review', $task->response->id) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                </form>

                <form action="{{ route('admin.tasks.review', $task->response->id) }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                </form>
            @else
                <p><strong>Status:</strong> {{ ucfirst($task->response->status) }}</p>
            @endif
        </div>
    @else
        <p>No response submitted yet.</p>
    @endif
@endsection
