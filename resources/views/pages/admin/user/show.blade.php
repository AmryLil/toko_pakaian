@extends('layouts.dashboard-layout')

@section('content')
    <div class="container mx-auto pt-24">
        <h1 class="text-3xl font-semibold mb-6 text-gray-800">Detail User</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <strong>Email:</strong> {{ $user->email_222405 }}
            </div>
            <div class="mb-4">
                <strong>Name:</strong> {{ $user->name_222405 }}
            </div>
            <div class="mb-4">
                <strong>Role:</strong> {{ $user->role_222405 }}
            </div>
            <div class="mb-4">
                <strong>Gender:</strong> {{ $user->gender_222405 }}
            </div>
            <div class="mb-4">
                <strong>Address:</strong> {{ $user->address_222405 }}
            </div>
            <div class="mb-4">
                <strong>Phone:</strong> {{ $user->phone_222405 }}
            </div>
            <div class="mb-4">
                <strong>Birth Date:</strong> {{ $user->birth_date_222405 }}
            </div>
            <div class="mb-4">
                <strong>Profile Photo:</strong><br>
                @if ($user->profile_photo_222405)
                    <img src="{{ Str::startsWith($user->profile_photo_222405, 'http') ? $user->profile_photo_222405 : asset('storage/' . $user->profile_photo_222405) }}"
                        alt="Profile Photo" class="h-48 rounded-lg shadow-md">
                @else
                    <p>No profile photo available.</p>
                @endif
            </div>

            <a href="{{ route('users.index') }}" class="btn btn-primary mt-4">Back to List</a>
        </div>
    </div>
@endsection
