<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PNC extends Model
{
    public $table = "pncs";

    protected $fillable = [
        'descripcion'
    ];
}
