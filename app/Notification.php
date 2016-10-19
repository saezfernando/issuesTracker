<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'motivo','body', 'read','emisor','notifiable_id', 'notifiable_type',
    ];
}
