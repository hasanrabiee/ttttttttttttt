<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminChat extends Model
{
    protected $fillable = [
        'UserID' , 'Text' , 'Sender' , 'ReceiverID','Status'
    ];
}
