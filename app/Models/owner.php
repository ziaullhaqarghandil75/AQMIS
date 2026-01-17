<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class owner extends Model
{
    protected $fillable = [
        'owner_First_Name',
        'owner_Father_Name',
        'owner_GFather_Name',
        'owner_tazkira_Number',
        'project_id',
    ];
}
