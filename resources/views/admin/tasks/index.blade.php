@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Tasks</h2>
    <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary mb-3">+ Create Task</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Task</th>
                <th>Assigned To</th>
                <th>Status</th>
                <th>Response</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{!! Str::limit($task->content, 50) !!}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>
                        @if($task->status === 'pending')
                            <span class="badge bg-warning">{{ ucfirst($task->status) }}</span>
                        @elseif($task->status === 'completed')
                            <span class="badge bg-info">{{ ucfirst($task->status) }}</span>
                        @elseif($task->status === 'approved')
                            <span class="badge bg-success">{{ ucfirst($task->status) }}</span>
                        @elseif($task->status === 'rejected')
                            <span class="badge bg-danger">{{ ucfirst($task->status) }}</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($task->status) }}</span>
                        @endif
                    </td>
                    <td>
                        {{ $task->response ? '1' : '0' }}
                    </td>
                    <td>
                        <a href="{{ route('admin.tasks.show', $task->id) }}" class="btn btn-sm btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
