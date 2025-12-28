<?php

namespace App\Models\UserSettings;

use Illuminate\Database\Eloquent\Model;

class PermissionCategory extends Model
{
    protected $guarded  = [];

    // در مدل PermissionCategory
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'permission_category_id', 'id');
    }
}
