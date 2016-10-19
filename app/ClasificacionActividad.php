<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClasificacionActividad extends Model
{
    public $table = "clasificacionActividades";

    protected $fillable = [
        'descripcion'
    ];
}
