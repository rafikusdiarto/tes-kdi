<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        try {
            $group_menu = DB::select("select * from m_param where pidprm = 'GRP_MNU'");
            $menu = Menu::orderBy('ordmnu', 'asc')->get();

            return view('settings.menu', [
                'group_menu' => $group_menu,
                'menu' => $menu
            ]);
        } catch (\Exception $e) {
            Log::error('Error MenuController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load menu : ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'nmmnu' => 'required|string|max:255',
            'urlmnu' => 'required|string|max:255',
            'icnmnu' => 'nullable|string|max:255',
            'grpmnu' => 'required|string|max:255',
            'prnmnu' => 'nullable|string|max:255',
            'ordmnu' => 'required|integer',
        ];

        $attributes = [
            'nmmnu' => 'Menu Name',
            'urlmnu' => 'URL Menu',
            'icnmnu' => 'Icon Menu',
            'grpmnu' => 'Group Menu',
            'prnmnu' => 'Parent Menu',
            'ordmnu' => 'Order Menu',
        ];

        $messages = [
            'required' => ':attribute is required.',
            'max' => ':attribute maximum :max characters.',
            'integer' => ':attribute must be an integer.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            Menu::create($validated);

            return redirect()->route('settings.menu')->with('success', 'Menu successfully created.');
        } catch (\Exception $e) {
            Log::error('Error MenuController@store: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to add menu: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $idmnu)
    {
        $validated = $request->validate([
            'nmmnu' => 'required|string|max:255',
            'urlmnu' => 'required|string|max:255',
            'icnmnu' => 'nullable|string|max:255',
            'grpmnu' => 'required|string|max:255',
            'prnmnu' => 'nullable|string|max:255',
            'ordmnu' => 'required|integer',
        ]);

        try {
            $menu = Menu::findOrFail($idmnu);
            $menu->update($validated);

            return redirect()->route('settings.menu')->with('success', 'Menu updated successfully.');

        } catch (\Exception $e) {
            Log::error('Error MenuController@update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed update menu : ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($idmnu)
    {
        try {
            $menu = Menu::findOrFail($idmnu);
            $menu->delete();

            return redirect()->route('settings.menu')->with('success', 'Menu deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Error MenuController@destroy: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed delete menu : ' . $e->getMessage());
        }
    }
}
