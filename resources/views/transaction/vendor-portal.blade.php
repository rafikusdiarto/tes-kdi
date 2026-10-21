@extends('layouts.guest2')

@section('content-portal')
    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-900 sm:px-6 lg:px-8 px-8">

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
            <div class="px-4 py-8 bg-gray-100 shadow-lg rounded-xl sm:px-10 border-t-4 border-[#2563EB]">

                @if(session('success'))
                <div class="relative px-4 py-3 mb-6 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg" id="alertSuccess">
                    <div><i class="mr-2 fa fa-check-circle"></i>{{ session('success') }}</div>
                </div>
                @endif

                @if(session('error') || $errors->any())
                <div class="relative px-4 py-3 mb-6 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg" id="alertError">
                    <div><i class="mr-2 fa fa-exclamation-circle"></i>{{ session('error') }}</div>
                    @if($errors->any())
                        <ul class="mt-1 ml-5 list-disc">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                @endif

                <form action="" method="POST" class="space-y-8">
                    @csrf
                    <div>
                        <h3 class="pb-2 text-lg font-semibold border-b text-[#0B192C] border-gray-200 mb-4">
                            1. Informasi Perusahaan & Sales
                        </h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="md:col-span-2">
                                <label for="idvend" class="block mb-1.5 text-sm font-medium text-gray-700">Nama Perusahaan <span class="text-red-500">*</span></label>
                                <select name="idvend" id="idvend" class="w-full select2" required>
                                    <option value="">Pilih Vendor</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{ $vendor->idvend }}" {{ old('idvend') == $vendor->idvend ? 'selected' : '' }}>
                                            {{ $vendor->nmvend }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="nmsales" class="block mb-1.5 text-sm font-medium text-gray-700">Nama Sales/PIC <span class="text-red-500">*</span></label>
                                <input type="text" name="nmsales" id="nmsales" value="{{ old('nmsales') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm" placeholder="Contoh: Budi Santoso" required>
                            </div>

                            <div>
                                <label for="nosales" class="block mb-1.5 text-sm font-medium text-gray-700">No. Telepon / WhatsApp <span class="text-red-500">*</span></label>
                                <input type="text" name="nosales" id="nosales" value="{{ old('nosales') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm" placeholder="Contoh: 081234567890" required>
                            </div>

                        </div>
                    </div>

                    <div>
                        <h3 class="pb-2 text-lg font-semibold border-b text-[#0B192C] border-gray-200 mb-4">
                            2. Detail Barang yang Ditawarkan
                        </h3>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-12">

                            <div class="md:col-span-12">
                                <label for="idprod" class="block mb-1.5 text-sm font-medium text-gray-700">Pilih Produk / Barang <span class="text-red-500">*</span></label>
                                <select name="idprod" id="idprod" class="w-full select2" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->idprod }}" {{ old('idprod') == $product->idprod ? 'selected' : '' }}>
                                            {{ $product->nmprod }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-4">
                                <label for="qty" class="block mb-1.5 text-sm font-medium text-gray-700">Kuantitas (Qty) <span class="text-red-500">*</span></label>
                                <input type="number" step="any" name="qty" id="qty" value="{{ old('qty') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm" placeholder="0.00" required>
                            </div>

                            <div class="md:col-span-4">
                                <label for="iduom" class="block mb-1.5 text-sm font-medium text-gray-700">Satuan (UOM) <span class="text-red-500">*</span></label>
                                <select name="iduom" id="iduom" class="w-full select2" required>
                                    <option value="">Pilih Satuan</option>
                                    @foreach($uoms as $uom)
                                        <option value="{{ $uom->iduom }}" {{ old('iduom') == $uom->iduom ? 'selected' : '' }}>
                                            {{ $uom->nmuom }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-4">
                                <label for="ppn" class="block mb-1.5 text-sm font-medium text-gray-700">Status PPN <span class="text-red-500">*</span></label>
                                <select name="ppn" id="ppn" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-[#2563EB] focus:border-[#2563EB] sm:text-sm" required>
                                    <option value="0" {{ old('ppn') == '0' ? 'selected' : '' }}>Exclude PPN (0%)</option>
                                    <option value="11" {{ old('ppn') == '11' ? 'selected' : '' }}>Include PPN (11%)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#2563EB] hover:bg-[#1E3A8A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#2563EB] transition-colors">
                            <i class="mr-2 fa fa-paper-plane"></i> Submit Penawaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

