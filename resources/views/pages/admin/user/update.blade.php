@extends('layouts.dashboard-layout')

@section('content')
    <div class="container mt-24 p-6 bg-white rounded-lg shadow-lg shadow-gray-200">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Edit User</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow-sm mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users.update', $user->email_222405) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold">Email (cannot be changed)</label>
                <input type="email" name="email" id="email"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ $user->email_222405 }}" disabled>
            </div>

            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-semibold">Name</label>
                <input type="text" name="name" id="name"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('name', $user->name_222405) }}">
                @error('name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold">Password (leave blank to keep
                    current)</label>
                <input type="password" name="password" id="password"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 font-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="role" class="block text-gray-700 font-semibold">Role</label>
                <select name="role" id="role"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Role</option>
                    <option value="customer" {{ old('role', $user->role_222405) == 'customer' ? 'selected' : '' }}>Customer
                    </option>
                    <option value="admin" {{ old('role', $user->role_222405) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="gender" class="block text-gray-700 font-semibold">Gender</label>
                <input type="text" name="gender" id="gender"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('gender', $user->gender_222405) }}">
                @error('gender')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="address" class="block text-gray-700 font-semibold">Address</label>
                <textarea name="address" id="address"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="3">{{ old('address', $user->address_222405) }}</textarea>
                @error('address')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="phone" class="block text-gray-700 font-semibold">Phone</label>
                <input type="text" name="phone" id="phone"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('phone', $user->phone_222405) }}">
                @error('phone')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="birth_date" class="block text-gray-700 font-semibold">Birth Date</label>
                <input type="date" name="birth_date" id="birth_date"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('birth_date', $user->birth_date_222405) }}">
                @error('birth_date')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="profile_photo" class="block text-gray-700 font-semibold">Profile Photo</label>
                <input type="file" name="profile_photo" id="profile_photo"
                    class="mt-1 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                @if ($user->profile_photo_222405)
                    <img src="{{ Str::startsWith($user->profile_photo_222405, 'http') ? $user->profile_photo_222405 : asset('storage/' . $user->profile_photo_222405) }}"
                        alt="Current Profile Photo" class="mt-2 h-32 rounded-lg shadow-md">
                @else
                    <p class="text-gray-500 mt-2">No profile photo available.</p>
                @endif
                @error('profile_photo')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-800">
                    <button type="button"
                        class="bg-gray-300 text-gray-800 py-2 px-6 rounded-lg hover:bg-gray-400 transition duration-200">
                        Back to List
                    </button>
                </a>
                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition duration-200">
                    Update User
                </button>
            </div>
        </form>
    </div>
@endsection
