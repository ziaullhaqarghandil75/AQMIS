<?php

namespace App\Models\UserSettings;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded  = [];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_roles');
    }
}
