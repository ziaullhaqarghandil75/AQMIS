<?php

namespace App\Http\Controllers;

use App\DataTables\System\GuzarDataTable;
use App\Http\Controllers\Controller;
use App\Models\district;
use App\Models\guzar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuzarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GuzarDataTable $GuzarDataTable, Request $request)
    {
        if (!(Auth::user()->can('view_guzar'))) {
            return view('layouts.403');
        }
        $districts = Auth::user()->district_id === null
            ? district::get()->toArray()
            : (Auth::user()->district ? [Auth::user()->district->toArray()] : []);

        return $GuzarDataTable->render('system.guzar', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!(Auth::user()->can('add_guzar'))) {
            return view('layouts.403');
        }
        $request->validate([
            'guzar_number' => ['required', 'numeric'],
            'district_id' => ['required', 'exists:districts,id'],
        ]);
        $lastGuzarNo = guzar::where('district_id', $request->district_id)
            ->max('guzar_number') ?? 0;

        $addedCount = 0;

        for ($i = 1; $i <= $request->guzar_number; $i++) {
            $guzar                  = new Guzar();
            $guzar->guzar_number    = $lastGuzarNo + $i;
            $guzar->district_id     = $request->district_id;
            $guzar->save();

            $addedCount++;
        }


        return redirect()->back()->with('success', 'معلومات اضافه شد.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (!(Auth::user()->can('delete_guzar'))) {
            return view('layouts.403');
        }
        // $relatedRecords = BaseLandDeedDistrict::where('guzar_id', $id)->exists();

        // if ($relatedRecords) {
        //     return redirect()->back()->with('error', 'این گذر قابل حذف نیست.');
        // }
        $guzar = Guzar::findOrFail($id);
        $guzar->delete();

        return redirect()->back()->with('success', 'گذر موفقانه حذف شد.');
    }
}
