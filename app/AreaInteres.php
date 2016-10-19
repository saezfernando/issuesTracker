<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaInteres extends Model
{
    public $table = "areaIntereses";

    protected $fillable = [
        'descripcion'
    ];
}
