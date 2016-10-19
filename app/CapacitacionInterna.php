<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CapacitacionInterna extends Model
{

    use SoftDeletes;

	public $table = "capacitacioninternas";

    protected $fillable = [
        'titulo', 'tipo', 'objetivo','disertantes','procedimiento','area','fechaInicio','fechaFin',
        'estado','observaciones','metodoEvaluacionEficacia','evaluacionCapacitacion',
        'responsableEvaluacionEficacia','año',
        'doc','mime','size','nombre_archivo_original'
    ];

    protected $dates = ['deleted_at'];

    public function tipoDescripcion(){

    	return $this->belongsTo('App\TipoCapacitacion','tipo');
    }

    public function procedimientoDescripcion(){

    	return $this->belongsTo('App\ProcedimientoOP','procedimiento');
    }

    public function areaDescripcion(){

    	return $this->belongsTo('App\Area','area');
    }

    public function estadoDescripcion(){

    	return $this->belongsTo('App\EstadoCapacitacion','estado');
    }
    public function metodoEvaluacionDescripcion(){

        return $this->belongsTo('App\MetodoEvaluacion','metodoEvaluacionEficacia');
    }

    public function evaluacionCapacitacionDescripcion(){

        return $this->belongsTo('App\EvaluacionCapacitacion','evaluacionCapacitacion');
    }

}
