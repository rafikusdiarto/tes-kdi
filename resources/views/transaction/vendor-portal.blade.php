@extends('layouts.guest2')

@section('content-portal')
    <div class="flex flex-col justify-center min-h-screen px-8 py-12 bg-gray-900 sm:px-6 lg:px-8">

        <div class="sm:mx-auto sm:w-full sm:max-w-3xl">
            <div class="flex justify-center mb-4">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-[#93C5FD] text-[#1E3A8A]">
                    <i class="text-3xl fa fa-file-signature"></i>
                </div>
            </div>
            <h2 class="text-3xl font-extrabold text-center text-gray-200">
                Supplier Portal
            </h2>
            <p class="mt-2 text-sm text-center text-gray-400">
                Silakan lengkapi formulir di bawah ini untuk mengirimkan detail penawaran.
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-3xl">
            <div class="px-4 py-8 bg-gray-100 border-t-4 shadow-lg rounded-xl sm:px-10 border-[#2563EB]">
                <!-- Alert Info -->
                @if (session('success'))
                    <div class="relative px-4 py-3 mb-6 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg">
                        <div><i class="mr-2 fa fa-check-circle"></i>{{ session('success') }}</div>
                    </div>
                @endif
                @if (session('error') || $errors->any())
                    <div class="relative px-4 py-3 mb-6 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg">
                        <div><i class="mr-2 fa fa-exclamation-circle"></i>{{ session('error') }}</div>
                    </div>
                @endif

                <form action="{{ route('transaction.portal.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div>
                        <h3 class="pb-2 text-lg font-semibold border-b text-[#0B192C] border-gray-200 mb-4">
                            1. Informasi Perusahaan & Sales
                        </h3>
                        <div class="grid grid-cols-1 gap-6 text-gray-700 md:grid-cols-1">
                            <div class="md:col-span-2">
                                <div class="flex items-center justify-between mb-1.5">
                                    <label for="idvend" class="block text-sm font-medium text-gray-700">Nama Perusahaan <span class="text-red-500">*</span></label>
                                    <!-- Tombol Pemicu Modal Vendor -->
                                    <button type="button" id="btn_open_modal_vend" class="text-xs text-[#2563EB] hover:underline hover:text-[#1E3A8A] focus:outline-none transition-colors">
                                        <i class="fa fa-plus-circle"></i> Perusahaan tidak ada di list?
                                    </button>
                                </div>
                                <select name="idvend" id="idvend" class="text-gray-700 w-full select2" required>
                                    <option value="">Pilih Vendor</option>
                                    @foreach ($vendors as $vendor)
                                        <option class="" value="{{ $vendor->idvend }}" {{ old('idvend') == $vendor->idvend ? 'selected' : '' }}>
                                            {{ $vendor->nmvend }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
                                <div>
                                    <label for="nmsales" class="block mb-1.5 text-sm font-medium text-gray-700">Nama Sales/PIC <span class="text-red-500">*</span></label>
                                    <input type="text" name="nmsales" id="nmsales" value="{{ old('nmsales') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] sm:text-sm" required>
                                </div>
                                <div>
                                    <label for="nosales" class="block mb-1.5 text-sm font-medium text-gray-700">No. WhatsApp <span class="text-red-500">*</span></label>
                                    <input type="text" name="nosales" id="nosales" value="{{ old('nosales') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] sm:text-sm" required>
                                </div>
                                <div>
                                    <label for="email" class="block mb-1.5 text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] sm:text-sm" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="pb-2 text-lg font-semibold border-b text-[#0B192C] border-gray-200 mb-4">
                            2. Detail Barang yang Ditawarkan
                        </h3>
                        <div class="grid grid-cols-1 gap-6 text-gray-700 md:grid-cols-12">

                            <div class="md:col-span-12">
                                <div class="flex justify-between items-center mb-1.5">
                                    <label for="idprod" class="block text-sm font-medium text-gray-700">Pilih Produk / Barang <span class="text-red-500">*</span></label>
                                    <!-- Tombol Pemicu Modal Produk -->
                                    <button type="button" id="btn_open_modal_prod" class="text-xs text-[#2563EB] hover:underline hover:text-[#1E3A8A] focus:outline-none transition-colors">
                                        <i class="fa fa-plus-circle"></i> Produk tidak ada di list?
                                    </button>
                                </div>
                                <select name="idprod" id="idprod" class="w-full select2" required>
                                    <option value="" data-iduom="">Pilih Produk</option>

                                    @foreach ($products as $product)
                                        <option value="{{ $product->idprod }}" data-iduom="{{ $product->iduom ?? '' }}" {{ old('idprod') == $product->idprod ? 'selected' : '' }}>
                                            {{ $product->nmprod }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-6">
                                <label id="label_iduom" for="iduom" class="block mb-1.5 text-sm font-medium text-gray-700">Satuan<span class="text-red-500">*</span></label>
                                <select name="iduom" id="iduom" class="w-full select2 text-gray-700" required>
                                    <option value="">Pilih Satuan</option>
                                    @foreach ($uoms as $uom)
                                        <option value="{{ $uom->iduom }}" {{ old('iduom') == $uom->iduom ? 'selected' : '' }}>{{ $uom->nmuom }}</option>
                                    @endforeach
                                </select>
                                <div class="flex items-center mt-2">
                                    <input type="checkbox" id="toggle_exuom" class="w-4 h-4 text-[#2563EB] bg-white border-gray-300 rounded focus:ring-[#2563EB]" {{ old('exuom') ? 'checked' : '' }}>
                                    <label for="toggle_exuom" class="ml-2 text-sm text-gray-600 cursor-pointer">Satuan tidak ada di list?</label>
                                </div>
                            </div>

                            <div class="md:col-span-6">
                                <label id="label_qty" for="qty" class="block mb-1.5 text-sm font-medium text-gray-700">Kuantitas (Qty) <span class="text-red-500">*</span></label>
                                <input type="number" step="any" name="qty" id="qty" value="{{ old('qty') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] sm:text-sm" required>
                            </div>

                            <div id="exuom_container" class="md:col-span-12 {{ old('exuom') ? '' : 'hidden' }}">
                                <div class="flex gap-3 p-4 mb-3 text-sm text-blue-800 bg-blue-50 border border-blue-200 rounded-md">
                                    <i class="mt-0.5 fa fa-info-circle text-lg"></i>
                                    <p class="leading-relaxed">
                                        <strong>Info Konversi:</strong> Pilih <strong>Satuan Konversi</strong> dan masukkan nilai <strong>Kuantitas Konversi</strong> dari satuan Supplier. Isi <strong>Harga</strong> sesuai harga satuan Supplier.<br>
                                        <em>Contoh referensi satuan asli: "Karung, 2 Karung".</em>
                                    </p>
                                </div>
                                <label for="exuom" class="block mb-1.5 text-sm font-medium text-gray-700">Satuan & Kuantitas Supplier <span class="text-red-500">*</span></label>
                                <input type="text" name="exuom" id="exuom" value="{{ old('exuom') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] sm:text-sm">
                            </div>

                            <div class="md:col-span-4">
                                <label for="dtofr" class="block mb-1.5 text-sm font-medium text-gray-700">Valid Date<span class="text-red-500">*</span></label>
                                <input type="date" name="dtofr" id="dtofr" value="{{ now()->format('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] sm:text-sm" required>
                            </div>
                            <div class="md:col-span-4">
                                <label for="price" class="block mb-1.5 text-sm font-medium text-gray-700">Harga Satuan<span class="text-red-500">*</span></label>
                                <input type="number" step="any" name="price" id="price" value="{{ old('price') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] sm:text-sm" required>
                            </div>
                            <div class="md:col-span-4">
                                <label class="block mb-1.5 text-sm font-medium text-gray-700">PPN</label>
                                <div class="flex items-center h-[42px]">
                                    <input type="hidden" name="ppn" value="0">
                                    <label for="ppn-toggle" class="inline-flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" name="ppn" id="ppn-toggle" value="1" class="sr-only peer" {{ old('ppn') == '1' ? 'checked' : '' }}>
                                            <div class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-2 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2563EB]"></div>
                                        </div>
                                        <span class="ml-3 text-sm font-medium text-gray-700">Include PPN (11%)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2563EB] hover:bg-[#1E3A8A] focus:ring-2 focus:ring-offset-2 focus:ring-[#2563EB] transition-colors">
                            <i class="mr-2 fa fa-paper-plane"></i> Submit Penawaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL VENDOR -->
    <div id="modal_custom_vend" class="fixed inset-0 z-50 hidden overflow-y-auto text-gray-700" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 modal-overlay" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-blue-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <i class="text-blue-600 fa fa-building"></i>
                        </div>
                        <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Tambah Perusahaan Baru</h3>
                            <div class="mt-2">
                                <p class="mb-3 text-sm text-gray-500">Nama Perusahaan</p>
                                <input type="text" id="custom_nmvend" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] sm:text-sm" placeholder="Contoh: PT Sinar Jaya">
                            </div>
                            <div class="mt-2">
                                <p class="mb-3 text-sm text-gray-500">Alamat Perusahaan</p>
                                <input type="text" id="custom_addr" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] sm:text-sm" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="btn_save_custom_vend" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-[#2563EB] border border-transparent rounded-md shadow-sm hover:bg-[#1E3A8A] sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button type="button" class="btn_close_modal inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PRODUCT -->
    <div id="modal_custom_prod" class="fixed inset-0 z-50 hidden overflow-y-auto text-gray-700" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 modal-overlay" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-blue-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <i class="text-blue-600 fa fa-box-open"></i>
                        </div>
                        <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Tambah Produk Baru</h3>
                            <div class="mt-2">
                                <p class="mb-3 text-sm text-gray-500">Nama Produk</p>
                                <input type="text" id="custom_nmprod" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] sm:text-sm" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="btn_save_custom_prod" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-[#2563EB] border border-transparent rounded-md shadow-sm hover:bg-[#1E3A8A] sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button type="button" class="btn_close_modal inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() }
            });

            const toggleExuom = $('#toggle_exuom');
            const exuomContainer = $('#exuom_container');
            const exuomInput = $('#exuom');
            const labelQty = $('#label_qty');
            const labelIduom = $('#label_iduom');

            function handleExuomVisibility() {
                if (toggleExuom.is(':checked')) {
                    exuomContainer.removeClass('hidden');
                    exuomInput.prop('required', true);
                    labelQty.html('Kuantitas Konversi <span class="text-red-500">*</span>');
                    labelIduom.html('Satuan Konversi <span class="text-red-500">*</span>');
                } else {
                    exuomContainer.addClass('hidden');
                    exuomInput.prop('required', false);
                    exuomInput.val('');
                    labelQty.html('Kuantitas (Qty) <span class="text-red-500">*</span>');
                    labelIduom.html('Satuan <span class="text-red-500">*</span>');
                }
            }
            if (toggleExuom.length) {
                toggleExuom.on('change', handleExuomVisibility);
                handleExuomVisibility();
            }

            $('#idprod').on('change', function() {
                var selectedIduom = $(this).find(':selected').data('iduom');
                if (selectedIduom) {
                    $('#iduom').val(selectedIduom).trigger('change');
                }
            });

            $('.btn_close_modal, .modal-overlay').on('click', function() {
                $('#modal_custom_vend, #modal_custom_prod').addClass('hidden');
            });

            $('#btn_open_modal_vend').on('click', function(e) {
                e.preventDefault();
                $('#modal_custom_vend').removeClass('hidden');
                setTimeout(() => $('#custom_nmvend').focus(), 100);
            });

            $('#btn_open_modal_prod').on('click', function(e) {
                e.preventDefault();
                $('#modal_custom_prod').removeClass('hidden');
                setTimeout(() => $('#custom_nmprod').focus(), 100);
            });


            // --- 4. AJAX Save Vendor Kustom (TETAP AJAX) ---
            $('#btn_save_custom_vend').on('click', function() {
                let inputVal = $('#custom_nmvend').val().trim();
                if (inputVal === '') { alert('Nama perusahaan tidak boleh kosong!'); return; }

                let $btn = $(this);
                let originalText = $btn.html();
                $btn.html('<i class="fa fa-spinner fa-spin mr-2"></i>Menyimpan...').prop('disabled', true);

                $.ajax({
                    url: "{{ route('api.vendor.store') }}",
                    type: "POST",
                    data: { nmvend: inputVal },
                    success: function(res) {
                        let newOption = new Option(res.nmvend, res.idvend, true, true);
                        $('#idvend').append(newOption).trigger('change');
                        $('#modal_custom_vend').addClass('hidden');
                        $('#custom_nmvend').val('');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat menyimpan data perusahaan.');
                    },
                    complete: function() {
                        $btn.html(originalText).prop('disabled', false);
                    }
                });
            });


            $('#btn_save_custom_prod').on('click', function() {
                var customName = $('#custom_nmprod').val().trim();

                if (customName !== '') {
                    var newOption = new Option(customName, 'custom_' + customName, true, true);
                    $('#idprod').append(newOption).trigger('change');
                    $('#iduom').val('').trigger('change');
                    $('#modal_custom_prod').addClass('hidden');
                    $('#custom_nmprod').val('');
                } else {
                    alert('Nama produk tidak boleh kosong!');
                }
            });

        });
    </script>
@endsection
