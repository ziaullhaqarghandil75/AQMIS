<?php

namespace App\Models\Property;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Property extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function district_letter()
    {
        return $this->hasOne(DistrictLetter::class);
    }

    public function suggesstion()
    {
        return $this->hasMany(Suggestion::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'property_id');
    }

    public function transformAudit(array $data): array
    {
        $data['property_id'] = $this->getKey();
        return $data;
    }
}
