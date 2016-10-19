<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    public $table = "medidas";

    protected $fillable = [
        'descripcion'
    ];
}
