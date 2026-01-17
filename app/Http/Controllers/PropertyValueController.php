<?php

namespace App\Http\Controllers;

use App\Models\buildingCategory;
use App\Models\district;
use App\Models\emaratType;
use App\Models\propertyValue;
use Illuminate\Http\Request;

class PropertyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propertiesvalues = propertyValue::all();
        return view('property_value.index', compact('propertiesvalues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Scale' => 'required',
            'emarat_type_id' => 'required',
            'property_Id' => 'required',
        ]);

        $propertyValue = new propertyValue();
        $propertyValue->Number_of_Floors = $request->Number_of_Floors;
        $propertyValue->emarat_type_id = $request->emarat_type_id;
        $propertyValue->property_Id = $request->property_Id;
        $propertyValue->land_categories_id = $request->land_categories_id;
        $propertyValue->building_category_id = $request->building_category_id;
        $propertyValue->Scale = $request->Scale;
        $propertyValue->save();
        $get_propertiesValue_by_property = PropertyValue::with([
            'property:id,property_plan_Number,property_Location',
            'emaratType:id,emarat_Type_Name',
            'buildingCategory:id,building_Category_Type_Name,building_Category_unit_type,building_Category_unit_Price',
            'landCategory:id,land_Category_Name,land_category_unit_Price',
        ])
            ->where('property_id', $request->property_Id)
            ->get();
        return response()->json(['success' => 'Property Value created successfully.', 'data' => $get_propertiesValue_by_property]);
    }

    /**
     * Display the specified resource.
     */
    public function show($property_Id)
    {
        $disticts = district::all();
        $emarats = emaratType::all();
        $buildingCategories = buildingCategory::all();
        return view('property_value.create', compact('emarats', 'buildingCategories', 'disticts', 'property_Id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(propertyValue $propertyValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, propertyValue $propertyValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(propertyValue $propertyValue)
    {
        //
    }
}
