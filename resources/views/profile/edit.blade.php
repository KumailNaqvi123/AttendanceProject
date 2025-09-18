@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4">

    {{-- Page Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold"></h2>
    </div>

    {{-- Profile Form Card --}}
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            {{-- Profile Picture --}}
            <div class="mb-4">
                <label for="profile_picture" class="block font-medium text-gray-700 mb-2">Profile Picture</label>
                <input id="profile_picture" name="profile_picture" type="file" class="border rounded-md w-full p-2">

                <div class="mt-3">
                    <img src="{{ $user->profile_picture 
                                    ? asset('storage/' . $user->profile_picture) 
                                    : asset('images/default-avatar.png') }}" 
                        alt="Profile Picture" 
                        class="rounded-full border"
                        width="100" height="100">
                </div>
            </div>

            {{-- Name --}}
            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700 mb-2">Name</label>
                <input id="name" name="name" type="text" class="border rounded-md w-full p-2"
                       value="{{ old('name', $user->name) }}" required>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700 mb-2">Email</label>
                <input id="email" name="email" type="email" class="border rounded-md w-full p-2"
                       value="{{ old('email', $user->email) }}" required>
            </div>

            {{-- Date of Birth --}}
            <div class="mb-4">
                <label for="date_of_birth" class="block font-medium text-gray-700 mb-2">Date of Birth</label>
                <input id="date_of_birth" name="date_of_birth" type="date" class="border rounded-md w-full p-2"
                       value="{{ old('date_of_birth', $user->date_of_birth) }}">
            </div>

            {{-- Phone --}}
            <div class="mb-4">
                <label for="phone" class="block font-medium text-gray-700 mb-2">Phone</label>
                <input id="phone" name="phone" type="text" class="border rounded-md w-full p-2"
                       value="{{ old('phone', $user->phone) }}">
            </div>

            {{-- Address --}}
            <div class="mb-4">
                <label for="address" class="block font-medium text-gray-700 mb-2">Address</label>
                <input id="address" name="address" type="text" class="border rounded-md w-full p-2"
                       value="{{ old('address', $user->address) }}">
            </div>

            {{-- Class --}}
            <div class="mb-6">
                <label for="class_name" class="block font-medium text-gray-700 mb-2">Class</label>
                <input id="class_name" name="class_name" type="text" class="border rounded-md w-full p-2"
                    value="{{ old('class_name', $user->class_name) }}">
            </div>

            <button type="submit" 
                    class="px-4 py-2 text-white rounded-lg font-medium shadow transition" 
                    style="background-color: #1177D1; hover: background-color: #0f66b8;">
                Save
            </button>

        </form>
    </div>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('status') === 'profile-updated')
<script>
    Swal.fire({
        icon: 'success',
        title: 'Profile Updated',
        text: 'Your profile has been successfully updated!',
        confirmButtonColor: '#1177D1'
    });
</script>
@endif
@endsection
