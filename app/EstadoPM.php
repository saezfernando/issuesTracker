<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoPM extends Model
{
    public $table = "estadosPM";

    protected $fillable = [
        'descripcion'
    ];
}
