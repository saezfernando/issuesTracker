<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropuestaMejora extends Model
{

    use SoftDeletes;

	public $table = "propuestaMejoras";

    protected $fillable = [
        'propuestaImplementar', 'recursosNecesarios','accionRealizada','fecha','fechaImplementacionEstimada','estado','doc','mime','size','nombre_archivo_original'
    ];

    protected $dates = ['deleted_at'];

    public function estadoDescripcion(){

    	return $this->belongsTo('App\EstadoCapacitacion','estado');
    }

    public function procedimientos(){

        return $this->hasMany('App\PropuestaMejoraProcedimientoOP','propuestaMejora');
    }

}
