<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoungeChat extends Model
{
    protected $fillable = [
        'UserID' , 'LoungeID' , 'Text', 'Username'
    ];




}
