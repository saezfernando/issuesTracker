<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InformeAuditoria extends Model
{
    use SoftDeletes;

	public $table = "informeAuditorias";

    protected $fillable = [
        'numero', 'tipo', 'fecha','auditorLider','nivelesAuditados','clasificacionActividad','añoCreacion','certificado','areaInteres','fortaleza',
        'doc','mime','size','nombre_archivo_original'
    ];

	protected $dates = ['deleted_at'];

    public function tipoDescripcion(){

    	return $this->belongsTo('App\TipoAuditoria','tipo');
    }

	public function auditorLiderDescripcion(){

    	return $this->belongsTo('App\Auditor','auditorLider');
    }

	public function nivelAuditadoDescripcion(){

    	return $this->belongsTo('App\NivelAuditado','nivelesAuditados');
    }

	public function clasificacionActividadDescripcion(){

    	return $this->belongsTo('App\ClasificacionActividad','clasificacionActividad');
    }

	public function certificadoDescripcion(){

    	return $this->belongsTo('App\Certificado','certificado');
    }

	public function areaInteresDescripcion(){

    	return $this->belongsTo('App\AreaInteres','areaInteres');
    }    

	public function fortalezaDescripcion(){

    	return $this->belongsTo('App\Fortaleza','fortaleza');
    }

    public function auditorEquipo(){

        return $this->hasMany('App\InformeAuditoriaAuditor','informeAuditoria');
    }

    public function noConformidades(){

        return $this->hasMany('App\NoConformidad','informeAuditoria');
    }

    public function procedimientos(){

        return $this->hasMany('App\InformeAuditoriaProcedimientoOP','informeAuditoria');
    }

}
