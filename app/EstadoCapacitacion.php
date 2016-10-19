<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoCapacitacion extends Model
{
    public $table = "estadoCapacitaciones";

    protected $fillable = [
        'descripcion'
    ];
}
