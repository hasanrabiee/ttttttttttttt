<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditorium extends Model
{
    protected $fillable = [
        'Start' , 'End' , 'Status' , 'SpeakerID' , 'Day'
    ];

    public function Speaker(){
        return $this->belongsTo(Speaker::class,'SpeakerID','id');
    }
}
