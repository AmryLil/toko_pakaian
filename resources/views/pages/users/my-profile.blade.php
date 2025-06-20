@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <main class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 ">
        <div class="max-w-6xl mx-auto px-4 pt-5">
            <!-- Header Card -->
            <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden mb-8">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-800"></div>
                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60"
                    xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff"
                    fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="4" /%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]
                    opacity-20"></div>

                <!-- Content -->
                <div class="relative z-10 px-8 py-12">
                    <div class="flex flex-col lg:flex-row items-center gap-8">
                        <!-- Avatar Section -->
                        <div class="relative group">
                            <div
                                class="absolute -inset-4 bg-gradient-to-r from-pink-500 to-violet-500 rounded-full opacity-30 group-hover:opacity-50 transition-all duration-300 blur-lg">
                            </div>
                            {{-- This label correctly points to "avatarInput" which is now inside the form --}}
                            <label for="avatarInput" class="relative cursor-pointer block">
                                <img id="avatarPreview"
                                    class="w-40 h-40 object-cover rounded-full border-4 border-white shadow-2xl transition-transform duration-300 group-hover:scale-105"
                                    src="{{ $user->profile_photo_222405 ? asset('storage/' . $user->profile_photo_222405) : asset('images/produk.png') }}"
                                    alt="Profile Image">
                                <div class="absolute -bottom-2 -right-2 bg-white p-3 rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-0 group-hover:scale-100"
                                    id="iconedit">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </label>
                        </div>

                        <!-- User Info -->
                        <div class="text-center lg:text-left text-white">
                            <h1
                                class="text-4xl lg:text-5xl font-bold mb-2 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                                {{ $user->name_222405 }}
                            </h1>
                            <p class="text-blue-100 text-lg mb-4 flex items-center justify-center lg:justify-start gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $user->address_222405 ?? 'Alamat belum diatur' }}
                            </p>
                            <div class="flex flex-wrap gap-3 justify-center lg:justify-start">
                                <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                                    {{ $user->email_222405 }}
                                </span>
                                @if ($user->phone_222405)
                                    <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium">
                                        {{ $user->phone_222405 }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="lg:ml-auto">
                            <button type="button" id="editBtn"
                                class="px-8 py-3 bg-white text-indigo-600 rounded-full font-semibold hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                    </path>
                                </svg>
                                Edit Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Form Card -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-8">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Personal Information</h2>
                    </div>

                    <form id="profileForm" action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Laravel requires POST method, but we spoof it with PUT/PATCH for updates --}}
                        @method('POST')

                        {{-- THE FIX: The file input is now INSIDE the form --}}
                        <input type="file" id="avatarInput" name="profile_photo" class="hidden" accept="image/*">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Username -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Username
                                </label>
                                <input type="text" name="name" id="username"
                                    class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 disabled:bg-gray-50 disabled:text-gray-500"
                                    value="{{ $user->name_222405 }}" disabled>
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                        </path>
                                    </svg>
                                    Email
                                </label>
                                <input type="email" name="email" id="email"
                                    class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 disabled:bg-gray-50 disabled:text-gray-500"
                                    value="{{ $user->email_222405 }}" disabled>
                            </div>

                            <!-- Address -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Alamat
                                </label>
                                <input type="text" name="address" id="alamat"
                                    class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 disabled:bg-gray-50 disabled:text-gray-500"
                                    value="{{ $user->address_222405 }}" disabled>
                            </div>

                            <!-- Phone -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    Phone
                                </label>
                                <input type="text" name="phone" id="phone"
                                    class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 disabled:bg-gray-50 disabled:text-gray-500"
                                    value="{{ $user->phone_222405 }}" disabled>
                            </div>

                            <!-- Birth Date -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Tanggal Lahir
                                </label>
                                <input type="date" name="birth_date" id="dob"
                                    class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 disabled:bg-gray-50 disabled:text-gray-500"
                                    value="{{ $user->birth_date_222405 }}" disabled>
                            </div>

                            <!-- Gender -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                                        </path>
                                    </svg>
                                    Jenis Kelamin
                                </label>
                                <select id="gender" name="gender"
                                    class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 disabled:bg-gray-50 disabled:text-gray-500"
                                    disabled>
                                    <option value="" disabled {{ !$user->gender_222405 ? 'selected' : '' }}>Pilih
                                        Gender</option>
                                    <option value="male" {{ $user->gender_222405 == 'male' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="female" {{ $user->gender_222405 == 'female' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 mt-8 pt-8 border-t border-gray-200">
                            <button type="submit" id="saveBtn"
                                class="px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-semibold hover:from-green-600 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg hidden flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                            <button type="button" id="cancelBtn"
                                class="px-8 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl font-semibold hover:from-gray-600 hover:to-gray-700 transition-all duration-300 transform hover:scale-105 shadow-lg hidden flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        // Add smooth animations
        document.addEventListener('DOMContentLoaded', function() {
            // Animate elements on load
            const elements = document.querySelectorAll('.space-y-2');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.6s ease';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        document.getElementById('editBtn').addEventListener('click', function() {
            // Enable all input fields with animation
            const inputs = document.querySelectorAll('#profileForm input, #profileForm select');
            inputs.forEach((input, index) => {
                setTimeout(() => {
                    input.removeAttribute('disabled');
                    input.classList.add('animate-pulse');
                    setTimeout(() => input.classList.remove('animate-pulse'), 500);
                }, index * 50);
            });

            // Show save and cancel buttons with animation
            document.getElementById('saveBtn').classList.remove('hidden');
            document.getElementById('cancelBtn').classList.remove('hidden');
            this.classList.add('hidden');

            // Show avatar edit icon
            document.getElementById('iconedit').classList.remove('hidden');

            // Add notification
            showNotification('Edit mode enabled', 'info');
        });

        document.getElementById('cancelBtn').addEventListener('click', function() {
            // Disable all input fields
            document.querySelectorAll('#profileForm input, #profileForm select').forEach(input => {
                input.setAttribute('disabled', true);
            });

            // Show edit button, hide save and cancel buttons
            document.getElementById('editBtn').classList.remove('hidden');
            document.getElementById('saveBtn').classList.add('hidden');
            this.classList.add('hidden');

            // Hide avatar edit icon
            document.getElementById('iconedit').classList.add('hidden');

            // Add notification
            showNotification('Changes cancelled', 'warning');
        });

        document.getElementById('avatarInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('avatarPreview');
                    preview.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        preview.src = e.target.result;
                        preview.style.transform = 'scale(1)';
                    }, 150);
                }
                reader.readAsDataURL(file);
                showNotification('Profile photo updated', 'success');
            }
        });

        // Add form submission animation
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            const saveBtn = document.getElementById('saveBtn');
            saveBtn.innerHTML = `
                <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Saving...
            `;
        });

        // Notification function
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 ${
                type === 'success' ? 'bg-green-500 text-white' :
                type === 'warning' ? 'bg-yellow-500 text-white' :
                type === 'info' ? 'bg-blue-500 text-white' :
                'bg-red-500 text-white'
            }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);

            setTimeout(() => {
                notification.style.transform = 'translateX(full)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Add hover effects to form fields
        document.querySelectorAll('input, select').forEach(field => {
            field.addEventListener('focus', function() {
                this.parentElement.classList.add('transform', 'scale-105');
            });

            field.addEventListener('blur', function() {
                this.parentElement.classList.remove('transform', 'scale-105');
            });
        });
    </script>
@endsection
