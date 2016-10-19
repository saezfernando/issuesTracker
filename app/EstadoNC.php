<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoNC extends Model
{
    public $table = "estadosNC";

    protected $fillable = [
        'descripcion'
    ];
}
