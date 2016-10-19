<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frecuencia extends Model
{
    public $table = "frecuencias";

    protected $fillable = [
        'descripcion'
    ];
}
