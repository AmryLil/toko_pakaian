<!-- Modern Header -->
<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-200/50 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <div
                    class="text-2xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 bg-clip-text text-transparent">
                    MAIL<span class="text-emerald-600">FASHION</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex items-center space-x-1">
                <a href="/"
                    class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                    Beranda
                </a>
                <a href="/shop"
                    class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                    Toko
                </a>
                <a href="/kategori"
                    class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                    Kategori
                </a>
                <a href="{{ route('about') }}"
                    class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                    Tentang Kami
                </a>
                <a href="{{ route('contact_us') }}"
                    class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                    Kontak
                </a>
            </nav>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <!-- Search -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <!-- Search Dropdown -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        @click.away="open = false"
                        class="absolute right-0 top-12 w-80 bg-white rounded-xl shadow-lg border border-gray-200 p-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" placeholder="Cari produk..."
                                class="flex-1 outline-none text-slate-700 placeholder-slate-400">
                            <button
                                class="px-4 py-2 bg-slate-900 text-white text-sm font-medium rounded-lg hover:bg-slate-800 transition-colors">
                                Cari
                            </button>
                        </div>
                    </div>
                </div>

                @if (Auth::check())
                    <!-- User Section - Logged In -->
                    <div class="flex items-center space-x-3">
                        <!-- Cart -->
                        <a href="{{ route('cart.show') }}">
                            <button
                                class="relative p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                <!-- Cart Badge (optional) -->

                            </button>
                        </a>

                        <!-- User Profile Dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 p-1 rounded-lg hover:bg-slate-100 transition-all duration-200">
                                <img class="w-8 h-8 rounded-full border-2 border-emerald-500 object-cover"
                                    src="https://img.freepik.com/premium-vector/man-avatar-profile-picture-vector-illustration_268834-541.jpg"
                                    alt="Profile">
                            </button>

                            <!-- Profile Dropdown -->
                            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95" @click.away="open = false"
                                class="absolute right-0 top-12 w-80 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">

                                <!-- Profile Header -->
                                <div class="p-6 bg-gradient-to-r from-slate-50 to-emerald-50 border-b border-gray-200">
                                    <div class="flex items-center space-x-4">
                                        <img class="w-16 h-16 rounded-full border-4 border-emerald-500 object-cover"
                                            src="https://img.freepik.com/premium-vector/man-avatar-profile-picture-vector-illustration_268834-541.jpg"
                                            alt="Profile">
                                        <div>
                                            <h3 class="text-lg font-semibold text-slate-900">
                                                {{ Auth::user()->name_222405 }}</h3>
                                            <p class="text-sm text-slate-600">{{ Auth::user()->email_222405 }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Menu Items -->
                                <div class="p-2">
                                    <a href="{{ route('pesanan') }}"
                                        class="flex items-center space-x-3 px-4 py-3 text-slate-700 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <span class="text-sm font-medium">Pesanan Saya</span>
                                    </a>

                                    <a href="{{ route('riwayat') }}"
                                        class="flex items-center space-x-3 px-4 py-3 text-slate-700 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                        <span class="text-sm font-medium">Riwayat Pesanan</span>
                                    </a>

                                    <a href="/profile"
                                        class="flex items-center space-x-3 px-4 py-3 text-slate-700 hover:bg-slate-50 hover:text-slate-900 rounded-lg transition-all duration-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        <span class="text-sm font-medium">Profil Saya</span>
                                    </a>

                                    <div class="border-t border-gray-200 my-2"></div>

                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center space-x-3 px-4 py-3 text-red-600 hover:bg-red-50 hover:text-red-700 rounded-lg transition-all duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                                </path>
                                            </svg>
                                            <span class="text-sm font-medium">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- User Section - Not Logged In -->
                    <div class="flex items-center space-x-3">
                        <!-- Login Button -->
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                            Masuk
                        </a>

                        <!-- signup Button -->
                        <a href="{{ route('signup') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-all duration-200">
                            Daftar
                        </a>
                    </div>
                @endif

                <!-- Mobile Menu Button -->
                <button x-data @click="$dispatch('mobile-menu-toggle')"
                    class="md:hidden p-2 text-slate-600 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-data="{ mobileOpen: false }" @mobile-menu-toggle.window="mobileOpen = !mobileOpen" x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden border-t border-gray-200 bg-white">
        <nav class="px-6 py-4 space-y-2">
            <a href="/"
                class="block px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                Beranda
            </a>
            <a href="/shop"
                class="block px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                Toko
            </a>
            <a href="#"
                class="block px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                Kategori
            </a>
            <a href="#"
                class="block px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                Tentang Kami
            </a>
            <a href="#"
                class="block px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                Kontak
            </a>

            @if (Auth::check())
                <!-- Mobile User Menu - Logged In -->
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="flex items-center space-x-3 px-4 py-2 mb-3">
                        <img class="w-10 h-10 rounded-full border-2 border-emerald-500 object-cover"
                            src="https://img.freepik.com/premium-vector/man-avatar-profile-picture-vector-illustration_268834-541.jpg"
                            alt="Profile">
                        <div>
                            <p class="text-sm font-medium text-slate-900">{{ Auth::user()->name_222405 }}</p>
                            <p class="text-xs text-slate-600">{{ Auth::user()->email_222405 }}</p>
                        </div>
                    </div>

                    <a href="{{ route('pesanan') }}"
                        class="block px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                        Pesanan Saya
                    </a>
                    <a href="{{ route('riwayat') }}"
                        class="block px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                        Riwayat Pesanan
                    </a>
                    <a href="#"
                        class="block px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                        Profil Saya
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <!-- Mobile User Menu - Not Logged In -->
                <div class="border-t border-gray-200 pt-4 mt-4 space-y-2">
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-all duration-200">
                        Masuk
                    </a>
                    <a href="{{ route('signup') }}"
                        class="block px-4 py-2 text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg transition-all duration-200 text-center">
                        Daftar
                    </a>
                </div>
            @endif
        </nav>
    </div>
</header>
