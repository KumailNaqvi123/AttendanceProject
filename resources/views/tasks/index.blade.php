@extends('layouts.app')

@section('content')

<div class="card mt-4">
    <div class="card-header">
        <h4>My Tasks</h4>
    </div>
    <div class="card-body">
        @if($tasks->isEmpty())
            <p>No tasks assigned yet.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title / Content</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        @php
                            $response = $task->response; // Use singular relationship
                        @endphp
                        <tr>
                            <td>{!! $task->content !!}</td>
                            <td>
                                @if(!$response)
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($response->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($response->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Submitted</span>
                                @endif
                            </td>
                            <td>
                                @if(!$response)
                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-primary">
                                        Submit Response
                                    </a>
                                @else
                                    <span class="text-muted">Response Submitted</span>
                                @endif
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
