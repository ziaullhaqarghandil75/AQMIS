<?php

namespace App\Models\Property;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class DistrictLetter extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function transformAudit(array $data): array
    {
        $data['property_id'] = $this->property->id;
        return $data;
    }
}
