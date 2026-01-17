<?php

namespace App\Http\Controllers;

use App\Models\buildingCategory;
use Illuminate\Http\Request;

class BuildingCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $building_categories = buildingCategory::all();
        return view('building_category.index', compact('building_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('building_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'building_Category_Type_Name' => 'required|string:max:255',
            'building_Category_details' => 'required|string:max:255',
            'building_Category_unit_type' => 'required|string:max:255',
            'building_Category_unit_Price' => 'required|integer',
        ]);
        buildingCategory::create($request->all());
        return redirect()->route('buildingCategory.index')->with('success', 'Building Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(buildingCategory $buildingCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(buildingCategory $buildingCategory)
    {
        // dd($buildingCategory);
        return view('building_category.edit', compact('buildingCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, buildingCategory $buildingCategory)
    {
        $request->validate([
            'building_Category_Type_Name' => 'required|string:max:255',
            'building_Category_details' => 'required|string:max:255',
            'building_Category_unit_type' => 'required|string:max:255',
            'building_Category_unit_Price' => 'required|integer',
        ]);
        $buildingCategory->update($request->all());
        return redirect()->route('buildingCategory.index')->with('success', 'Building Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(buildingCategory $buildingCategory)
    {
        $buildingCategory->delete();
        return redirect()->route('buildingCategory.index')->with('success', 'Building Category deleted successfully.');
    }
}
