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
        // dd($request);

        $validated = $request->validate([
            'idprod' => 'required|string',
            'idvend' => 'required',
            'iduom' => 'required|exists:m_uom,iduom',
            'nmsales' => 'required|string|max:150',
            'nosales' => 'required|string|max:20',
            'email' => 'required|email|max:150',
            'qty' => 'required|numeric|min:0',
            'dtofr' => 'required|date',
            'exuom' => 'nullable|string|max:150',
            'exprod' => 'nullable|string|max:150',
            'price' => 'required|numeric|min:0',
        ]);

        $idprod = $request->input('idprod');
        $midprod = null;
        $exprod = null;

        if (str_starts_with($idprod, 'custom_')) {
            $exprod = substr($idprod, 7);
        } else {
            $midprod = $idprod;
        }

        $validated['idprod'] = $midprod;
        $validated['exprod'] = $exprod;
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

    public function storeVendorQuick(Request $request)
    {
        $request->validate([
            'nmvend' => 'required|string',
            'adrvend' => 'required|string'
        ]);
        $vendor = Vendor::create([
            'nmvend' => $request->nmvend,
            'adrvend' => $request->adrvend,
        ]);

        return response()->json([
            'idvend' => $vendor->idvend,
            'nmvend' => $vendor->nmvend
        ]);
    }

    public function storeProductQuick(Request $request)
    {
        $request->validate([
            'nmprod' => 'required|string'
        ]);

        $product = Product::create([
            'nmprod' => $request->nmprod,
        ]);

        return response()->json([
            'idprod' => $product->idprod,
            'nmprod' => $product->nmprod
        ]);
    }

}
