<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComunicacionInterna extends Model
{
    use SoftDeletes;

	public $table = "comunicacionInternas";

    protected $fillable = [
        'comunicacion', 'fecha', 'dueño','contenido','tipoComunicacion',
        'doc','mime','size','nombre_archivo_original'
    ];

    protected $dates = ['deleted_at'];

    public function tipoDescripcion(){

    	return $this->belongsTo('App\TipoComunicacion','tipoComunicacion');
    }
}
