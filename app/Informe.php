<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    public $table = "sysInformes";

    protected $fillable = [
        'descripcion','tabla'
    ];
}
