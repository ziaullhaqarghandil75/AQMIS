<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class property extends Model
{
    protected $fillable = [
        'property_Location',
        'property_house_Number',
        'property_plan_Number',
        'property_remarks',
        'Property_Pricing_Date',
        'property_sketch_image',
        'property_North',
        'property_South',
        'property_East',
        'property_West',
        'property_Parcel_Number',
        'property_Code_Number',
        'owner_id',
        'project_id',
        'block_id',
    ];
    public function project()
    {
        return $this->belongsTo(project::class, 'project_id');
    }
    public function owner()
    {
        return $this->belongsTo(owner::class, foreignKey: 'owner_id');
    }
    public function block()
    {
        return $this->belongsTo(block::class, 'block_id');
    }
    function propertyValue()
     {
        return $this->hasMany(propertyValue::class, 'property_id');
    }
}
