<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fortaleza extends Model
{
    public $table = "fortalezas";

    protected $fillable = [
        'descripcion'
    ];
}
