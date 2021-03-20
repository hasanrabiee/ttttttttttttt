<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'UserID' , 'BoothID' , 'Text','Sender','Owner','UserName', 'Status'
    ];
}
