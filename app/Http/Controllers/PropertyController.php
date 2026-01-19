<?php

namespace App\Http\Controllers;

use App\Models\buildingCategory;
use App\Models\property;
use App\Models\owner;
use App\Models\project;
use App\Models\district;
use App\Models\emaratType;
use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = property::all();
        return view('property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owners = owner::all();
        $projects = project::all();
        $disticts = district::all();

        return view('property.create', compact('owners', 'projects', 'disticts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_Location' => 'required',
            'property_house_Number' => 'required',
            'property_plan_Number' => 'required',
            'property_remarks' => 'required',
            'Property_Pricing_Date' => 'required',
            'property_sketch_image' => 'required',
            'property_North' => 'required',
            'property_South' => 'required',
            'property_East' => 'required',
            'property_West' => 'required',
            'property_Parcel_Number' => 'required',
            'property_Code_Number' => 'required',
            'owner_id' => 'required',
            'project_id' => 'required',
            'block_id' => 'required',
        ]);


        property::create($request->all());
        return redirect()->route('properties.index')->with('success', 'Property created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $property->load([
            'propertyValue' => function ($propertyValue) {
                $propertyValue->with([
                    'emaratType',
                    'buildingCategory',
                    'landCategory'
                ]);
            },
            'block',
            'owner',
            'project'
        ]);
        return view('property.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(property $property)
    {
        $owners = owner::all();
        $projects = project::all();
        $disticts = district::all();
        return view('property.edit', compact('property', 'owners', 'projects', 'disticts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, property $property)
    {
        $request->validate([
            'property_Location' => 'required',
            'property_house_Number' => 'required',
            'property_plan_Number' => 'required',
            'property_remarks' => 'required',
            'Property_Pricing_Date' => 'required',
            'property_sketch_image' => 'required',
            'property_North' => 'required',
            'property_South' => 'required',
            'property_East' => 'required',
            'property_West' => 'required',
            'property_Parcel_Number' => 'required',
            'property_Code_Number' => 'required',
            'owner_id' => 'required',
            'project_id' => 'required',
            'block_id' => 'required',
        ]);
        $property->update($request->all());
        return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(property $property)
    {
        //
    }
}
