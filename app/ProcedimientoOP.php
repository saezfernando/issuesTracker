<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcedimientoOP extends Model
{

	use SoftDeletes;

	public $table = "procedimientosOP";


    protected $fillable = [
        'titulo', 'dueño', 'codigo','certificado','fechaEmision','version','revision','estado',
        'doc','mime','size','nombre_archivo_original'
    ];

     public function versiones(){

        return $this->hasMany('App\ProcedimientoOPVersion','procedimiento');
    }

     public function ultimaVersion(){
     	
        return $this->hasMany('App\ProcedimientoOPVersion','procedimiento')->orderBy('version', 'desc')->orderBy('revision', 'desc')->limit(1);
    }

     public function ultimaVersionValidada(){
        
        return $this->hasMany('App\ProcedimientoOPVersion','procedimiento')->where('estado','1')->orderBy('version', 'desc')->orderBy('revision', 'desc')->limit(1);
    }


    public function estadoDescripcion(){

        return $this->belongsTo('App\EstadoP','estado');
    }

    public function certificadoDescripcion(){

        return $this->belongsTo('App\Certificado','certificado');
    }

    public function dueñoUser(){

        return $this->belongsTo('App\User','dueño');
    }

    public function indicadores(){

        return $this->hasMany('App\Indicador','procedimiento');
    }

}
