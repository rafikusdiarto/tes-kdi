<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Uom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OfferController extends Controller
{
    public function index()
    {
        try {
            $vendors = Vendor::orderBy('nmvend', 'asc')->get();
            $products = Product::orderBy('nmprod', 'asc')->get();
            $uoms = Uom::orderBy('nmuom', 'asc')->get();

            $offers = Offer::with(['vendors', 'products', 'uom'])->get();

            // dd($offers);

            return view('transaction.offer', compact('vendors', 'products', 'uoms', 'offers'));
        } catch (\Exception $e) {
            Log::error('Error OfferController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load Supplier : ' . $e->getMessage());
        }
    }

    public function update(Request $request, $idofr)
    {
        $validated = $request->validate([
            'idvend' => 'required',
            'idprod' => 'required',
            'iduom' => 'required|exists:m_uom,iduom',
            'nmsales' => 'required|string|max:150',
            'nosales' => 'required|string|max:20',
            'email' => 'nullable|email|max:150',
            'qty' => 'required|numeric|min:0',
            'exuom' => 'nullable|string|max:150',
            'exprod' => 'nullable|string|max:150',
            'price' => 'required|numeric|min:0',
            'ppn' => 'required|in:0,1',
        ]);

        try {
            $offer = Offer::where('idofr', $idofr)->firstOrFail();

            $offer->update($validated);

            return redirect()->back()->with('success', 'Data penawaran berhasil diperbarui');

        } catch (\Exception $e) {
            Log::error('Error OfferController@update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update Offer: ' . $e->getMessage());
        }
    }



}
