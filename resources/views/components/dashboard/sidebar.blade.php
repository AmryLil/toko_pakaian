<button x-data @click="$dispatch('toggle-sidebar')"
    class="fixed top-4 left-4 z-50 lg:hidden p-2 bg-white rounded-lg shadow-md border border-gray-200 hover:bg-gray-50 transition-all duration-200">
    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

<!-- Sidebar -->
<aside x-data="{ open: false }" @toggle-sidebar.window="open = !open"
    :class="open ? 'translate-x-0' : '-translate-x-full'"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0">

    <!-- Sidebar Content -->
    <div class="flex flex-col h-full">
        <!-- Logo Section -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-center">
                <h1 class="text-2xl font-bold">
                    <span class="text-slate-800">MAIL</span><span class="text-amber-600">FASHION</span>
                </h1>
            </div>
            <p class="text-center text-sm text-gray-500 mt-2">Admin Dashboard</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 p-4 space-y-2">
            <!-- Profile -->
            <a href="{{ route('admin.profile') }}"
                class="group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-amber-50 hover:text-amber-700 transition-all duration-200 
                {{ request()->routeIs('admin.profile') ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.profile') ? 'text-amber-600' : 'group-hover:text-amber-600' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="font-medium">Profile</span>
            </a>

            <!-- Products -->
            <a href="{{ route('dashboard.products') }}"
                class="group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-amber-50 hover:text-amber-700 transition-all duration-200 
                {{ request()->routeIs('dashboard.products') ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.products') ? 'text-amber-600' : 'group-hover:text-amber-600' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span class="font-medium">Produk</span>
            </a>

            <!-- Categories -->
            <a href="{{ route('dashboard.kategori.index') }}"
                class="group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-amber-50 hover:text-amber-700 transition-all duration-200 
                {{ request()->routeIs('dashboard.kategori.*') ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard.kategori.*') ? 'text-amber-600' : 'group-hover:text-amber-600' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="font-medium">Kategori</span>
            </a>

            <!-- Transactions -->
            <a href="{{ route('admin.transaksi.index') }}"
                class="group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-amber-50 hover:text-amber-700 transition-all duration-200 
                {{ request()->routeIs('admin.transaksi.*') ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.transaksi.*') ? 'text-amber-600' : 'group-hover:text-amber-600' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="font-medium">Transaksi</span>
            </a>

            <!-- User Management -->
            <a href="{{ route('users.index') }}"
                class="group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-amber-50 hover:text-amber-700 transition-all duration-200 
                {{ request()->routeIs('users.*') ? 'bg-amber-50 text-amber-700 border border-amber-200' : '' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('users.*') ? 'text-amber-600' : 'group-hover:text-amber-600' }}"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                <span class="font-medium">Manajemen User</span>
            </a>

            {{-- <!-- Reports -->
            <a href="#"
                class="group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-amber-50 hover:text-amber-700 transition-all duration-200">
                <svg class="w-5 h-5 mr-3 group-hover:text-amber-600" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="font-medium">Laporan</span>
            </a> --}}

        </nav>

    </div>
</aside>
