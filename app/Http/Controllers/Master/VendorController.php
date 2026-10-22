<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VendorController extends Controller
{
    public function index()
    {
        try {
            $vendors = Vendor::orderBy('nmvend', 'asc')->get();

            return view('master.vendor', compact('vendors'));
        } catch (\Exception $e) {
            Log::error('Error VendorController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load Supplier : ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $cleaned = preg_replace('/[^a-zA-Z0-9\s]/', '', $request->nmvend);
        $finalName = strtoupper(preg_replace('/\s+/', ' ', $cleaned));
        $request->merge([
            'nmvend' => $finalName
        ]);
        $validated = $request->validate([
            'nmvend' => 'required|string|max:150|unique:m_vendor,nmvend',
            'adrvend' => 'required|string',
        ]);

        try {
            Vendor::create($validated);

            return redirect()->route('master.vendor')->with('success', 'Supplier successfully created.');
        } catch (\Exception $e) {
            Log::error('Error VendorController@store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add Supplier: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $idvend)
    {
        $validated = $request->validate([
            'nmvend' => 'required|string|max:150|unique:m_vendor,nmvend,' . $idvend . ',idvend',
            'adrvend' => 'required|string',
        ]);

        try {
            $vendor = Vendor::findOrFail($idvend);
            $vendor->update($validated);

            return redirect()->route('master.vendor')->with('success', 'Supplier updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error VendorController@update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed update Supplier : ' . $e->getMessage());
        }
    }

    public function destroy($idvend)
    {
        try {
            $vendor = Vendor::findOrFail($idvend);
            $vendor->delete();

            return redirect()->route('master.vendor')->with('success', 'Supplier deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error VendorController@destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed delete Supplier : ' . $e->getMessage());
        }
    }
}
