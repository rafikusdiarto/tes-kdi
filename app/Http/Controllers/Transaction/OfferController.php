<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Param;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Uom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OfferController extends Controller
{
    public function index()
    {
        try {
            $vendors = Vendor::orderBy('nmvend', 'asc')->get();
            $products = Product::orderBy('nmprod', 'asc')->get();
            $uoms = Uom::orderBy('nmuom', 'asc')->get();
            $statsTrans = Param::where('pidprm', 'STS_TRN')->orderBy('seqprm', 'asc')->get();
            $offers = Offer::with(['vendors', 'products', 'uom'])->get();

            $queryOffer = "
            select a.idofr, a.idprod, a.idvend, a.iduom, a.nmsales, a.nosales , a.email ,a.qty, a.ppn, a.stsofr , a.dtofr , a.price, a.exuom, a.exprod,
            b.nmprod, c.nmuom , d.nmvend , d.adrvend,e.valprm1 as stats_trans
            from t_offer a
            left join m_product b on b.idprod = a.idprod
            left join m_uom c on c.iduom = a.iduom
            left join m_vendor d on d.idvend = a.idvend
            left join m_param e on e.pidprm = 'STS_TRN' and e.valprm = a.stsofr
            ";
            $offers2 = DB::select($queryOffer);

            // dd($statsTrans);

            return view('transaction.offer', compact('vendors', 'products', 'uoms', 'offers', 'offers2', 'statsTrans'));
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
            'ppn' => 'required',
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

    public function updateStats(Request $request, $idofr)
    {
        $validated = $request->validate([
            'stsofr' => 'required|string',
        ]);

        try {
            $offer = Offer::where('idofr', $idofr)->firstOrFail();

            $offer->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Status penawaran berhasil diperbarui',
            ]);

            // return redirect()->back()->with('success', 'Data penawaran berhasil diperbarui');

        } catch (\Exception $e) {
            Log::error('Error OfferController@update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Offer: ' . $e->getMessage(),
            ]);
        }
    }



}
