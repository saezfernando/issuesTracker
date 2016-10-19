<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NoConformidad extends Model
{
    use SoftDeletes;

	public $table = "NoConformidades";

    protected $fillable = [
        'procedimiento', 'requisitoIncumple','fechaIntervencion','estado','categoria','descripcion','correccion','fechaImplementacion','accionCorrectiva','fechaImplementacionAC','fechaVerificacionAC','origen','doc','mime','size','nombre_archivo_original','informeAuditoria'
    ];


    public function requisitoIncumpleDescripcion(){

    	return $this->belongsTo('App\RequisitoIncumple','requisitoIncumple');
    }

    public function categoriaDescripcion(){

    	return $this->belongsTo('App\CategoriaNC','categoria');
    }

    public function origenDescripcion(){

    	return $this->belongsTo('App\OrigenNC','origen');
    }

    public function estadoDescripcion(){

    	return $this->belongsTo('App\EstadoNC','estado');
    }

    public function procedimientoDescripcion(){

        return $this->belongsTo('App\ProcedimientoOP','procedimiento');
    }

    public function informeAuditoriaDescripcion(){

        return $this->belongsTo('App\InformeAuditoria','informeAuditoria');
    }
    

}
