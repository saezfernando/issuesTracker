<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoComunicacion extends Model
{
     public $table = "tipoComunicaciones";

    protected $fillable = [
        'descripcion'
    ];
}
