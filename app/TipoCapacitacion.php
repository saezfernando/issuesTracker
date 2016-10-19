<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoCapacitacion extends Model
{
     public $table = "tipoCapacitaciones";

    protected $fillable = [
        'descripcion'
    ];
}
