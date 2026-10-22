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



}
