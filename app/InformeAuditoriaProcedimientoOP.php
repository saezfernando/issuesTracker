<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformeAuditoriaProcedimientoOP extends Model
{
    public $table = "informeAuditoriaProcedimientosOP";

    protected $fillable = [
        'procedimiento','informeAuditoria'
    ];

    public function procedimientoDescripcion(){

    	return $this->belongsTo('App\ProcedimientoOP','procedimiento');
    }    


}
