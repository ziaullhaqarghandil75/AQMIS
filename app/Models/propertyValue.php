<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class propertyValue extends Model
{

    public function property()
    {
        return $this->belongsTo(property::class, 'property_id');
    }
    public function emaratType()
    {
        return $this->belongsTo(emaratType::class, 'emarat_type_id');
    }
    public function buildingCategory()
    {
        return $this->belongsTo(buildingCategory::class, 'building_category_id');
    }
    public function landCategory()
    {
        return $this->belongsTo(landCategory::class, 'land_categories_id');
    }
}
