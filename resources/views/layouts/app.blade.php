<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'VendorPortal') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-200 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        @include('layouts.sidebar')
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
            @include('layouts.navigation')
            <main class="p-6">
                @yield('content')
            </main>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarToggle').on('click', function() {
                $('#sidebar').toggleClass('-translate-x-full');
            });
            $('#profileDropdownBtn').on('click', function(e) {
                e.stopPropagation();
                $('#profileDropdown').toggleClass('hidden');
            });
            $(document).on('click', function() {
                $('#profileDropdown').addClass('hidden');
            });
        });
    </script>

    @yield('script')
</body>
</html>
