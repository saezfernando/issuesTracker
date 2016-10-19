<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalidadNC extends Model
{
    public $table = "calidadesNC";

    protected $fillable = [
        'descripcion'
    ];
}
