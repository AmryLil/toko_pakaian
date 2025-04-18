<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Lumbung Pangan Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-jost">
    <!-- Sidebar -->
    <x-dashboard.sidebar />

    <!-- Header -->
    <x-dashboard.header>
        @yield('header')
    </x-dashboard.header>

    <!-- Main Content -->
    <div class="py-2 px-3 pt-0 sm:ml-64 shadow-md min-h-screen max-h-full">
        <div class="p-3 h">
            @yield('content')
        </div>
    </div>
    @yield('scripts')
    <script src="{{ asset('js/handleModalProduct.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
</body>

</html>
