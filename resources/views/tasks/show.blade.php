@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    {{-- Page Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold">Task Details</h2>
    </div>

    {{-- Task Content --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <h3 class="font-semibold text-gray-700 mb-2">Task:</h3>
        <div class="text-gray-800 whitespace-pre-line">{!! $task->content !!}</div>

        {{-- Admin attached file --}}
        @if($task->file_id)
        <p class="mt-2">
            <strong>Task File:</strong>
            <a href="{{ route('tasks.downloadFile', $task->id) }}"
               class="text-[#1A73E8] hover:underline"
               target="_blank">
               {{ $task->file_name }}
            </a>
        </p>
        @endif
    </div>

    {{-- Response Form / Display --}}
    @if(!$task->response)
    <div class="bg-white rounded-lg shadow p-4">
        <h3 class="font-semibold text-gray-700 mb-2">Submit Your Response:</h3>
        <form action="{{ route('tasks.submit', $task) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- CKEditor Text --}}
            <textarea name="response" id="ckeditor" class="w-full border rounded-md p-2 mb-4"></textarea>

            {{-- Optional File Upload --}}
            <div class="mb-4">
                <label for="file" class="block font-medium text-gray-700 mb-1">Attach File (optional)</label>
                <input type="file" name="file" id="file" class="border rounded-md p-2 w-full">
            </div>

            <button type="submit"
                class="px-4 py-2 text-white rounded-lg font-medium shadow transition"
                style="background-color: #1177D1;">
                Submit Response
            </button>
        </form>
    </div>
    @else
    <div class="bg-white rounded-lg shadow p-4">
        <p class="text-gray-700 font-medium">You have already submitted a response.</p>
        <div class="mt-2 text-gray-800 whitespace-pre-line">{!! $task->response->response ?? '' !!}</div>

        {{-- User response file --}}
        @if($task->response->file_id)
        <p class="mt-2">
            <strong>Attached File:</strong>
            <a href="{{ route('tasks.downloadResponse', $task->response->id) }}"
               class="text-[#1A73E8] hover:underline"
               target="_blank">
               {{ $task->response->file_name }}
            </a>
        </p>
        @endif
    </div>
    @endif

</div>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('ckeditor');
</script>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        confirmButtonColor: '#1177D1'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "{{ session('error') }}",
        confirmButtonColor: '#1177D1'
    });
</script>
@endif
@endsection
