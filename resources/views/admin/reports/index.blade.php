{{-- @extends('layouts.admin')

@section('content')
<h2>Attendance Reports</h2>

<form method="GET" class="mb-4 flex space-x-2">
    <select name="student_id" class="border rounded px-2 py-1">
        <option value="">All Students</option>
        @foreach($students as $student)
        <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
            {{ $student->name }}
        </option>
        @endforeach
    </select>

    <input type="date" name="from_date" value="{{ request('from_date') }}" class="border rounded px-2 py-1">
    <input type="date" name="to_date" value="{{ request('to_date') }}" class="border rounded px-2 py-1">

    <button type="submit" class="bg-indigo-600 text-white px-4 py-1 rounded">Filter</button>
</form>

<table class="min-w-full border border-gray-200">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 border">Student</th>
            <th class="px-4 py-2 border">Date</th>
            <th class="px-4 py-2 border">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendances as $att)
        <tr>
            <td class="px-4 py-2 border">{{ $att->user->name }}</td>
            <td class="px-4 py-2 border">{{ $att->created_at->format('Y-m-d') }}</td>
            <td class="px-4 py-2 border">{{ ucfirst($att->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection --}}

@extends('layouts.admin')

@section('content')
<h2>Attendance Reports</h2>

<form method="GET" class="mb-4 flex space-x-2">
    <select name="student_id" class="border rounded px-2 py-1">
        <option value="">All Students</option>
        @foreach($students as $student)
        <option value="{{ $student->id }}" {{ request('student_id') == $student->id ? 'selected' : '' }}>
            {{ $student->name }}
        </option>
        @endforeach
    </select>

    <input type="date" name="from_date" value="{{ request('from_date') }}" class="border rounded px-2 py-1">
    <input type="date" name="to_date" value="{{ request('to_date') }}" class="border rounded px-2 py-1">

    <button type="submit" class="bg-indigo-600 text-white px-4 py-1 rounded">Filter</button>
</form>

{{-- ✅ Grade Summary Table --}}
<h3 class="mt-6 mb-2 font-semibold">Grade Summary</h3>
<table class="min-w-full border border-gray-200 mb-6">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 border">Student</th>
            <th class="px-4 py-2 border">Total Days</th>
            <th class="px-4 py-2 border">Grade</th>
        </tr>
    </thead>
    <tbody>
        @php
            $grouped = $attendances->groupBy('user.name');
        @endphp

        @foreach($grouped as $student => $records)
            @php
                $count = $records->count();
                if ($count >= 26) {
                    $grade = 'A';
                } elseif ($count >= 20) {
                    $grade = 'B';
                } elseif ($count >= 15) {
                    $grade = 'C';
                } elseif ($count >= 10) {
                    $grade = 'D';
                } else {
                    $grade = 'F';
                }
            @endphp
            <tr>
                <td class="px-4 py-2 border">{{ $student }}</td>
                <td class="px-4 py-2 border">{{ $count }}</td>
                <td class="px-4 py-2 border font-bold">{{ $grade }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- ✅ Detailed Attendance Logs --}}
<h3 class="mt-6 mb-2 font-semibold">Detailed Attendance</h3>
<table class="min-w-full border border-gray-200">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 border">Student</th>
            <th class="px-4 py-2 border">Date</th>
            <th class="px-4 py-2 border">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendances as $att)
        <tr>
            <td class="px-4 py-2 border">{{ $att->user->name }}</td>
            <td class="px-4 py-2 border">{{ $att->created_at->format('Y-m-d') }}</td>
            <td class="px-4 py-2 border">{{ ucfirst($att->status) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
