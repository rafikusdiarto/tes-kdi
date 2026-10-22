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
        @if (session('success'))
            <div class="relative flex items-center justify-between px-4 py-3 mb-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg dark:bg-green-900/30 dark:text-green-400 dark:border-green-800"
                id="alertSuccess">
                <div><i class="mr-2 fa fa-check-circle"></i>{{ session('success') }}</div>
                <button type="button" class="text-green-600 hover:text-green-800 dark:text-green-400"
                    onclick="$('#alertSuccess').slideUp()">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        @endif

        @if (session('error') || $errors->any())
            <div class="relative px-4 py-3 mb-4 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg dark:bg-red-900/30 dark:text-red-400 dark:border-red-800"
                id="alertError">
                <div class="flex items-start justify-between">
                    <div>
                        <i class="mr-2 fa fa-exclamation-circle"></i>{{ session('error') }}
                        @if ($errors->any())
                            <ul class="mt-2 ml-4 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <button type="button" class="text-red-600 hover:text-red-800 dark:text-red-400"
                        onclick="$('#alertError').slideUp()">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5 overflow-x-auto">
                <table id="dataTableUom" class="w-full text-sm text-left text-gray-600 display dark:text-gray-300">
                    <thead
                        class="text-xs text-gray-700 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-700/50 dark:text-gray-300 dark:border-gray-700">
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
                            <tr
                                class="border-b border-gray-100 hover:bg-gray-50/50 dark:border-gray-700 dark:hover:bg-gray-700/50">

                                <td class="px-4 py-2 text-center">
                                    <button type="button"
                                        class="font-medium text-blue-600 transition-colors btn-edit-offer hover:text-blue-800 hover:underline dark:text-blue-400 dark:hover:text-blue-300"
                                        title="Edit Data Penawaran" data-id="{{ $item->idofr }}"
                                        data-idvend="{{ $item->idvend }}" data-nmsales="{{ $item->nmsales }}"
                                        data-nosales="{{ $item->nosales }}" data-email="{{ $item->email }}"
                                        data-idprod="{{ $item->idprod }}" data-exprod="{{ $item->exprod ?? '' }}"
                                        data-qty="{{ $item->qty }}" data-iduom="{{ $item->iduom }}"
                                        data-exuom="{{ $item->exuom ?? '' }}" data-price="{{ $item->price }}"
                                        data-ppn="{{ $item->ppn }}">
                                        {{ $item->idofr }}
                                    </button>
                                </td>

                                <td class="px-4 py-2 text-left">{{ $item->vendors->nmvend ?? '~' }} /
                                    {{ $item->vendors->adrvend ?? '~' }}</td>
                                <td class="px-4 py-2 text-left">{{ $item->nmsales ?? '~' }}</td>
                                <td class="px-4 py-2 text-left">{{ $item->nosales ?? '~' }} / {{ $item->email ?? '~' }}</td>

                                <td class="px-4 py-2 text-left">
                                    @if ($item->products && $item->products->nmprod)
                                        <span class="text-gray-800 dark:text-gray-200">{{ $item->products->nmprod }}</span>
                                    @else
                                        <div class="flex flex-col items-start">
                                            <span class="font-medium text-amber-600 dark:text-amber-400">
                                                {{ $item->exprod ?? '~' }}
                                            </span>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 mt-1 text-[10px] font-medium text-teal-700 bg-teal-100 border border-teal-200 rounded dark:bg-teal-900/30 dark:text-teal-400 dark:border-teal-800">
                                                <i class="mr-1 fa fa-exclamation-triangle"></i>produk tidak ada di master
                                            </span>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-4 py-2 text-left">{{ $item->qty ?? '~' }}</td>
                                <td class="px-4 py-2 text-left">{{ $item->uom->nmuom ?? '~' }}</td>
                                <td class="px-4 py-2 text-left">{{ $item->exuom ?? '~' }}</td>
                                <td class="px-4 py-2 text-left">
                                    @if ($item->exuom != '')
                                        @currency($item->price / $item->qty)
                                    @else
                                        ~
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-left">@currency($item->price ?? 0)</td>
                                <td class="px-4 py-2 text-left">
                                    @if ($item->ppn == '1')
                                        <span
                                            class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900/30 dark:text-green-400">Ya</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">Tidak</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT KESELURUHAN DATA -->
    <div id="modal_edit_offer" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 modal-overlay" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">

                <form id="form_edit_offer" action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="px-4 pt-5 pb-4 bg-white dark:bg-gray-800 sm:p-6 sm:pb-4">
                        <div
                            class="flex items-center justify-between mb-4 pb-3 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full dark:bg-blue-900/50">
                                    <i class="text-blue-600 fa fa-edit dark:text-blue-400"></i>
                                </div>
                                <h3 class="ml-3 text-lg font-medium text-gray-900 dark:text-gray-100">
                                    Edit Penawaran <span id="modal_display_idofr"
                                        class="text-[#2563EB] dark:text-blue-400"></span>
                                </h3>
                            </div>
                            <button type="button" class="text-gray-400 btn_close_edit_modal hover:text-gray-500">
                                <i class="fa fa-times text-xl"></i>
                            </button>
                        </div>

                        <!-- Peringatan jika produk kustom -->
                        <div id="alert_exprod"
                            class="hidden p-3 mb-5 text-sm text-amber-800 bg-amber-50 border border-amber-200 rounded-md dark:bg-amber-900/30 dark:text-amber-400 dark:border-amber-800">
                            <i class="mr-2 fa fa-info-circle"></i>
                            <strong>Produk tidak ada dimaster : </strong> <span id="modal_display_exprod"
                                class="font-bold underline"></span>, update produk sesuai dengan master data
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                            <!-- KOLOM KIRI: Informasi Perusahaan & Sales -->
                            <div
                                class="p-4 bg-gray-50 border border-gray-200 rounded-lg dark:bg-gray-700/30 dark:border-gray-700">
                                <h4
                                    class="mb-4 text-sm font-semibold text-gray-800 uppercase dark:text-gray-200 border-b border-gray-200 dark:border-gray-600 pb-2">
                                    1. Data Supplier & PIC</h4>

                                <div class="space-y-4">
                                    <div>
                                        <label
                                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Perusahaan
                                            <span class="text-red-500">*</span></label>
                                        <select name="idvend" id="edit_idvend" class="w-full select2-modal" required>
                                            <option value="">Pilih Vendor</option>
                                            @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->idvend }}">{{ $vendor->nmvend }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                            Sales</label>
                                        <input type="text" name="nmsales" id="edit_nmsales"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            required>
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">No.
                                            WhatsApp</label>
                                        <input type="text" name="nosales" id="edit_nosales"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label
                                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                        <input type="email" name="email" id="edit_email"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                </div>
                            </div>

                            <!-- KOLOM KANAN: Detail Penawaran Barang -->
                            <div
                                class="p-4 bg-gray-50 border border-gray-200 rounded-lg dark:bg-gray-700/30 dark:border-gray-700">
                                <h4
                                    class="mb-4 text-sm font-semibold text-gray-800 uppercase dark:text-gray-200 border-b border-gray-200 dark:border-gray-600 pb-2">
                                    2. Detail Penawaran</h4>

                                <div class="space-y-4">
                                    <div>
                                        <label
                                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Produk
                                            Supplier</label>
                                        <input type="text" name="exprod" id="edit_exprod"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label
                                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Pilih
                                            Produk <span class="text-red-500">*</span></label>
                                        <select name="idprod" id="edit_idprod" class="w-full select2-modal" required>
                                            <option value="">Pilih Produk</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->idprod }}">{{ $product->nmprod }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label
                                                class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Kuantitas</label>
                                            <input type="number" step="any" name="qty" id="edit_qty"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                required>
                                        </div>
                                        <div>
                                            <label
                                                class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Satuan
                                                Master</label>
                                            <select name="iduom" id="edit_iduom" class="w-full select2-modal" required>
                                                <option value="">Pilih Satuan</option>
                                                @foreach ($uoms as $uom)
                                                    <option value="{{ $uom->iduom }}">{{ $uom->nmuom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <label
                                            class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Satuan
                                            Supplier <span class="text-gray-400 font-normal italic">-
                                                Opsional</span></label>
                                        <input type="text" name="exuom" id="edit_exuom"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                            placeholder="Kosongkan jika sama dengan master">
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <label
                                                class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Harga
                                                Satuan Supplier</label>
                                            <input type="number" step="any" name="price" id="edit_price"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                                required>
                                        </div>
                                        <div>
                                            <label
                                                class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">PPN</label>
                                            <div class="flex items-center h-[42px]">
                                                <input type="hidden" name="ppn" value="0">

                                                <label for="edit_ppn" class="inline-flex items-center cursor-pointer">
                                                    <div class="relative">
                                                        <input type="checkbox" name="ppn" id="edit_ppn" value="1" class="sr-only peer">
                                                        <div
                                                            class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-500/50 dark:peer-focus:ring-blue-800 dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div
                        class="px-4 py-3 bg-gray-100 dark:bg-gray-700/80 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200 dark:border-gray-700">
                        <button type="submit"
                            class="inline-flex justify-center w-full px-5 py-2 text-base font-medium text-white bg-[#2563EB] border border-transparent rounded-md shadow-sm hover:bg-[#1E3A8A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Simpan Perubahan
                        </button>
                        <button type="button"
                            class="btn_close_edit_modal inline-flex justify-center w-full px-5 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Batal
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

            // 1. Inisialisasi DataTable
            $('#dataTableUom').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    search: "",
                    searchPlaceholder: "Search Data..."
                },
                drawCallback: function() {
                    $('.dataTables_filter input').addClass(
                        'border border-gray-300 rounded-md px-3 py-1.5 text-sm focus:ring-violet-500 focus:border-violet-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white mb-3 ml-2'
                        );
                    $('.dataTables_length select').addClass(
                        'border border-gray-300 rounded-md px-3 py-1 text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white mx-2'
                        );
                }
            });

            if ($('.select2-modal').length) {
                $('.select2-modal').select2({
                    dropdownParent: $('#modal_edit_offer'),
                    width: '100%'
                });
            }

            $('.btn_close_edit_modal, .modal-overlay').on('click', function() {
                $('#modal_edit_offer').addClass('hidden');
            });

            $('#dataTableUom tbody').on('click', '.btn-edit-offer', function() {
                let idofr = $(this).data('id');
                let idvend = $(this).data('idvend');
                let nmsales = $(this).data('nmsales');
                let nosales = $(this).data('nosales');
                let email = $(this).data('email');

                let idprod = $(this).data('idprod');
                let exprod = $(this).data('exprod');

                let qty = $(this).data('qty');
                let iduom = $(this).data('iduom');
                let exuom = $(this).data('exuom');
                let price = $(this).data('price');
                let ppn = $(this).data('ppn');

                // --- Isi bagian Text / Input / Number ---
                $('#modal_display_idofr').text(idofr);
                $('#edit_nmsales').val(nmsales);
                $('#edit_nosales').val(nosales);
                $('#edit_email').val(email);
                $('#edit_qty').val(qty);
                $('#edit_exuom').val(exuom);
                $('#edit_price').val(price);
                $('#edit_ppn').prop('checked', ppn == 1 || ppn == '1');
                $('#edit_exprod').val(exprod);

                if (!idprod && exprod !== '') {
                    $('#alert_exprod').removeClass('hidden');
                    $('#modal_display_exprod').text(exprod);
                    $('#edit_idprod').val('').trigger('change');
                } else {
                    $('#alert_exprod').addClass('hidden');
                    $('#edit_idprod').val(idprod).trigger('change');
                }

                if (idvend) $('#edit_idvend').val(idvend).trigger('change');
                if (iduom) $('#edit_iduom').val(iduom).trigger('change');
                let updateUrl = `{{ route('transaction.offer.update', ['idofr' => ':idofr']) }}`.replace(
                    ':idofr', idofr);
                $('#form_edit_offer').attr('action', updateUrl);
                $('#modal_edit_offer').removeClass('hidden');
            });

        });
    </script>
@endsection
