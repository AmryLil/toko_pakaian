@extends('layouts.dashboard-layout')

@section('content')
    <div class="container mx-auto pt-24 px-4">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Detail User</h1>
                <p class="text-gray-600 mt-1">Informasi lengkap pengguna sistem</p>
            </div>
            <a href="{{ route('users.index') }}"
                class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar
            </a>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <!-- Profile Header -->
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 px-6 py-8 text-center">
                        <div class="relative inline-block">
                            @if ($user->profile_photo_222405)
                                <img src="{{ asset('storage/' . $user->profile_photo_222405) }}" alt="Profile Photo"
                                    class="w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover">
                            @else
                                <div
                                    class="w-24 h-24 rounded-full border-4 border-white shadow-lg bg-gray-300 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-600 text-3xl"></i>
                                </div>
                            @endif

                            <!-- Status Badge -->
                            <div
                                class="absolute -bottom-2 -right-2 bg-green-500 w-6 h-6 rounded-full border-2 border-white flex items-center justify-center">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                        </div>

                        <h2 class="text-white text-xl font-bold mt-4">{{ $user->name_222405 }}</h2>
                        <p class="text-blue-100 text-sm">{{ $user->email_222405 }}</p>

                        <!-- Role Badge -->
                        <div class="mt-3">
                            @php
                                $roleColors = [
                                    'admin' => 'bg-red-500',
                                    'user' => 'bg-blue-500',
                                    'manager' => 'bg-green-500',
                                    'default' => 'bg-gray-500',
                                ];
                                $roleColor = $roleColors[$user->role_222405] ?? $roleColors['default'];
                            @endphp
                            <span
                                class="{{ $roleColor }} text-white px-3 py-1 rounded-full text-xs font-semibold uppercase">
                                {{ $user->role_222405 }}
                            </span>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-calendar-alt text-blue-500 text-lg mb-2"></i>
                                <p class="text-xs text-gray-600">Member Since</p>
                                <p class="font-semibold text-gray-800">
                                    {{ $user->created_at ? $user->created_at->format('M Y') : 'N/A' }}</p>
                            </div>
                            <div class="text-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-shield-alt text-green-500 text-lg mb-2"></i>
                                <p class="text-xs text-gray-600">Status</p>
                                <p class="font-semibold text-green-600">Active</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                    <!-- Header -->
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                            <i class="fas fa-user-circle text-blue-500"></i>
                            Informasi Personal
                        </h3>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Personal Info -->
                            <div class="space-y-4">
                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-envelope text-blue-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-600">Email Address</p>
                                        <p class="text-gray-900 font-semibold">{{ $user->email_222405 }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-phone text-green-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-600">Phone Number</p>
                                        <p class="text-gray-900 font-semibold">{{ $user->phone_222405 ?: 'Not provided' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-venus-mars text-purple-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-600">Gender</p>
                                        <p class="text-gray-900 font-semibold capitalize">
                                            {{ $user->gender_222405 ?: 'Not specified' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Additional Info -->
                            <div class="space-y-4">
                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-birthday-cake text-orange-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-600">Birth Date</p>
                                        <p class="text-gray-900 font-semibold">
                                            {{ $user->birth_date_222405 ? \Carbon\Carbon::parse($user->birth_date_222405)->format('d M Y') : 'Not provided' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-user-tag text-red-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-600">User Role</p>
                                        <p class="text-gray-900 font-semibold capitalize">{{ $user->role_222405 }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-clock text-indigo-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-600">Last Updated</p>
                                        <p class="text-gray-900 font-semibold">
                                            {{ $user->updated_at ? $user->updated_at->format('d M Y, H:i') : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Section -->
                        @if ($user->address_222405)
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <div class="flex items-start gap-3 p-4 bg-gray-50 rounded-lg">
                                    <div
                                        class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-teal-600"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-600">Address</p>
                                        <p class="text-gray-900 font-semibold">{{ $user->address_222405 }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex gap-3">
                    <button
                        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2 transition-colors">
                        <i class="fas fa-edit"></i>
                        Edit User
                    </button>
                    <button
                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2 transition-colors">
                        <i class="fas fa-trash"></i>
                        Delete User
                    </button>

                </div>
            </div>
        </div>
    </div>

    <!-- Include Font Awesome if not already included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
