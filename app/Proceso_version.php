<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceso_version extends Model
{
	    protected $fillable = [
        'proceso_id', 'version', 'estado','fecha_creacion','creado_por','fecha_revision','revisado_por', 'doc', 'mime','size','nombre_archivo_original'
    ];

    
}
