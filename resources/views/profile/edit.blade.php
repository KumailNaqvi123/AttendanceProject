@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Profile</h2>

        <!-- enctype is required for file upload -->
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <!-- Profile Picture -->
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input id="profile_picture" name="profile_picture" type="file" class="form-control">

                <div class="mt-2">
                    <img src="{{ $user->profile_picture 
                                    ? asset('storage/' . $user->profile_picture) 
                                    : asset('images/default-avatar.png') }}" 
                        alt="Profile Picture" 
                        class="rounded-circle border"
                        width="100" height="100">
                </div>
            </div>


            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control"
                       value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" name="email" type="email" class="form-control"
                       value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Date of Birth -->
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input id="date_of_birth" name="date_of_birth" type="date" class="form-control"
                       value="{{ old('date_of_birth', $user->date_of_birth) }}">
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input id="phone" name="phone" type="text" class="form-control"
                       value="{{ old('phone', $user->phone) }}">
            </div>

            <!-- Address -->
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input id="address" name="address" type="text" class="form-control"
                       value="{{ old('address', $user->address) }}">
            </div>

            <!-- Class -->
            <div class="mb-3">
                <label for="class_name" class="form-label">Class</label>
                <input id="class_name" name="class_name" type="text" class="form-control"
                    value="{{ old('class_name', $user->class_name) }}">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success ms-3">Profile updated!</span>
            @endif
        </form>
    </div>
@endsection
