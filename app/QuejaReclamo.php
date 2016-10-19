<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuejaReclamo extends Model
{
    use SoftDeletes;

	public $table = "quejasReclamos";

    protected $fillable = [
        'titulo', 'estado', 'fechaCreacion','descripcion','responsable','derivadoA','solicitante','datosContacto','solucion','fechaImplementacion','fechaCierre','pnc','añoCreacion','comentarios', 'doc','mime','size','nombre_archivo_original'
    ];

	protected $dates = ['deleted_at'];

    public function estadoQRDescripcion(){

    	return $this->belongsTo('App\EstadoQR','estado');
    }

	public function responsableDescripcion(){

    	return $this->belongsTo('App\Responsable','responsable');
    }

	public function pncDescripcion(){

    	return $this->belongsTo('App\PNC','pnc');
    }


}
