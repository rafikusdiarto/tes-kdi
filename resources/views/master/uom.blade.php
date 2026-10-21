@extends('layouts.app')

@section('content')
<div class="w-full">
    <!-- Header & Breadcrumb -->
    <div class="flex flex-col justify-between mb-6 md:flex-row md:items-center">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">Unit of Measure</h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola daftar satuan barang (UOM).</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button id="btnOpenModal" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors rounded-md bg-violet-600 hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500">
                <i class="mr-2 fa fa-plus"></i> Add UOM
            </button>
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
                        <th class="px-4 py-3 font-medium">UOM Name</th>
                        <th class="w-32 px-4 py-3 font-medium text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uoms as $index => $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50/50 dark:border-gray-700 dark:hover:bg-gray-700/50">
                            <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 font-medium">
                                <p
                                   class="text-violet-600 hover:text-violet-800 dark:text-violet-400 dark:hover:text-violet-300 btn-edit cursor-pointer underline"
                                   data-id="{{ $item->iduom }}"
                                   data-name="{{ $item->nmuom }}">
                                    {{ $item->nmuom }}
                                </p>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <form action="{{ route('master.uom.destroy', $item->iduom) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this UOM?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-100 rounded hover:bg-red-200 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 transition-colors">
                                        <i class="mr-1 fa fa-trash-alt"></i>
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

<div id="modalUom" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/50 backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="relative w-full max-w-sm p-6 overflow-hidden text-left align-middle transition-all transform bg-white border border-gray-200 shadow-xl rounded-xl dark:bg-gray-800 dark:border-gray-700">

            <div class="flex items-center justify-between mb-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modalTitle">Add New UOM</h3>
                <button type="button" id="btnCloseModal" class="text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none">
                    <i class="text-lg fa fa-times"></i>
                </button>
            </div>

            <form id="formUom" action="{{ route('master.uom.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="_method" value="PUT" id="methodPut" disabled>

                <div>
                    <label for="nmuom" class="block mb-1.5 text-sm font-medium text-gray-700 dark:text-gray-300">Unit of Measure Name</label>
                    <input type="text" name="nmuom" id="nmuom" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-violet-500 focus:border-violet-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="e.g. PCS, KGS, LTR" required autocomplete="off">
                </div>

                <div class="flex justify-end gap-3 pt-4 mt-6 border-t border-gray-100 dark:border-gray-700">
                    <button type="button" id="btnCancelModal" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-violet-600 hover:bg-violet-700">
                        Save UOM
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
        const urlStore = "{{ route('master.uom.store') }}";
        const urlUpdateBase = "{{ route('master.uom.update', ':id') }}";

        function resetModalToAdd() {
            $('#formUom').attr('action', urlStore);
            $('#methodPut').prop('disabled', true);
            $('#modalTitle').text('Add New UOM');
            $('#nmuom').val('');
        }

        function openModal() {
            $('#modalUom').removeClass('hidden');
        }

        function closeModal() {
            $('#modalUom').addClass('hidden');
        }

        $('#btnOpenModal').click(function() {
            resetModalToAdd();
            openModal();
        });

        $('tbody').on('click', '.btn-edit', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');

            $('#formUom').attr('action', urlUpdateBase.replace(':id', id));
            $('#methodPut').prop('disabled', false);
            $('#modalTitle').text('Edit UOM');
            $('#nmuom').val(name);

            openModal();
        });

        // Datatables & Modal Close Events
        $('#dataTableUom').DataTable({
            responsive: true,
            pageLength: 10,
            language: { search: "", searchPlaceholder: "Search UOM..." },
            drawCallback: function () {
                $('.dataTables_filter input').addClass('border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white mb-3 ml-2');
                $('.dataTables_length select').addClass('border border-gray-300 rounded-md px-3 py-1 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white mx-2');
            }
        });

        $('#btnCloseModal, #btnCancelModal').click(closeModal);
        $('#modalUom').click(function(e) { if (e.target === this) closeModal(); });
    });
</script>
@endsection
