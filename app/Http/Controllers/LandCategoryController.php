<?php

namespace App\Http\Controllers;

use App\DataTables\System\LandCategoryDataTable;
use App\Models\district;
use App\Models\landCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LandCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LandCategoryDataTable $LandCategoryDataTable, Request $request)
    {
        if (!(auth()->user()->can('view_land_category'))) {
            return view('layouts.403');
        }
        $districts = auth()->user()->district_id === null
            ? district::get()->toArray()
            : (auth()->user()->district ? [auth()->user()->district->toArray()] : []);

        return $LandCategoryDataTable->render('system.land_category', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getLandCategory($id)
    {
        $landCategory = LandCategory::findOrFail($id);
        return response()->json($landCategory);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!(auth()->user()->can('add_land_category'))) {
            return view('layouts.403');
        }
        $request->validate([
            'district_id' => 'required|not_in:0|exists:districts,id',
            'zone_id'     => 'required|not_in:0|exists:zones,id',

            'land_Category_Name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('land_categories', 'land_Category_Name')
                    ->where('zone_id', $request->zone_id),
            ],

            'land_category_unit_Price' => 'required|numeric',
            'land_category_location'   => 'required|string',
        ]);

        $landCategory                           = new LandCategory();
        $landCategory->zone_id                  = $request->zone_id;
        $landCategory->land_Category_Name       = $request->land_Category_Name;
        $landCategory->land_category_unit_Price = $request->land_category_unit_Price;
        $landCategory->land_category_location   = $request->land_category_location;
        $landCategory->save();

        return redirect()->back()->with('success', 'معلومات شما موفقانه اضافه شد');
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!auth()->user()->can('edit_land_category')) {
            return view('layouts.403');
        }

        $request->validate([
            'district_id' => 'required|not_in:0|exists:districts,id',
            'zone_id'     => 'required|not_in:0|exists:zones,id',
            'land_Category_Name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('land_categories', 'land_Category_Name')
                    ->where('zone_id', $request->zone_id)
                    ->ignore($id),
            ],
            'land_category_unit_Price' => 'required|numeric',
            'land_category_location'   => 'required|string',
        ]);

        $landCategory = LandCategory::findOrFail($id);
        $landCategory->zone_id = $request->zone_id;
        $landCategory->land_Category_Name = $request->land_Category_Name;
        $landCategory->land_category_unit_Price = $request->land_category_unit_Price;
        $landCategory->land_category_location = $request->land_category_location;
        $landCategory->save();

        return redirect()->back()->with('success', 'معلومات با موفقیت بروزرسانی شد');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!(auth()->user()->can('delete_land_category'))) {
            return view('layouts.403');
        }
        $landCategory = landCategory::findOrFail($id);

        $landCategory->delete();

        return redirect()->back()
            ->with('success', 'کتگوری موفقانه حذف شد.');
    }
}
