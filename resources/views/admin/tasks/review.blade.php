@extends('layouts.app')

@section('content')
<h2>Review Response</h2>
<div class="border p-3 mb-3">{!! $response->response !!}</div>

<form action="{{ route('responses.review', $response) }}" method="POST">
    @csrf
    <label>Status:</label>
    <select name="status">
        <option value="approved">Approve</option>
        <option value="rejected">Reject</option>
    </select>

    <label>Feedback:</label>
    <textarea name="feedback"></textarea>

    <button type="submit">Submit Review</button>
</form>
@endsection
