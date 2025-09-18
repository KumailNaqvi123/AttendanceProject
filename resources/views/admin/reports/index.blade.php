@extends('layouts.app')

@section('content')
@php
    $grouped = $attendances->groupBy('user.name');
@endphp

<div class="max-w-5xl mx-auto py-10 px-4">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold"></h2>
    </div>

    {{-- Filter Form --}}
<form method="GET" class="mb-6">

    <div class="flex flex-wrap gap-3">

        <!-- Student Dropdown -->
        <div class="flex flex-col">
            <label class="text-gray-700 text-sm mb-1">Student</label>
            <select name="student_id" class="border rounded px-3 py-1 h-9 w-56">
                <option value="">All Students</option>
                @foreach($grouped as $student => $records)
                    <option value="{{ $records->first()->user->id }}" {{ request('student_id') == $records->first()->user->id ? 'selected' : '' }}>
                        {{ $student }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- From Date -->
        <div class="flex flex-col">
            <label class="text-gray-700 text-sm mb-1">From</label>
            <input type="date" name="from_date" value="{{ request('from_date') }}" class="border rounded px-3 py-1 h-9">
        </div>

        <!-- To Date -->
        <div class="flex flex-col">
            <label class="text-gray-700 text-sm mb-1">To</label>
            <input type="date" name="to_date" value="{{ request('to_date') }}" class="border rounded px-3 py-1 h-9">
        </div>

    </div>

    <!-- Filter Button on its own row -->
    <div class="mt-3">
        <button type="submit" style="background-color: #1177d1; height:36px; padding:0 12px; color:white; border-radius:6px; font-weight:500;">
            Filter
        </button>
    </div>

</form>




    {{-- Grade Summary Table --}}
    <h3 class="mt-6 mb-2 font-semibold">Grade Summary</h3>
    <div class="bg-white rounded-lg shadow overflow-hidden w-full mb-6">
        <table class="w-full border-collapse table-auto">
            <thead>
                <tr class="bg-blue-100 text-gray-800">
                    <th class="px-4 py-3 font-medium text-left">Student</th>
                    <th class="px-4 py-3 font-medium text-left">Total Days</th>
                    <th class="px-4 py-3 font-medium text-left">Grade</th>
                </tr>
            </thead>
            <tbody>


@forelse($grouped as $records)
    @php
        $student = $records->first()->user->name;
        $count = $records->count();
        $grade = $count >= 26 ? 'A' :
                 ($count >= 20 ? 'B' :
                 ($count >= 15 ? 'C' :
                 ($count >= 10 ? 'D' : 'F')));
        $rowColor = $loop->iteration % 2 === 0 ? '#E8F0FE' : '#FFFFFF';
    @endphp
    <tr style="background-color: {{ $rowColor }};">
        <td class="px-4 py-3 text-gray-800">{{ $student }}</td>
        <td class="px-4 py-3 text-gray-800">{{ $count }}</td>
        <td class="px-4 py-3 text-gray-800 font-semibold">{{ $grade }}</td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="px-4 py-3 text-center text-gray-500">No records found.</td>
    </tr>
@endforelse

            </tbody>
        </table>
    </div>

    {{-- Detailed Attendance Table --}}
    <h3 class="mt-6 mb-2 font-semibold">Detailed Attendance</h3>
    <div class="bg-white rounded-lg shadow overflow-hidden w-full">
        <table class="w-full border-collapse table-auto">
            <thead>
                <tr class="bg-blue-100 text-gray-800">
                    <th class="px-4 py-3 font-medium text-left">Student</th>
                    <th class="px-4 py-3 font-medium text-left">Date</th>
                    <th class="px-4 py-3 font-medium text-left">Status</th>
                </tr>
            </thead>
            <tbody>
@forelse($attendances as $att)
    @php
        $rowColor = $loop->iteration % 2 === 0 ? '#E8F0FE' : '#FFFFFF';
    @endphp
    <tr style="background-color: {{ $rowColor }};">
        <td class="px-4 py-3 text-gray-800">{{ $att->user->name }}</td>
        <td class="px-4 py-3 text-gray-800">{{ $att->created_at->format('Y-m-d') }}</td>
        <td class="px-4 py-3 text-gray-800">{{ ucfirst($att->status) }}</td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="px-4 py-3 text-center text-gray-500">No attendance records found.</td>
    </tr>
@endforelse

            </tbody>
        </table>
    </div>

</div>
@endsection
