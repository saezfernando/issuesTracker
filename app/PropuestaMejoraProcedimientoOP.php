<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropuestaMejoraProcedimientoOP extends Model
{
    public $table = "propuestaMejorasProcedimientosOP";

    protected $fillable = [
        'procedimiento','propuestaMejora'
    ];

    public function procedimientoDescripcion(){

    	return $this->belongsTo('App\ProcedimientoOP','procedimiento');
    }    


}
