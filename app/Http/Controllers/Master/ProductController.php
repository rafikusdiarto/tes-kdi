<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Uom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::with('uom')->orderBy('nmprod', 'asc')->get();
            $uoms = Uom::orderBy('nmuom', 'asc')->get();

            return view('master.product', compact('products', 'uoms'));
        } catch (\Exception $e) {
            Log::error('Error ProductController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load Product : ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nmprod' => 'required|string|max:150',
            'iduom' => 'required|exists:m_uom,iduom',
        ]);

        try {
            Product::create($validated);
            return redirect()->route('master.product')->with('success', 'Product successfully created.');
        } catch (\Exception $e) {
            Log::error('Error ProductController@store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add Product: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $idprod)
    {
        $validated = $request->validate([
            'nmprod' => 'required|string|max:150',
            'iduom' => 'required|exists:m_uom,iduom',
        ]);

        try {
            $product = Product::findOrFail($idprod);
            $product->update($validated);

            return redirect()->route('master.product')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error ProductController@update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed update Product : ' . $e->getMessage());
        }
    }

    public function destroy($idprod)
    {
        try {
            $product = Product::findOrFail($idprod);
            $product->delete();

            return redirect()->route('master.product')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error ProductController@destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed delete Product : ' . $e->getMessage());
        }
    }
}
