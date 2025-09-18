@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    {{-- Page Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold">Create Task</h2>
    </div>

    {{-- Task Form --}}
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.tasks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="user_id" class="block text-gray-700 font-medium mb-1">Assign To:</label>
                <select name="user_id" id="user_id" required class="w-full border rounded-md px-3 py-2">
                    <option value="">Select a user</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-medium mb-1">Task Content:</label>
                <textarea name="content" id="ckeditor" class="w-full border rounded-md p-2"></textarea>
            </div>

            <div class="mb-4">
                <label for="file" class="block text-gray-700 font-medium mb-1">Attach File (optional):</label>
                <input type="file" name="file" id="file" class="w-full border rounded-md px-3 py-2">
            </div>

            <button type="submit"
                style="background-color: #1177d1; color: white;"
                class="px-4 py-2 rounded-lg font-medium shadow">
                Create Task
            </button>
        </form>
    </div>

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
        title: 'Task Created!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#1177D1'
    });
</script>
@endif
@endsection
