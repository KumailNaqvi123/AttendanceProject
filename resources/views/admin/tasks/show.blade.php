@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    <h2 class="text-2xl font-bold mb-6">Task Details</h2>

    {{-- Task Info --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <p><strong>Assigned To:</strong> {{ $task->user->name }}</p>
        <p><strong>Assigned By:</strong> {{ $task->admin->name }}</p>
        <p><strong>Created At:</strong> {{ $task->created_at->format('d M Y H:i') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>

        {{-- File section --}}
        @if($task->file_id)
            <p><strong>Attached File:</strong> 
                <a href="{{ route('admin.tasks.downloadFile', $task->id) }}" 
                   class="text-blue-600 hover:underline">
                    {{ $task->file_name }}
                </a>
            </p>

            {{-- Inline preview for common file types --}}
            @php
                $ext = strtolower(pathinfo($task->file_name, PATHINFO_EXTENSION));
            @endphp

            @if(in_array($ext, ['jpg','jpeg','png','gif']))
                <div class="mt-3">
                    <img src="{{ asset('storage/tasks/' . $task->id . '/' . $task->file_name) }}" 
                         alt="Preview" class="max-h-64 rounded shadow">
                </div>
            @elseif($ext === 'pdf')
                <div class="mt-3">
                    <iframe src="{{ asset('storage/tasks/' . $task->id . '/' . $task->file_name) }}" 
                            width="100%" height="500" class="rounded shadow"></iframe>
                </div>
            @endif
        @endif

        <hr class="my-3">

        <p><strong>Description:</strong></p>
        <div class="mt-2 text-gray-800">{!! $task->content !!}</div>
    </div>

    {{-- User Response --}}
<h3 class="text-xl font-semibold mb-3">User Response</h3>

@if($task->response)
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <p><strong>User:</strong> {{ $task->user->name }}</p>
        <p><strong>Submitted At:</strong> {{ $task->response->created_at->format('d M Y H:i') }}</p>
        <div class="mt-2 mb-3 text-gray-800">{!! $task->response->response !!}</div>

        {{-- Show attached response file --}}
        @if($task->response->file_id)
            <p class="mt-3">
                <strong>Response File:</strong>
                <a href="{{ route('admin.tasks.downloadResponse', $task->response->id) }}"
                   class="text-[#1A73E8] hover:underline"
                   target="_blank">
                    {{ $task->response->file_name }}
                </a>
            </p>
        @endif

        {{-- Review Buttons --}}
        @if($task->response->status === 'submitted')
            <div style="display: flex; gap: 8px;">
                <form action="{{ route('admin.tasks.review', $task->response->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" style="background-color: #22c55e; color: white; padding: 8px 16px; border-radius: 8px; font-weight: 500; box-shadow: 0 1px 3px rgba(0,0,0,0.2); font-size: 0.875rem;">
                        Accept
                    </button>
                </form>
                
                <form action="{{ route('admin.tasks.review', $task->response->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" style="background-color: #ef4444; color: white; padding: 8px 16px; border-radius: 8px; font-weight: 500; box-shadow: 0 1px 3px rgba(0,0,0,0.2); font-size: 0.875rem;">
                        Reject
                    </button>
                </form>
            </div>
        @else
            <p class="mt-2"><strong>Status:</strong> {{ ucfirst($task->response->status) }}</p>
        @endif
    </div>
@else
    <p class="text-gray-500">No response submitted yet.</p>
@endif

</div>
@endsection
