<?php

namespace App\Http\Controllers;

use App\DataTables\System\BlockDataTable;
use App\Http\Controllers\Controller;
use App\Models\block;
use App\Models\district;
use App\Models\guzar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlockDataTable $BlockDataTable, Request $request)
    {
        if (!(Auth::user()->can('view_block'))) {
            return view('layouts.403');
        }
        $districts = Auth::user()->district_id === null
            ? District::get()->toArray()
            : (Auth::user()->district ? [Auth::user()->district->toArray()] : []);

        $selectedDistrictId = old('district_id', Auth::user()->district_id ?? null);
        $selectedGuzarId = old('guzar_id');

        return $BlockDataTable->render('system.block', compact('districts', 'selectedDistrictId', 'selectedGuzarId'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function get_guzars($district_id)
    {
        if (!District::where('id', $district_id)->exists()) {
            return response()->json(['error' => 'ناحیه پیدا نشد'], 404);
        }
        $guzars = guzar::where('district_id', $district_id)
            ->orderBy('guzer_Number')
            ->pluck('guzer_Number', 'id');
        return response()->json($guzars);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!(Auth::user()->can('add_block'))) {
            return view('layouts.403');
        }
        $request->validate([
            'district_id'   => ['required', 'exists:districts,id'],
            'guzar_id'      => ['required', 'exists:guzars,id'],
            'block'         => ['required', 'numeric'],
        ]);

        $guzar_id       = guzar::where('district_id', $request->district_id)->where('id', $request->guzar_id)->first();
        $lastBlockNo    = block::where('guzar_id', $guzar_id->id)->max('block_Number') ?? 0;

        $addedCount = 0;

        for ($i = 1; $i <= $request->block; $i++) {
            $guzar                  = new block();
            $guzar->block_Number    = $lastBlockNo + $i;
            $guzar->guzar_id        = $request->guzar_id;
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
        if (!(Auth::user()->can('delete_block'))) {
            return view('layouts.403');
        }
        // $relatedRecords = BaseLandDeedDistrict::where('block_no_id', $id)->exists();

        // if ($relatedRecords) {
        //     return redirect()->back()->with('error', 'این بلاک قابل حذف نیست.');
        // }
        $block = Block::findOrFail($id);
        $block->delete();

        return redirect()->back()->with('success', 'بلاک موفقانه حذف شد.');
    }
}
