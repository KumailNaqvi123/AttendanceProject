@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold"></h2>
    </div>

    {{-- Tasks Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden w-full">
        <table class="w-full border-collapse table-auto">
            <thead>
                <tr style="background-color:#A9C7F9;" class="text-gray-800">
                    <th class="px-4 py-4 font-medium text-left">#</th>
                    <th class="px-4 py-4 font-medium text-left">Title / Content</th>
                    <th class="px-4 py-4 font-medium text-left">Status</th>
                    <th class="px-4 py-4 font-medium text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $index => $task)
                    @php
                        $rowColor = $index % 2 === 0 ? '#E8F0FE' : '#FFFFFF';
                        $response = $task->response;
                    @endphp
                    <tr style="background-color: {{ $rowColor }};">
                        <td class="px-4 py-4 font-medium text-gray-800">{{ $index + 1 }}</td>
                        <td class="px-4 py-4 text-gray-800">{!! $task->content !!}</td>
                        <td class="px-4 py-4 text-gray-800">
                            @if(!$response)
                                <span class="px-3 py-2 rounded text-yellow-800 bg-yellow-200 font-semibold">Pending 🕘</span>
                            @elseif($response->status === 'approved')
                                <span class="px-3 py-2 rounded text-green-800 bg-green-200 font-semibold">Approved ✔</span>
                            @elseif($response->status === 'rejected')
                                <span class="px-3 py-2 rounded text-red-800 bg-red-200 font-semibold">Rejected ❌</span>
                            @else
                                <span class="px-3 py-2 rounded text-gray-800 bg-gray-200 font-semibold">Submitted ✔</span>
                            @endif
                        </td>
                        <td class="px-4 py-4 text-gray-800">
                            <a href="{{ route('tasks.show', $task->id) }}"
                            class="px-4 py-2 rounded-lg text-white text-sm font-medium shadow transition"
                            style="background-color: #1177D1;">
                            @if(!$response)
                                Submit Response
                            @else
                                View Response
                            @endif
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                            No tasks assigned yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
