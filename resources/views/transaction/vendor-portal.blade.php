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

                @if (session('success'))
                    <div class="relative px-4 py-3 mb-6 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg"
                        id="alertSuccess">
                        <div><i class="mr-2 fa fa-check-circle"></i>{{ session('success') }}</div>
                    </div>
                @endif

                @if (session('error') || $errors->any())
                    <div class="relative px-4 py-3 mb-6 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg"
                        id="alertError">
                        <div><i class="mr-2 fa fa-exclamation-circle"></i>{{ session('error') }}</div>
                        @if ($errors->any())
                            <ul class="mt-1 ml-5 list-disc">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
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
                                <label for="idvend" class="block mb-1.5 text-sm font-medium text-gray-700">Nama Perusahaan
                                    <span class="text-red-500">*</span></label>
                                <select name="idvend" id="idvend" class="w-full select2" required>
                                    <option value="">Pilih Vendor</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->idvend }}"
                                            {{ old('idvend') == $vendor->idvend ? 'selected' : '' }}>
                                            {{ $vendor->nmvend }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-1 gap-3 md:grid-cols-3">
                                <div>
                                    <label for="nmsales" class="block mb-1.5 text-sm font-medium text-gray-700">Nama
                                        Sales/PIC <span class="text-red-500">*</span></label>
                                    <input type="text" name="nmsales" id="nmsales" value="{{ old('nmsales') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm"
                                        placeholder="Contoh: Budi Santoso" required>
                                </div>

                                <div>
                                    <label for="nosales" class="block mb-1.5 text-sm font-medium text-gray-700">No. Telepon
                                        / WhatsApp <span class="text-red-500">*</span></label>
                                    <input type="text" name="nosales" id="nosales" value="{{ old('nosales') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm"
                                        placeholder="Contoh: 081234567890" required>
                                </div>

                                <div>
                                    <label for="email" class="block mb-1.5 text-sm font-medium text-gray-700">Email <span
                                            class="text-red-500">*</span></label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm"
                                        placeholder="Contoh: budi.santoso@example.com" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="pb-2 text-lg font-semibold border-b text-[#0B192C] border-gray-200 mb-4">
                            2. Detail Barang yang Ditawarkan
                        </h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-12 text-gray-700">

                            <div class="md:col-span-12">
                                <label for="idprod" class="block mb-1.5 text-sm font-medium text-gray-700">Pilih Produk /
                                    Barang <span class="text-red-500">*</span></label>
                                <select name="idprod" id="idprod" class="w-full select2" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->idprod }}"
                                            {{ old('idprod') == $product->idprod ? 'selected' : '' }}>
                                            {{ $product->nmprod }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-6">
                                <!-- ID ditambahkan pada label Satuan -->
                                <label id="label_iduom" for="iduom"
                                    class="block mb-1.5 text-sm font-medium text-gray-700">Satuan<span
                                        class="text-red-500">*</span></label>
                                <select name="iduom" id="iduom" class="w-full select2 text-gray-700" required>
                                    <option value="">Pilih Satuan</option>
                                    @foreach ($uoms as $uom)
                                        <option class="text-red-700" value="{{ $uom->iduom }}"
                                            {{ old('iduom') == $uom->iduom ? 'selected' : '' }}>
                                            {{ $uom->nmuom }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="flex items-center mt-2">
                                    <input type="checkbox" id="toggle_exuom"
                                        class="w-4 h-4 text-[#2563EB] bg-white border-gray-300 rounded focus:ring-[#2563EB]"
                                        {{ old('exuom') ? 'checked' : '' }}>
                                    <label for="toggle_exuom" class="ml-2 text-sm text-gray-600 cursor-pointer">Satuan tidak
                                        ada di list?</label>
                                </div>
                            </div>

                            <div class="md:col-span-6">
                                <!-- ID ditambahkan pada label Kuantitas -->
                                <label id="label_qty" for="qty"
                                    class="block mb-1.5 text-sm font-medium text-gray-700">Kuantitas (Qty) <span
                                        class="text-red-500">*</span></label>
                                <input type="number" step="any" name="qty" id="qty"
                                    value="{{ old('qty') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm"
                                    placeholder="0.00" required>
                            </div>



                            <div id="exuom_container" class="md:col-span-12 {{ old('exuom') ? '' : 'hidden' }}">
                                <div
                                    class="flex gap-3 p-4 mb-3 text-sm text-blue-800 bg-blue-50 border border-blue-200 rounded-md">
                                    <i class="mt-0.5 fa fa-info-circle text-lg"></i>
                                    {{-- <p class="leading-relaxed">
                                        <strong>Informasi Konversi:</strong> Agar penawaran dapat dibandingkan secara adil, mohon tetap pilih <strong>Satuan Konversi</strong> pada dropdown di atas.<br>
                                        Kemudian, masukkan <strong>Kuantitas Konversi</strong>, namun biarkan harga di bawah menggunakan <strong>Harga Satuan Supplier</strong> Anda (sistem kami akan menghitung otomatis konversinya).<br>
                                        <em>Gunakan kolom di bawah ini untuk mencatat referensi satuan asli (Contoh: "1 Dump Truck").</em>
                                    </p> --}}
                                    <p class="leading-relaxed">
                                        <strong>Info Konversi:</strong> Pilih <strong>Satuan Konversi</strong> dan masukkan
                                        nilai <strong>Kuantitas Konversi</strong> dari satuan Supplier. Isi
                                        <strong>Harga</strong> sesuai harga satuan Supplier. <br>
                                        <em>Gunakan kolom di bawah ini untuk mencatat referensi satuan asli (Contoh: "1 Dump
                                            Truck").</em>
                                    </p>
                                </div>
                                <label for="exuom" class="block mb-1.5 text-sm font-medium text-gray-700">Satuan
                                    Supplier <span class="text-red-500">*</span></label>
                                <input type="text" name="exuom" id="exuom" value="{{ old('exuom') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm"
                                    placeholder="Contoh: 1 Dump Truck">
                            </div>

                            <div class="md:col-span-4">
                                <label for="dtofr" class="block mb-1.5 text-sm font-medium text-gray-700">Valid
                                    Date<span class="text-red-500">*</span></label>
                                <input type="date" name="dtofr" id="dtofr"
                                    value="{{ now()->format('Y-m-d') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm"
                                    required>
                            </div>

                            <div class="md:col-span-4">
                                <label for="price" class="block mb-1.5 text-sm font-medium text-gray-700">Harga Satuan
                                    Supplier<span class="text-red-500">*</span></label>
                                <input type="number" step="any" name="price" id="price"
                                    value="{{ old('price') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm"
                                    placeholder="0.00" required>
                            </div>

                            <div class="md:col-span-4">
                                <label class="block mb-1.5 text-sm font-medium text-gray-700">PPN</label>
                                <div class="flex items-center h-[42px]">
                                    <input type="hidden" name="ppn" value="0">
                                    <label for="ppn-toggle" class="inline-flex items-center cursor-pointer">
                                        <div class="relative">
                                            <input type="checkbox" name="ppn" id="ppn-toggle" value="1"
                                                class="sr-only peer" {{ old('ppn') == '1' ? 'checked' : '' }}>
                                            <div
                                                class="w-11 h-6 bg-gray-300 rounded-full peer peer-focus:ring-2 peer-focus:ring-[#2563EB]/50 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2563EB]">
                                            </div>
                                        </div>
                                        <span class="ml-3 text-sm font-medium text-gray-700">Include PPN (11%)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2563EB] hover:bg-[#1E3A8A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2563EB] transition-colors">
                            <i class="mr-2 fa fa-paper-plane"></i> Submit Penawaran
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
            const toggleExuom = $('#toggle_exuom');
            const exuomContainer = $('#exuom_container');
            const exuomInput = $('#exuom');

            // Ambil elemen label
            const labelQty = $('#label_qty');
            const labelIduom = $('#label_iduom');

            function handleExuomVisibility() {
                if (toggleExuom.is(':checked')) {
                    exuomContainer.removeClass('hidden');
                    exuomInput.prop('required', true);

                    // Ubah text label menjadi mode konversi
                    labelQty.html('Kuantitas Konversi <span class="text-red-500">*</span>');
                    labelIduom.html('Satuan Konversi <span class="text-red-500">*</span>');
                } else {
                    exuomContainer.addClass('hidden');
                    exuomInput.prop('required', false);
                    exuomInput.val('');

                    // Kembalikan text label ke mode normal
                    labelQty.html('Kuantitas (Qty) <span class="text-red-500">*</span>');
                    labelIduom.html('Satuan <span class="text-red-500">*</span>');
                }
            }

            if (toggleExuom.length) {
                toggleExuom.on('change', handleExuomVisibility);
                handleExuomVisibility();
            }
        });
    </script>
@endsection
