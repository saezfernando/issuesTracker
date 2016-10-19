<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InformeAuditoriaAuditor extends Model
{
    public $table = "informeAuditoriaAuditores";

    protected $fillable = [
        'auditor','informeAuditoria'
    ];

public function auditoriaDescripcion(){

    	return $this->belongsTo('App\Auditor','auditor');
    }    

}
