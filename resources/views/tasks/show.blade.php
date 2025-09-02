@extends('layouts.app')

@section('content')
<h2>Task</h2>
<div class="border p-3 mb-3">{!! $task->content !!}</div>

@if(!$task->response)
<form action="{{ route('tasks.submit', $task) }}" method="POST">
    @csrf
    <label>Your Response:</label>
    <textarea name="response" id="ckeditor"></textarea>
    <button type="submit">Submit Response</button>
</form>
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('ckeditor');
</script>
@else
<p><strong>You already submitted a response.</strong></p>
@endif
@endsection
