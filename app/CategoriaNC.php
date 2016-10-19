<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaNC extends Model
{
    public $table = "categoriasNC";

    protected $fillable = [
        'descripcion'
    ];
}
