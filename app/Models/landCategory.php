<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class landCategory extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'land_Category_Name',
        'land_category_location',
        'land_category_unit_Price',
        'zone_id',
    ];


    public function zone()
    {
        return $this->belongsTo(zone::class, 'zone_id');
    }
}
