<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Uom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UomController extends Controller
{
    public function index()
    {
        try {
            $uoms = Uom::orderBy('nmuom', 'asc')->get();
            return view('master.uom', compact('uoms'));
        } catch (\Exception $e) {
            Log::error('Error UomController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load UOM : ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nmuom' => 'required|string|max:50',
        ]);

        try {
            Uom::create($validated);
            return redirect()->route('master.uom')->with('success', 'UOM successfully created.');
        } catch (\Exception $e) {
            Log::error('Error UomController@store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add UOM: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $iduom)
    {
        $validated = $request->validate([
            'nmuom' => 'required|string|max:50',
        ]);

        try {
            $uom = Uom::findOrFail($iduom);
            $uom->update($validated);

            return redirect()->route('master.uom')->with('success', 'UOM updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error UomController@update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed update UOM : ' . $e->getMessage());
        }
    }

    public function destroy($iduom)
    {
        try {
            $uom = Uom::findOrFail($iduom);
            $uom->delete();

            return redirect()->route('master.uom')->with('success', 'UOM deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error UomController@destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed delete UOM : ' . $e->getMessage());
        }
    }
}
