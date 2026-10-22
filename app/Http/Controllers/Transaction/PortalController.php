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
            'captcha' => 'required|digits:4',
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

        $expected = session()->pull('captcha_code');

        if (!$expected || !hash_equals((string) $expected, (string) $validated['captcha'])) {
            return redirect()->back()->withInput()->with('error', 'Kode verifikasi (captcha) salah, silakan coba lagi.');
        }

        unset($validated['captcha']);

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

    public function captcha()
    {
        $code = (string) random_int(1000, 9999);
        session(['captcha_code' => $code]);

        $width = 130;
        $height = 45;
        $image = imagecreatetruecolor($width, $height);

        $bg = imagecolorallocate($image, 245, 247, 250);
        imagefilledrectangle($image, 0, 0, $width, $height, $bg);

        // Garis noise
        for ($i = 0; $i < 6; $i++) {
            $c = imagecolorallocate($image, rand(140, 180), rand(140, 180), rand(140, 180));
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $c);
        }

        // Titik noise
        for ($i = 0; $i < 60; $i++) {
            $c = imagecolorallocate($image, rand(150, 200), rand(150, 200), rand(150, 200));
            imagesetpixel($image, rand(0, $width - 1), rand(0, $height - 1), $c);
        }

        // 4 digit dengan posisi vertikal sedikit acak
        for ($i = 0; $i < 4; $i++) {
            $c = imagecolorallocate($image, rand(10, 60), rand(10, 60), rand(50, 120));
            imagestring($image, 5, 20 + ($i * 22), rand(8, 18), $code[$i], $c);
        }

        ob_start();
        imagepng($image, null, 6);
        $png = ob_get_clean();
        imagedestroy($image);

        return response($png, 200, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
        ]);
    }

    public function checkCaptcha(Request $request)
    {
        $input = (string) $request->input('captcha');
        $expected = (string) session('captcha_code');

        $valid = $input !== '' && $expected !== '' && hash_equals($expected, $input);

        return response()->json(['status' => $valid]);
    }

}
