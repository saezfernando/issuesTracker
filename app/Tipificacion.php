<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipificacion extends Model
{
         public $table = "tipificaciones";

    protected $fillable = [
        'descripcion'
    ];
}
