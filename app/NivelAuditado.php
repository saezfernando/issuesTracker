<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelAuditado extends Model
{
    public $table = "nivelesauditados";

    protected $fillable = [
        'descripcion'
    ];
}
