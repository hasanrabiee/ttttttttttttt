<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lounge extends Model
{
    protected $fillable = [
        'Name' , 'Members'
    ];
}
