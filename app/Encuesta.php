<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Encuesta extends Model
{

    use SoftDeletes;

	public $table = "encuestas";

    protected $fillable = [
        'nombre', 'periodo','procedimiento','porcentajeSatisfaccion','tratamientoDesfavorable','porcentaje','causa','accionCorrectiva','enlaceEncuesta','enlaceReporte','doc','mime','size','nombre_archivo_original'
    ];

    protected $dates = ['deleted_at','periodo'];

    
    public function procedimientoDescripcion(){

        return $this->belongsTo('App\ProcedimientoOP','procedimiento');
    }

    public function periodoFormateado(){
        return $this->periodo->format('Y-m');
    }

}
