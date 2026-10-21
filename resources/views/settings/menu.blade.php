@extends('layouts.app')

@section('content')
<div class="w-full">
    <!-- Header & Breadcrumb -->
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Menu Settings</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola daftar menu dan struktur navigasi aplikasi.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button id="btnOpenModal" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-violet-600 rounded-md hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500 transition-colors">
                <i class="fa fa-plus mr-2"></i> Add Menu
            </button>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="relative px-4 py-3 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800 flex justify-between items-center" id="alertSuccess">
        <div><i class="fa fa-check-circle mr-2"></i>{{ session('success') }}</div>
        <button type="button" class="text-green-600 hover:text-green-800 dark:text-green-400" onclick="$('#alertSuccess').slideUp()">
            <i class="fa fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Alert Error -->
    @if(session('error') || $errors->any())
    <div class="relative px-4 py-3 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900/30 dark:text-red-400 dark:border-red-800" id="alertError">
        <div class="flex justify-between items-start">
            <div>
                <i class="fa fa-exclamation-circle mr-2"></i>{{ session('error') }}
                @if($errors->any())
                    <ul class="list-disc list-inside mt-2 ml-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <button type="button" class="text-red-600 hover:text-red-800 dark:text-red-400" onclick="$('#alertError').slideUp()">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5 overflow-x-auto">
            <!-- DataTables diaplikasikan ke ID tabel ini -->
            <table id="dataTableMenu" class="w-full text-sm text-left text-gray-600 dark:text-gray-300 display">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200 dark:bg-gray-700/50 dark:text-gray-300 dark:border-gray-700">
                    <tr>
                        <th class="px-4 py-3 font-medium">Name</th>
                        <th class="px-4 py-3 font-medium">URL</th>
                        <th class="px-4 py-3 font-medium text-center">Sort</th>
                        <th class="px-4 py-3 font-medium">Group</th>
                        <th class="px-4 py-3 font-medium text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50/50 dark:border-gray-700 dark:hover:bg-gray-700/50">
                            <td class="px-4 py-2">{{ $item->nmmnu }}</td>
                            <td class="px-4 py-2 font-mono text-xs">{{ $item->urlmnu }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->ordmnu }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs font-medium text-violet-700 bg-violet-100 rounded-md dark:bg-violet-900/30 dark:text-violet-300">
                                    {{ $item->grpmnu }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <form action="{{ route('settings.menu.destroy', $item->idmnu) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-100 rounded hover:bg-red-200 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 transition-colors">
                                        <i class="fa fa-trash-alt mr-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Component (Compact & Standard Tailwind) -->
<div id="modalAdd" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <!-- Modal Dialog -->
        <div class="relative w-full max-w-md p-6 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-xl dark:bg-gray-800 border border-gray-200 dark:border-gray-700">

            <!-- Modal Header -->
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add New Menu</h3>
                <button type="button" id="btnCloseModal" class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none">
                    <i class="fa fa-times text-lg"></i>
                </button>
            </div>

            <!-- Modal Body / Form -->
            <form action="{{ route('settings.menu.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="nmmnu" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">Menu Name</label>
                    <input type="text" name="nmmnu" id="nmmnu" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="e.g. Master Data" required>
                </div>

                <div>
                    <label for="urlmnu" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">URL Path</label>
                    <input type="text" name="urlmnu" id="urlmnu" class="w-full px-3 py-2 font-mono border border-gray-300 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="e.g. /settings/menu" required>
                </div>

                <div>
                    <label for="ordmnu" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">Sort Order</label>
                    <input type="number" name="ordmnu" id="ordmnu" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="1, 2, 3..." required>
                </div>

                <div>
                    <label for="grpmnu" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">Group Menu</label>
                    <select name="grpmnu" id="grpmnu" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white select2">
                        <option value="">-- Select Group --</option>
                        @foreach ($group_menu as $item)
                            <option value="{{ $item->valprm }}">{{ $item->dscprm }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Modal Footer -->
                <div class="pt-4 mt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                    <button type="button" id="btnCancelModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-violet-600 border border-transparent rounded-md shadow-sm hover:bg-violet-700">
                        Save Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#dataTableMenu').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                search: "",
                searchPlaceholder: "Search menu..."
            },
            drawCallback: function () {
                $('.dataTables_filter input').addClass('border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white mb-3 ml-2');
                $('.dataTables_length select').addClass('border border-gray-300 rounded-md px-3 py-1 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white mx-2');
            }
        });


        $('#btnOpenModal').click(function() {
            $('#modalAdd').removeClass('hidden').hide().fadeIn(200);
        });

        $('#btnCloseModal, #btnCancelModal').click(function() {
            $('#modalAdd').fadeOut(200, function() {
                $(this).addClass('hidden');
            });
        });

        $('#modalAdd').click(function(e) {
            if (e.target === this) {
                $(this).fadeOut(200, function() {
                    $(this).addClass('hidden');
                });
            }
        });
    });
</script>
@endsection
