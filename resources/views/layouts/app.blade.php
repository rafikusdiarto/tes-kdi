{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')
            @include('layouts.sidebar')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html> --}}


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '-') }}</title>
    <!-- App favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets-template/images/logo2.png') }}">
    <!-- Layout config Js -->
    <!-- Icons CSS -->


    <!-- Tailwind CSS -->

    <link rel="stylesheet" href="{{ asset('assets-template/css/tailwind2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-template/css/select2.min.css') }}">
    <style>
    /* Styling umum menyamakan border, background, dan tinggi dengan input Tailwind */
    .select2-container .select2-selection--single,
    .select2-container .select2-selection--multiple {
        /* min-height: 42px !important; */
        border-color: #f3f4f6 !important; /* border-gray-100 */
        border-radius: 0.25rem !important; /* rounded */
        background-color: transparent !important;
    }

    /* Menyamakan teks dengan text-sm text-gray-500 */
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        /* line-height: 40px !important; */
        color: #6b7280 !important;
        padding-left: 0.75rem !important;
        padding-right: 0.75rem !important;
        font-size: 0.875rem !important; 
    }

    /* Efek fokus (Outline ungu persis seperti focus:border-violet-500) */
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #8b5cf6 !important;
        box-shadow: none !important;
    }

    .select2-container--default .select2-selection--multiple {
    background-color: #fff;
border: 1px solid rgba(116, 120, 141, 0.28) !important;    border-radius: 4px;
    cursor: text;
    padding-bottom: 6px;
    padding-right: 5px;
    position: relative;
}

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #f3f4f6 !important; /* gray-100 */
        border: 1px solid rgba(116, 120, 141, 0.3) !important;
        color: #374151 !important; /* gray-700 */
        border-radius: 4px !important;
        margin-top: 3px !important;
        margin-left: 5px !important; /* Memberi jarak kiri antar chip */
        padding: 2px 8px !important;
        
        /* 3 Baris ini mencegah chip full ke kanan dan merapikan layout */
        display: inline-flex !important; 
        align-items: center !important; 
        width: fit-content !important; 
        float: left !important; /* Agar chip berjejer ke samping */
    }

    /* Merapikan tombol X (Remove) pada chip agar tidak bertumpuk dengan teks */
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        border-right: none !important; /* Menghilangkan garis vertikal bawaan */
        color: #6b7280 !important; 
        margin-right: 6px !important; /* Jarak antara X dan teks */
        padding: 0 !important; 
        position: static !important; /* Reset posisi bawaan Select2 */
        font-weight: normal !important;
    }
    
    /* Efek saat tombol X disorot (hover) */
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        background-color: transparent !important;
        color: #ef4444 !important; /* Merah */
    }

    /* =========================================
       STYLING UNTUK MODE DARK (dark: class) 
       ========================================= */
    .dark .select2-container .select2-selection--single,
    .dark .select2-container .select2-selection--multiple {
        background-color: rgba(63, 63, 70, 0.5) !important; /* dark:bg-zinc-700/50 */
        border-color: #3f3f46 !important; /* dark:border-zinc-700 */
    }
    
    .dark .select2-container--default .select2-selection--single .select2-selection__rendered,
    .dark .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        color: #f4f4f5 !important; /* dark:text-zinc-100 */
    }

    /* Kotak dropdown (list opsi) di mode Dark */
    .dark .select2-dropdown {
        background-color: #27272a !important; /* dark:bg-zinc-800 */
        border-color: #3f3f46 !important;
    }
    
    .dark .select2-results__option {
        color: #f4f4f5 !important;
    }
    
    .dark .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #8b5cf6 !important; /* ungu */
    }

    /* Kotak pilihan (chip) multi-select di mode Dark */
    .dark .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #52525b !important; /* zinc-600 */
        border-color: #52525b !important;
        color: #f4f4f5 !important;
    }

    /* Warna tombol X (Remove) di mode Dark */
    .dark .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #a1a1aa !important;
    }

    .dark .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        color: #f87171 !important;
    }
</style>
</head>

<body data-mode="light" data-sidebar-size="lg" class="group">

    <!-- ========== Left Sidebar Start ========== -->
    @include('layouts.sidebar')
    <!-- Left Sidebar End -->
    @include('layouts.navigation')

    <div class="main-content group-data-[sidebar-size=sm]:ml-[70px]">
        @yield('content')
    </div>

    <script src="{{ asset('assets-template/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets-template/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets-template/libs/metismenujs/metismenujs.min.js') }}"></script>
    <script src="{{ asset('assets-template/libs/simplebar/simplebar.min.js') }}"></script>

    <script src="{{ asset('assets-template/js/app.js') }}"></script>
    <script src="{{ asset('assets-template/js/jquery-4.0.0.min.js') }}"></script>
    <script src="{{ asset('assets-template/js/select2.min.js') }}"></script>
    @yield('script')
</body>

</html>
