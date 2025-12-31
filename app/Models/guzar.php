<?php

namespace App\Models;

use App\Models\district;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class guzar extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function district()
    {
        return $this->belongsTo(district::class, 'district_id', 'id');
    }

}
