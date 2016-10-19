<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoP extends Model
{
    public $table = "estadosP";

    protected $fillable = [
        'descripcion'
    ];
}
