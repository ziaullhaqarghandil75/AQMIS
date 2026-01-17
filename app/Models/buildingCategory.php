<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buildingCategory extends Model
{
    protected $fillable = [
        'building_Category_Type_Name',
        'building_Category_details',
        'building_Category_unit_type',
        'building_Category_unit_Price',
    ];
}
