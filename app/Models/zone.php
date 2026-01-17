<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class zone extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'zone_Name',
        'district_id',
    ];

    public function district()
    {
        return $this->belongsTo(district::class, 'district_id');
    }
    public function landCategories()
    {
        return $this->hasMany(LandCategory::class);
    }
}
