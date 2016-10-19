<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionCapacitacion extends Model
{
    public $table = "evaluacionCapacitaciones";

    protected $fillable = [
        'descripcion'
    ];
}
