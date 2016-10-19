<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Indicador extends Model
{

	use SoftDeletes;

	public $table = "indicadores";


    protected $fillable = [
        'titulo', 'procedimiento', 'responsable','actividad','objetivo','indicadorDescripcion','frecuencia','fecha','resultadosObtenidos','observaciones','observacionesDireccion','meta','formula','medida','fuenteInformacion','enlaceEncuesta',
        'doc','mime','size','nombre_archivo_original'
    ];
/*
     public function versiones(){

        return $this->hasMany('App\ProcedimientoOPVersion','procedimiento');
    }

     public function ultimaVersion(){
     	
        return $this->hasMany('App\ProcedimientoOPVersion','procedimiento')->orderBy('version', 'desc')->orderBy('revision', 'desc')->limit(1);
    }
*/


    public function frecuenciaDescripcion(){

        return $this->belongsTo('App\Frecuencia','frecuencia');
    }

    public function medidaDescripcion(){

        return $this->belongsTo('App\Medida','medida');
    }

    public function procedimientoDescripcion(){

        return $this->belongsTo('App\ProcedimientoOP','procedimiento');
    }

    public function responsableUser(){

        return $this->belongsTo('App\User','responsable');
    }

    public function seguimientos(){

        return $this->hasMany('App\Seguimiento','indicador');
    }


}
