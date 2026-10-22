<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Uom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PortalController extends Controller
{
    public function index()
    {
        try {
            $vendors = Vendor::orderBy('nmvend', 'asc')->get();
            $products = Product::orderBy('nmprod', 'asc')->get();
            $uoms = Uom::orderBy('nmuom', 'asc')->get();

            return view('transaction.vendor-portal', compact('vendors', 'products', 'uoms'));
        } catch (\Exception $e) {
            Log::error('Error PortalController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load Supplier : ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idprod' => 'required',
            'idvend' => 'required',
            'iduom' => 'required|exists:m_uom,iduom',
            'nmsales' => 'required|string|max:150',
            'nosales' => 'required|string|max:20',
            'email' => 'required|email|max:150',
            'qty' => 'required|numeric|min:0',
            'dtofr' => 'required|date',
            'exuom' => 'string|max:150',
            'price' => 'required|numeric|min:0',
        ]);

        $validated['ppn'] = $request->input('ppn');

        // dd($validated);

        try {
            Offer::create($validated);
            return redirect()->back()->with('success', 'Penawaran berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error PortalController@store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add Offer: ' . $e->getMessage());
        }
    }

}
