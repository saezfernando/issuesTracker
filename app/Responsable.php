<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    public $table = "responsables";

    protected $fillable = [
        'descripcion'
    ];
}
