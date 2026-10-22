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
    <style>
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #374151 !important;
            line-height: 38px !important;
        }
        .select2-container--default .select2-results__option {
            color: #374151 !important;
        }

        .select2-container--default .select2-selection--single {
            border-color: #D1D5DB !important;
            border-radius: 5px !important;
            height: 38px !important;
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-800 dark:bg-gray-900 dark:text-gray-200">

    @yield('content-portal')
    {{-- <div class="flex h-screen overflow-hidden">
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
            <main class="p-6">
            </main>

        </div>
    </div> --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                    width: '100%',
                    placeholder: "Ketik untuk mencari...",
                    allowClear: true
                });
        })

    </script>
    @yield('script')
</body>
</html>
