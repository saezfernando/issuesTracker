<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitoIncumple extends Model
{
         public $table = "requisitoIncumple";

    protected $fillable = [
        'descripcion'
    ];
}
