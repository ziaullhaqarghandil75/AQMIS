<?php

namespace App\Models\UserSettings;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded  = [];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles');
    }
}
