@extends('layouts.dashboard-layout')

@section('content')
    <div class="container mx-auto pt-24">
        <form class="bg-white p-6 rounded-lg shadow-md" action="{{ route('users.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <h1 class="text-3xl font-semibold text-gray-800 mb-6">Tambah User</h1>

            <div class="mb-6">
                <label for="email" class="block text-lg font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('email') }}">
                @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Name</label>
                <input type="text" name="name"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('name') }}">
                @error('name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-lg font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-lg font-medium text-gray-700 mb-2">Confirm
                    Password</label>
                <input type="password" name="password_confirmation"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="role" class="block text-lg font-medium text-gray-700 mb-2">Role</label>
                <select name="role"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Pilih Role</option>
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="gender" class="block text-lg font-medium text-gray-700 mb-2">Gender</label>
                <input type="text" name="gender"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('gender') }}">
                @error('gender')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="address" class="block text-lg font-medium text-gray-700 mb-2">Address</label>
                <textarea name="address"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="3">{{ old('address') }}</textarea>
                @error('address')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="phone" class="block text-lg font-medium text-gray-700 mb-2">Phone</label>
                <input type="text" name="phone"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('phone') }}">
                @error('phone')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="birth_date" class="block text-lg font-medium text-gray-700 mb-2">Birth Date</label>
                <input type="date" name="birth_date"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('birth_date') }}">
                @error('birth_date')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-6">
                <label for="profile_photo" class="block text-lg font-medium text-gray-700 mb-2">Profile Photo</label>
                <input type="file" name="profile_photo"
                    class="border border-gray-300 p-3 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
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
                    class="bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Simpan User
                </button>
            </div>
        </form>
    </div>
@endsection
