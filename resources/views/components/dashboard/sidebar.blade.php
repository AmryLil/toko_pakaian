<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
        </path>
    </svg>
</button>

<aside id="default-sidebar font-jost"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto">


        <div class="bg-white pr-2 rounded-lg flex mt-2 justify-center items-center">
            <div class="text-2xl text-slate-700">
                <h1 class="font-jost text-2xl font-bold text-yellow-700">TERRA SHOP</h1>
            </div>
        </div>
        <ul class="space-y-2 font-medium mt-6 px-5">

            <x-dashboard.menulink path="{{ route('dashboard.products') }}" title="Produk">
                <svg class="group-hover:stroke-[var(--color-yellow-700)]  stroke-black"
                    xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16" fill="none" stroke-linecap="round"
                    stroke-linejoin="round" id="List-Details--Streamline-Tabler" height="20" width="20">
                    <desc>List Details Streamline Icon: https://streamlinehq.com</desc>
                    <path d="M8.125 3.125h5" stroke-width="1"></path>
                    <path d="M8.125 5.625h3.125" stroke-width="1"></path>
                    <path d="M8.125 9.375h5" stroke-width="1"></path>
                    <path d="M8.125 11.875h3.125" stroke-width="1"></path>
                    <path
                        d="M1.875 3.125a0.625 0.625 0 0 1 0.625 -0.625h2.5a0.625 0.625 0 0 1 0.625 0.625v2.5a0.625 0.625 0 0 1 -0.625 0.625H2.5a0.625 0.625 0 0 1 -0.625 -0.625z"
                        stroke-width="1"></path>
                    <path
                        d="M1.875 9.375a0.625 0.625 0 0 1 0.625 -0.625h2.5a0.625 0.625 0 0 1 0.625 0.625v2.5a0.625 0.625 0 0 1 -0.625 0.625H2.5a0.625 0.625 0 0 1 -0.625 -0.625z"
                        stroke-width="1"></path>
                </svg>
            </x-dashboard.menulink>
            <x-dashboard.menulink path="{{ route('dashboard.kategori.index') }}" title="Kategori"><svg
                    class="group-hover:stroke-[var(--color-yellow-700)]  stroke-black"
                    xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16" fill="none" stroke-linecap="round"
                    stroke-linejoin="round" id="Table-Column--Streamline-Tabler" height="20" width="20">
                    <desc>Table Column Streamline Icon: https://streamlinehq.com</desc>
                    <path
                        d="M1.875 3.125a1.25 1.25 0 0 1 1.25 -1.25h8.75a1.25 1.25 0 0 1 1.25 1.25v8.75a1.25 1.25 0 0 1 -1.25 1.25H3.125a1.25 1.25 0 0 1 -1.25 -1.25V3.125z"
                        stroke-width="1"></path>
                    <path d="M6.25 6.25h6.875" stroke-width="1"></path>
                    <path d="M6.25 1.875v11.25" stroke-width="1"></path>
                    <path d="M5.625 1.875 1.875 5.625" stroke-width="1"></path>
                    <path d="m6.25 4.375 -4.375 4.375" stroke-width="1"></path>
                    <path d="m6.25 7.5 -4.375 4.375" stroke-width="1"></path>
                    <path d="m6.25 10.625 -2.5 2.5" stroke-width="1"></path>
                </svg></x-dashboard.menulink>











        </ul>

    </div>

</aside>
