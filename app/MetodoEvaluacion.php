<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoEvaluacion extends Model
{
    public $table = "metodoEvaluaciones";

    protected $fillable = [
        'descripcion'
    ];
}
