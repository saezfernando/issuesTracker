<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Auditor extends Model
{
    use SoftDeletes;

	public $table = "auditores";

    protected $fillable = [
        'descripcion'
    ];
}
