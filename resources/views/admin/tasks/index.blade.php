@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold"></h2>
        <a href="{{ route('admin.tasks.create') }}"
           style="background-color: #1177d1;"
           class="px-4 py-2 text-white rounded-lg font-medium shadow text-sm">
            + Create Task
        </a>
    </div>

    {{-- Tasks Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden w-full">
        <table class="w-full border-collapse table-auto">
            <thead class="bg-blue-100 text-gray-800">
                <tr>
                    <th class="px-4 py-4 font-medium text-left">Task</th>
                    <th class="px-4 py-4 font-medium text-left">Assigned To</th>
                    <th class="px-4 py-4 font-medium text-left">Status</th>
                    <th class="px-4 py-4 font-medium text-left">Response</th>
                    <th class="px-4 py-4 font-medium text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $index => $task)
                    @php
                        $rowColor = $index % 2 === 0 ? '#E8F0FE' : '#FFFFFF';
                        $statusColors = [
                            'pending' => 'bg-yellow-200 text-yellow-800',
                            'completed' => 'bg-blue-200 text-blue-800',
                            'approved' => 'bg-green-200 text-green-800',
                            'rejected' => 'bg-red-200 text-red-800',
                        ];
                        $statusClass = $statusColors[$task->status] ?? 'bg-gray-200 text-gray-800';
                    @endphp
                    <tr style="background-color: {{ $rowColor }};">
                        <td class="px-4 py-4 text-gray-800">{!! Str::limit($task->content, 50) !!}</td>
                        <td class="px-4 py-4 text-gray-800">{{ $task->user->name }}</td>
                        <td class="px-4 py-4">
                            <span class="px-2 py-1 rounded font-semibold {{ $statusClass }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-4 text-gray-800">{{ $task->response ? '1' : '0' }}</td>
                        <td class="px-4 py-4">
                            
                            <a href="{{ route('admin.tasks.show', $task->id) }}"
                            style="background-color: #1177d1;"
                            class="px-3 py-1 text-white rounded-lg font-medium text-sm inline-block text-center">
                                View
                            </a>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-3 text-center text-gray-500">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
