@extends('layouts.app')

@section('content')
<div class="w-full">
    <!-- Header & Breadcrumb -->
    <div class="flex flex-col justify-between mb-6 md:flex-row md:items-center">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Penawaran Supplier</h2>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="relative flex items-center justify-between px-4 py-3 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800" id="alertSuccess">
        <div><i class="mr-2 fa fa-check-circle"></i>{{ session('success') }}</div>
        <button type="button" class="text-green-600 hover:text-green-800 dark:text-green-400" onclick="$('#alertSuccess').slideUp()">
            <i class="fa fa-times"></i>
        </button>
    </div>
    @endif

    @if(session('error') || $errors->any())
    <div class="relative px-4 py-3 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900/30 dark:text-red-400 dark:border-red-800" id="alertError">
        <div class="flex items-start justify-between">
            <div>
                <i class="mr-2 fa fa-exclamation-circle"></i>{{ session('error') }}
                @if($errors->any())
                    <ul class="mt-2 ml-4 list-disc list-inside">
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

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-5 overflow-x-auto">
            <table id="dataTableUom" class="w-full text-sm text-left text-gray-600 display dark:text-gray-300">
                <thead class="text-xs text-gray-700 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-700/50 dark:text-gray-300 dark:border-gray-700">
                    <tr>
                        <th class="w-16 px-4 py-3 font-medium text-center">No</th>
                        <th class="px-4 py-3 font-medium">Supplier/Address</th>
                        <th class="w-32 px-4 py-3 font-medium text-center">Sales Name</th>
                        <th class="w-32 px-4 py-3 font-medium text-center">No/Email</th>
                        <th class="w-32 px-4 py-3 font-medium text-center">Product</th>
                        <th class="w-32 px-4 py-3 font-medium text-center">Qty</th>
                        <th class="w-32 px-4 py-3 font-medium text-center">Satuan</th>
                        <th class="w-32 px-4 py-3 font-medium text-center">Satuan Supplier</th>
                        <th class="w-32 px-4 py-3 font-medium text-center">Harga Satuan</th>
                        <th class="w-32 px-4 py-3 font-medium text-center">Harga Satuan Supplier</th>
                        <th class="w-32 px-4 py-3 font-medium text-center">PPN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $index => $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50/50 dark:border-gray-700 dark:hover:bg-gray-700/50">
                            <td class="px-4 py-2 text-center">{{ $item->idofr }}</td>
                            <td class="px-4 py-2 text-left">{{ $item->vendors->nmvend ?? '~' }} / {{ $item->vendors->adrvend ?? '~' }}</td>
                            <td class="px-4 py-2 text-left">{{ $item->nmsales ?? '~' }}</td>
                            <td class="px-4 py-2 text-left">{{ $item->nosales ?? '~' }} / {{ $item->email ?? '~' }}</td>
                            <td class="px-4 py-2 text-left">{{ $item->products->nmprod ?? '~' }}</td>
                            <td class="px-4 py-2 text-left">{{ $item->qty ?? '~' }}</td>
                            <td class="px-4 py-2 text-left">{{ $item->uom->nmuom ?? '~' }}</td>
                            <td class="px-4 py-2 text-left">{{ $item->exuom ?? '~' }}</td>
                            <td class="px-4 py-2 text-left">
                                @if($item->exuom != "")
                                    @currency($item->price/$item->qty)
                                @else
                                    ~
                                @endif
                            </td>
                            <td class="px-4 py-2 text-left">@currency($item->price ?? 0)</td>
                            <td class="px-4 py-2 text-left">{{ $item->ppn ?? '~' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function() {

        // Datatables & Modal Close Events
        $('#dataTableUom').DataTable({
            responsive: true,
            pageLength: 10,
            language: { search: "", searchPlaceholder: "Search Data..." },
            drawCallback: function () {
                $('.dataTables_filter input').addClass('border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white mb-3 ml-2');
                $('.dataTables_length select').addClass('border border-gray-300 rounded-md px-3 py-1 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white mx-2');
            }
        });


    });
</script>
@endsection
