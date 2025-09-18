@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold"></h2>
    </div>

    {{-- Leave Requests Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden w-full">
        <table class="w-full border-collapse table-auto">
            <thead>
                <tr style="background-color:#A9C7F9;" class="text-gray-800">
                    <th class="px-4 py-3 font-medium text-left">SR#</th>
                    <th class="px-4 py-3 font-medium text-left">Reason</th>
                    <th class="px-4 py-3 font-medium text-left">From</th>
                    <th class="px-4 py-3 font-medium text-left">To</th>
                    <th class="px-4 py-3 font-medium text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaves as $index => $leave)
                    @php
                        $rowColor = $index % 2 === 0 ? '#E8F0FE' : '#FFFFFF';
                        $from = \Carbon\Carbon::parse($leave->from_date)->format('d M Y');
                        $to = \Carbon\Carbon::parse($leave->to_date)->format('d M Y');
                    @endphp
                    <tr style="background-color: {{ $rowColor }};">
                        <td class="px-4 py-3 text-gray-800 font-medium">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $leave->reason ?? '—' }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $from }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $to }}</td>
                        <td class="px-4 py-3 text-gray-800">
                            @switch($leave->status)
                                @case('pending')
                                    <span class="px-2 py-1 rounded text-yellow-800 bg-yellow-200 font-semibold">Pending</span>
                                    @break
                                @case('approved')
                                    <span class="px-2 py-1 rounded text-green-800 bg-green-200 font-semibold">Approved</span>
                                    @break
                                @case('rejected')
                                    <span class="px-2 py-1 rounded text-red-800 bg-red-200 font-semibold">Rejected</span>
                                    @break
                                @default
                                    <span class="px-2 py-1 rounded text-gray-800 bg-gray-200 font-semibold">{{ ucfirst($leave->status) }}</span>
                            @endswitch
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                            You haven’t submitted any leave requests yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection