<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedimientoOPVersion extends Model
{

	public $table = "procedimientosOPVersiones";

        protected $fillable = [
        'procedimiento', 'version', 'revision','estado','fechaRevision','revisadoPor','modificaciones','validadoPor','fechaValidacion', 'doc', 'mime','size','nombre_archivo_original'
    ];

    public function estadoDescripcion(){

        return $this->belongsTo('App\EstadoP','estado');
    }

    public function revisadoPorUser(){

        return $this->belongsTo('App\User','revisadoPor');
    }

	public function validadoPorUser(){

        return $this->belongsTo('App\User','validadoPor');
    }


}
