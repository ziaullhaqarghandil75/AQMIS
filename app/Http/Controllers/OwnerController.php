<?php

namespace App\Http\Controllers;

use App\Models\owner;
use App\Models\project;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = owner::all();
        return view('owner.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = project::all();
        return view('owner.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'owner_First_Name' => 'required|string|max:255',
            'owner_Father_Name' => 'required|string|max:255',
            'owner_GFather_Name' => 'required|string|max:255',
            'owner_tazkira_Number' => 'required|integer',
            'project_id' => 'required|integer',
        ]);

        owner::create($request->all());

        return redirect()->route('owners.index')->with('success', 'owner created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(owner $owner)
    {
        $owner = owner::find($owner->id);
        return view('owner.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, owner $owner)
    {
        $request->validate([
            'owner_First_Name' => 'required|string|max:255',
            'owner_Father_Name' => 'required|string|max:255',
            'owner_GFather_Name' => 'required|string|max:255',
            'owner_tazkira_Number' => 'required|integer',
        ]);

        $owner->update($request->all());

        return redirect()->route('owners.index')->with('success', 'person updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(owner $owner)
    {
        $owner->delete();

        return redirect()->route('owners.index')->with('success', 'owner deleted successfully.');
    }
}
