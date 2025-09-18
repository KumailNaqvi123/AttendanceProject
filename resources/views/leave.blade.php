@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 pt-24">
    
    <h2 class="text-2xl font-bold mb-6"></h2>

    {{-- Leave Request Form --}}
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('leave.store') }}" class="space-y-5">
            @csrf

            {{-- From Date --}}
            <div>
                <label for="from_date" class="block text-sm font-medium text-gray-700 mb-1">
                    From Date
                </label>
                <input type="date" id="from_date" name="from_date"
                    class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-2"
                    required>
            </div>

            {{-- To Date --}}
            <div>
                <label for="to_date" class="block text-sm font-medium text-gray-700 mb-1">
                    To Date
                </label>
                <input type="date" id="to_date" name="to_date"
                    class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-2"
                    required>
            </div>

            {{-- Reason --}}
            <div>
                <label for="reason" class="block text-sm font-medium text-gray-700 mb-1">
                    Reason
                </label>
                <textarea id="reason" name="reason" rows="3"
                    class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 p-2"
                    placeholder="Enter your reason" required></textarea>
            </div>

            {{-- Submit --}}
            <div class="pt-2">
                <button type="submit"
                    class="px-6 py-2 rounded-lg text-white font-semibold shadow transition hover:opacity-90 focus:ring-2 focus:ring-blue-400"
                    style="background-color:#1177D1;">
                    Send Leave Request
                </button>
            </div>
        </form>
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
    });
</script>
@endif
@endsection
