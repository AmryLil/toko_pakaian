@extends('layouts.dashboard-layout')

@section('content')
    <div class="container mx-auto pt-24 px-4">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Edit User</h1>
                <p class="text-gray-600 mt-1">Update informasi pengguna sistem</p>
            </div>
            <a href="{{ route('users.index') }}"
                class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Daftar
            </a>
        </div>

        <!-- Success Alert -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 p-4 rounded-xl mb-6 flex items-center gap-3">
                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-check text-green-600"></i>
                </div>
                <div>
                    <p class="font-medium">Berhasil!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Main Form -->
        <div class="gap-8">
            <!-- Current Profile Preview -->

            <!-- Form Section -->
            <div class="lg:col-span-2">
                <form action="{{ route('users.update', $user->email_222405) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                                <i class="fas fa-user text-blue-500"></i>
                                Informasi Personal
                            </h3>
                        </div>

                        <div class="p-6 space-y-6">
                            <!-- Email (Disabled) -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                    Email Address
                                </label>
                                <input type="email" name="email" id="email"
                                    class="w-full p-4 border border-gray-300 rounded-xl bg-gray-50 text-gray-500 cursor-not-allowed"
                                    value="{{ $user->email_222405 }}" disabled>
                                <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah</p>
                            </div>

                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user text-gray-400 mr-2"></i>
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                    class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    value="{{ old('name', $user->name_222405) }}" onkeyup="updatePreview()">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-user-tag text-gray-400 mr-2"></i>
                                    User Role <span class="text-red-500">*</span>
                                </label>
                                <select name="role" id="role"
                                    class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    onchange="updatePreview()">
                                    <option value="">Pilih Role</option>
                                    <option value="customer"
                                        {{ old('role', $user->role_222405) == 'customer' ? 'selected' : '' }}>Customer
                                    </option>
                                    <option value="admin"
                                        {{ old('role', $user->role_222405) == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div>
                                <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-venus-mars text-gray-400 mr-2"></i>
                                    Gender
                                </label>
                                <select name="gender" id="gender"
                                    class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                    <option value="">Pilih Gender</option>
                                    <option value="male"
                                        {{ old('gender', $user->gender_222405) == 'male' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="female"
                                        {{ old('gender', $user->gender_222405) == 'female' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @error('gender')
                                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Security Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                                <i class="fas fa-lock text-green-500"></i>
                                Keamanan
                            </h3>
                        </div>

                        <div class="p-6 space-y-6">
                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-key text-gray-400 mr-2"></i>
                                    New Password
                                </label>
                                <input type="password" name="password" id="password"
                                    class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Kosongkan jika tidak ingin mengubah password">
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-check-circle text-gray-400 mr-2"></i>
                                    Confirm Password
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Konfirmasi password baru">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                                <i class="fas fa-address-book text-purple-500"></i>
                                Informasi Kontak
                            </h3>
                        </div>

                        <div class="p-6 space-y-6">
                            <!-- Phone -->
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-phone text-gray-400 mr-2"></i>
                                    Phone Number
                                </label>
                                <input type="text" name="phone" id="phone"
                                    class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    value="{{ old('phone', $user->phone_222405) }}"
                                    placeholder="Contoh: +62 812 3456 7890">
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-map-marker-alt text-gray-400 mr-2"></i>
                                    Address
                                </label>
                                <textarea name="address" id="address" rows="3"
                                    class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                                    placeholder="Masukkan alamat lengkap">{{ old('address', $user->address_222405) }}</textarea>
                                @error('address')
                                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Birth Date -->
                            <div>
                                <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-birthday-cake text-gray-400 mr-2"></i>
                                    Birth Date
                                </label>
                                <input type="date" name="birth_date" id="birth_date"
                                    class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    value="{{ old('birth_date', $user->birth_date_222405) }}">
                                @error('birth_date')
                                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Profile Photo Card -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                                <i class="fas fa-camera text-orange-500"></i>
                                Profile Photo
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="flex items-start gap-6">
                                <!-- Current Photo -->
                                <div class="flex-shrink-0">
                                    @if ($user->profile_photo_222405)
                                        <img src="{{ Str::startsWith($user->profile_photo_222405, 'http') ? $user->profile_photo_222405 : asset('storage/' . $user->profile_photo_222405) }}"
                                            alt="Current Profile Photo"
                                            class="w-24 h-24 rounded-xl object-cover border-2 border-gray-200">
                                    @else
                                        <div
                                            class="w-24 h-24 rounded-xl bg-gray-100 flex items-center justify-center border-2 border-gray-200">
                                            <i class="fas fa-user text-gray-400 text-2xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Upload Section -->
                                <div class="flex-1">
                                    <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-2">
                                        Upload New Photo
                                    </label>
                                    <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                                        class="w-full p-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF. Maksimal 2MB</p>
                                    @error('profile_photo')
                                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between gap-4 pt-6">
                        <a href="{{ route('users.index') }}"
                            class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium transition-colors">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>

                        <div class="flex gap-3">
                            <button type="reset"
                                class="flex items-center gap-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-6 py-3 rounded-xl font-medium transition-colors">
                                <i class="fas fa-undo"></i>
                                Reset
                            </button>
                            <button type="submit"
                                class="flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-xl font-medium transition-colors shadow-lg">
                                <i class="fas fa-save"></i>
                                Update User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Update preview in real-time
        function updatePreview() {
            const name = document.getElementById('name').value || '{{ $user->name_222405 }}';
            const role = document.getElementById('role').value || '{{ $user->role_222405 }}';

            document.getElementById('previewName').textContent = name;

            const previewRole = document.getElementById('previewRole');
            previewRole.textContent = role;

            // Update role badge color
            previewRole.className = 'text-white px-3 py-1 rounded-full text-xs font-semibold uppercase ';
            if (role === 'admin') {
                previewRole.className += 'bg-red-500';
            } else if (role === 'customer') {
                previewRole.className += 'bg-blue-500';
            } else {
                previewRole.className += 'bg-gray-500';
            }
        }

        // Preview uploaded photo
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const currentPhoto = document.getElementById('currentPhoto');
                    if (currentPhoto.tagName === 'IMG') {
                        currentPhoto.src = e.target.result;
                    } else {
                        // Replace div with img
                        const img = document.createElement('img');
                        img.id = 'currentPhoto';
                        img.src = e.target.result;
                        img.className = 'w-24 h-24 rounded-full border-4 border-white shadow-lg object-cover';
                        img.alt = 'Profile Photo';
                        currentPhoto.parentNode.replaceChild(img, currentPhoto);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <!-- Include Font Awesome if not already included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
