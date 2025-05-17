<header
    class="flex top-0 justify-between items-center py-4 px-24 bg-white z-50 bg-gradient-to-r from-cream to-gray-100 w-full fixed font-jost">
    {{-- logo --}}
    <div class="text-2xl font-semibold text-slate-700">
        TERRA SHOP
    </div>



    {{-- menu --}}
    <nav class="space-x-5 text-sm flex ">
        <a href="/"
            class="text-gray-900 hover:text-white {{ Request::is('/') ? 'bg-slate-900 text-white' : '' }} px-4 py-2 "
            style="transition: background-color 0.3s;" onmouseover="this.style.backgroundColor='var(--color-slate-900)';"
            onmouseout="this.style.backgroundColor='';">Beranda</a>

        <a href="/shop"
            class="text-gray-900 hover:text-white {{ Request::is('shop') ? 'bg-slate-900 text-white' : '' }} px-4 py-2 "
            style="transition: background-color 0.3s;"
            onmouseover="this.style.backgroundColor='var(--color-slate-900)';"
            onmouseout="this.style.backgroundColor='';">Toko</a>

        <a href="/kategori"
            class="text-gray-900 hover:text-white {{ Request::is('kategori') ? 'bg-slate-900 text-white' : '' }} px-4 py-2 "
            style="transition: background-color 0.3s;"
            onmouseover="this.style.backgroundColor='var(--color-slate-900)';"
            onmouseout="this.style.backgroundColor='';">Kategori</a>

        <a href="/about"
            class="text-gray-900 hover:text-white {{ Request::is('about') ? 'bg-slate-900 text-white' : '' }} px-4 py-2 "
            style="transition: background-color 0.3s;"
            onmouseover="this.style.backgroundColor='var(--color-slate-900)';"
            onmouseout="this.style.backgroundColor='';">Tentang Kami</a>

        <a href="/contact-us"
            class="text-gray-900 hover:text-white {{ Request::is('contact-us') ? 'bg-slate-900 text-white' : '' }} px-4 py-2 "
            style="transition: background-color 0.3s;"
            onmouseover="this.style.backgroundColor='var(--color-slate-900)';"
            onmouseout="this.style.backgroundColor='';">Kontak</a>
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class=" flex justify-center items-center h-full w-full cursor-pointer hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16" fill="none" stroke="#000000"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"
                    id="Search--Streamline-Feather" height="16" width="16">
                    <desc>Search Streamline Icon: https://streamlinehq.com</desc>
                    <path d="M1.875 6.875a5 5 0 1 0 10 0 5 5 0 1 0 -10 0" stroke-width="1"></path>
                    <path d="m13.125 13.125 -2.71875 -2.71875" stroke-width="1"></path>
                </svg>
            </button>

            <!-- Search Form -->
            <div x-show="open" x-transition class="absolute top-10 right-0 bg-white shadow-md p-2 rounded-md">
                <input type="text" placeholder="Cari..."
                    class="border p-2 rounded-md focus:outline-none focus:ring focus:ring-green-500">
            </div>
        </div>

    </nav>



    {{-- auth --}}
    @if (Auth::check())
        {{-- Jika pengguna sudah login --}}
        <div class="flex gap-2">
            <a href="{{ route('cart.view') }}" class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>

            </a>

            <div class="drawer drawer-end z-50">
                <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">
                    <!-- Page content here -->
                    <label for="my-drawer-4" class="drawer-button ">

                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div
                                class="bg-gradient-to-br from-primary to-secondary text-primary-content rounded-full w-10 h-10 ring ring-primary ring-offset-2 ring-offset-base-100 shadow-lg flex justify-center items-center pt-1">
                                <span
                                    class="text-lg font-bold">{{ preg_match_all('/\b\w/u', Auth::user()->name_222405, $matches) ? strtoupper(implode('', $matches[0])) : '' }}</span>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="drawer-side">
                    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
                    <ul class="text-base-content min-h-full w-96 bg-gradient-to-b from-slate-50 to-white">
                        <!-- Sidebar content here -->
                        <div class="flex flex-col items-center w-full h-screen">
                            <!-- Profile Section -->
                            <div class="w-full max-w-md p-8 text-center">
                                <div class="flex justify-center">
                                    <!-- Avatar with enhanced styling -->
                                    <div
                                        class="w-32 h-32 rounded-full border-4 border-primary flex items-center justify-center bg-gradient-to-br from-primary to-secondary text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                                        <span
                                            class="text-4xl font-bold">{{ preg_match_all('/\b\w/u', Auth::user()->name_222405, $matches) ? strtoupper(implode('', $matches[0])) : '' }}</span>
                                    </div>
                                </div>
                                <h2 class="mt-6 text-2xl font-bold text-slate-800">{{ session('name') }}</h2>
                                <p class="text-slate-500 text-sm mt-1">{{ session('email') }}</p>
                            </div>

                            <!-- Menu Section with refined design -->
                            <div class="w-full max-w-md bg-white rounded-t-3xl shadow-xl p-6 px-8">

                                <!-- Profile Link -->
                                <a href="{{ route('user.profile') }}"
                                    class="flex items-center justify-between py-4 px-3 rounded-xl hover:bg-slate-50 transition-colors duration-200 group mb-2">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="h-5 w-5 text-blue-600">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-700 font-medium group-hover:text-slate-900">Profile Saya
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-hover:text-slate-700" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <!-- Orders Link -->
                                <a href="{{ route('pesanan') }}"
                                    class="flex items-center justify-between py-4 px-3 rounded-xl hover:bg-slate-50 transition-colors duration-200 group mb-2">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center group-hover:bg-green-100 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="h-5 w-5 text-green-600">
                                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z" />
                                                <line x1="3" y1="6" x2="21" y2="6" />
                                                <path d="M16 10a4 4 0 0 1-8 0" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-700 font-medium group-hover:text-slate-900">Pesanan Saya
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-hover:text-slate-700" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <!-- Transaction History Link -->
                                <a href="{{ route('transaksi.index') }}"
                                    class="flex items-center justify-between py-4 px-3 rounded-xl hover:bg-slate-50 transition-colors duration-200 group mb-2">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center group-hover:bg-purple-100 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="h-5 w-5 text-purple-600">
                                                <circle cx="12" cy="12" r="10" />
                                                <polyline points="12 6 12 12 16 14" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-700 font-medium group-hover:text-slate-900">Riwayat
                                            Transaksi</p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-hover:text-slate-700" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <!-- Cart Link -->
                                <a href="{{ route('cart.view') }}"
                                    class="flex items-center justify-between py-4 px-3 rounded-xl hover:bg-slate-50 transition-colors duration-200 group mb-2">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center group-hover:bg-amber-100 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="h-5 w-5 text-amber-600">
                                                <circle cx="9" cy="21" r="1" />
                                                <circle cx="20" cy="21" r="1" />
                                                <path
                                                    d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-700 font-medium group-hover:text-slate-900">Keranjang</p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-slate-400 group-hover:text-slate-700" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>

                                <!-- Logout Button -->
                                <div class="mt-6 pt-4 border-t border-slate-100">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center w-full py-4 px-3 rounded-xl hover:bg-red-50 transition-colors duration-200 group">
                                            <div class="flex items-center space-x-4">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center group-hover:bg-red-100 transition-colors duration-200">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="h-5 w-5 text-red-600">
                                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                                        <polyline points="16 17 21 12 16 7" />
                                                        <line x1="21" y1="12" x2="9"
                                                            y2="12" />
                                                    </svg>
                                                </div>
                                                <p class="text-red-600 font-medium">Logout</p>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    @else
        {{-- Jika pengguna belum login --}}
        <div class="space-x-2">
            <a href="/login" class="text-gray-900 hover:text-black">Login</a>
            <a href="/signup" class="border  py-1 px-4 -lg text-slate-950 ">Register</a>
        </div>
    @endif
</header>
