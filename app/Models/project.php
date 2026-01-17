<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    protected $fillable = [
        'Project_Name',
        'Project_File_Path',
        'Project_GIS_Shape_File_Path',
    ];
}
