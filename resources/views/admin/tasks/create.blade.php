@extends('layouts.admin')

@section('content')
    <h2>Assign Task</h2>

    <form action="{{ route('admin.tasks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id">Assign To:</label>
            <select name="user_id" id="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="content">Task Content:</label>
            <textarea name="content" id="ckeditor"></textarea>
        </div>

        <button type="submit">Create Task</button>
    </form>

    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('ckeditor');
    </script>
@endsection
