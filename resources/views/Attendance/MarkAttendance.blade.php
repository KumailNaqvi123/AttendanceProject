@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    {{-- Table Header with Title + Button --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Attendance Records</h2>

        <form method="POST" action="{{ route('attendance.mark') }}" id="attendanceForm">
            @csrf
            <button type="submit"
                class="px-5 py-2 rounded-lg text-white font-semibold shadow transition"
                style="background-color: {{ $attendances->first() && $attendances->first()->date == now()->toDateString() ? '#9CA3AF' : '#1177D1' }};"
                @if($attendances->first() && $attendances->first()->date == now()->toDateString()) disabled @endif>
                Mark Attendance
            </button>
        </form>
    </div>

    {{-- Attendance Records Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden w-full">
        <table class="w-full border-collapse table-auto">
            <thead>
                <tr style="background-color:#A9C7F9;" class="text-gray-800">
                    <th class="px-4 py-3 font-medium text-left">SR#</th>
                    <th class="px-4 py-3 font-medium text-left">Day</th>
                    <th class="px-4 py-3 font-medium text-left">Date</th>
                    <th class="px-4 py-3 font-medium text-left">Month</th>
                    <th class="px-4 py-3 font-medium text-left">Year</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $index => $attendance)
                    @php
                        $date = \Carbon\Carbon::parse($attendance->date);
                        $rowColor = $index % 2 === 0 ? '#E8F0FE' : '#FFFFFF';
                    @endphp
                    <tr style="background-color: {{ $rowColor }};">
                        <td class="px-4 py-3 text-gray-800 font-medium text-left">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-gray-800 text-left">{{ $date->format('l') }}</td>
                        <td class="px-4 py-3 text-gray-800 text-left">{{ $date->format('d') }}</td>
                        <td class="px-4 py-3 text-gray-800 text-left">{{ $date->format('F') }}</td>
                        <td class="px-4 py-3 text-gray-800 text-left">{{ $date->format('Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                            No attendance records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- SweetAlert2 Popup Logic --}}
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: "{{ session('success') }}",
        confirmButtonColor: '#1177D1'
    }).then(() => {
        window.location.href = "{{ route('dashboard') }}";
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
    }).then(() => {
        window.location.href = "{{ route('dashboard') }}";
    });
</script>
@endif
@endsection
