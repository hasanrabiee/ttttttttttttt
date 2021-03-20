<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditoriumChat extends Model
{
    protected $fillable = [
        'UserID' , 'auditoriaID', 'Text', 'Username'
    ];


}
