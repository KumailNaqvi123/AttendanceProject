@extends('layouts.admin')

@section('content')
<h2>Attendance Reports & Grades</h2>

<form method="GET" class="mb-4">
    <select name="student_id">
        <option value="">All Students</option>
        @foreach($students as $student)
        <option value="{{ $student->id }}">{{ $student->name }}</option>
        @endforeach
    </select>

    From: <input type="date" name="from_date">
    To: <input type="date" name="to_date">
    <button type="submit">Filter</button>
</form>

<table class="table-auto border-collapse border border-gray-300">
    <thead>
        <tr>
            <th class="border px-4 py-2">Student</th>
            <th class="border px-4 py-2">Days Present</th>
            <th class="border px-4 py-2">Grade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $grade)
        <tr>
            <td class="border px-4 py-2">{{ $grade['name'] }}</td>
            <td class="border px-4 py-2">{{ $grade['attendance_count'] }}</td>
            <td class="border px-4 py-2">{{ $grade['grade'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
