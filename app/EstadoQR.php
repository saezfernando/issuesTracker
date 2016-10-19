<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoQR extends Model
{
    public $table = "estadosQR";

    protected $fillable = [
        'descripcion'
    ];
}
