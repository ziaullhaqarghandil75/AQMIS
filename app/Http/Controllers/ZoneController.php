<?php

namespace App\Http\Controllers;

use App\DataTables\System\ZoneDataTable;
use App\Models\district;
use App\Models\zone;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ZoneDataTable $ZoneDataTable, Request $request)
    {
        if (!(auth()->user()->can('view_zone'))) {
            return view('layouts.403');
        }
        $districts = auth()->user()->district_id === null
            ? district::get()->toArray()
            : (auth()->user()->district ? [auth()->user()->district->toArray()] : []);

        return $ZoneDataTable->render('system.zone', compact('districts'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!(auth()->user()->can('add_zone'))) {
            return view('layouts.403');
        }

        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'zone_Name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('zones')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('district_id', $request->district_id)
                            ->whereNull('deleted_at');
                    }),
            ],
        ]);


        $zone = new zone();
        $zone->zone_Name     = $request->zone_Name;
        $zone->district_id   = $request->district_id;
        $zone->save();
        return redirect()->back()->with('success', 'معلومات اضافه شد.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!(auth()->user()->can('edit_zone'))) {
            return view('layouts.403');
        }
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'zone_Name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('zones')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('district_id', $request->district_id)
                            ->whereNull('deleted_at');
                    })
                    ->ignore($id),
            ],
        ]);
        // dd($request->all(), $id);
        $zone                   = zone::findOrFail($id);
        $zone->zone_Name        = $request->zone_Name;
        $zone->district_id      = $request->district_id;
        $zone->save();

        return redirect()->back()->with('success', 'معلومات تصحیح گردید.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!(auth()->user()->can('delete_zone'))) {
            return view('layouts.403');
        }
        $zone = Zone::findOrFail($id);

        if ($zone->landCategories()->exists()) {
            return redirect()->back()
                ->with('error', 'این زون قابل حذف نیست چون در سیستم استفاده شده است.');
        }

        $zone->delete();

        return redirect()->back()
            ->with('success', 'زون موفقانه حذف شد.');
    }

    public function getZones($district_id)
    {
        $zones = Zone::where('district_id', $district_id)->get();
        return response()->json($zones);
    }
}
