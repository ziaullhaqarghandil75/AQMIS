<?php

namespace App\Http\Controllers;

use App\Models\owner;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\guzar;
use App\Models\block;
use App\Models\zone;
use App\Models\landCategory;

class DependentDropdownController extends Controller
{
    /**
     * Get Guzars by District
     */
    public function getGuzarsByDistrict($districtId)
    {
        $guzars = guzar::where('district_id', $districtId)
            ->select('id', 'guzar_number')
            ->orderBy('guzar_number')
            ->get();

        return response()->json($guzars);
    }

    /**
     * Get Blocks by Guzar
     */
    public function getBlocksByGuzar($guzarId)
    {
        $blocks = block::where('guzar_id', $guzarId)
            ->select('id', 'block_Number')
            ->orderBy('block_Number')
            ->get();

        return response()->json($blocks);
    }

    /**
     * Get Zones by District
     */
    public function getZonesByDistrict($districtId)
    {
        $zones = zone::where('district_id', $districtId)
            ->select('id', 'zone_Name')
            ->orderBy('zone_Name')
            ->get();

        return response()->json($zones);
    }

    /**
     * Get Categories by Zone
     */
    public function getCategoriesByZone($zoneId)
    {
        $categories = landCategory::where('zone_id', $zoneId)
            ->select('id', 'land_Category_Name', 'land_category_location', 'land_category_unit_Price')
            ->orderBy('land_Category_Name')
            ->get();

        return response()->json($categories);
    }
    /**
     * Get Categories by Zone
     */
    public function getOwnerByProject($project_id)
    {
        $owners = owner::where('project_id', $project_id)
            ->select('id', 'owner_First_Name', 'owner_Father_Name', 'owner_GFather_Name')
            ->orderBy('owner_First_Name')
            ->get();

        return response()->json($owners);
    }
}
