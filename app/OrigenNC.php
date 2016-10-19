<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrigenNC extends Model
{
    public $table = "origenesNC";

    protected $fillable = [
        'descripcion'
    ];
}
