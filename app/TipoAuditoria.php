<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAuditoria extends Model
{
    public $table = "tipoAuditorias";

    protected $fillable = [
        'descripcion'
    ];
}
