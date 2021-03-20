<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = [
        'cid', 'booth','nickname', 'email', 'Name', 'UserName', 'password', 'SpeechTitle', 'PreferredDate1', 'PreferredDate2', 'PreferredDate3', 'BoothID', 'StreamUrl', 'StreamID', 'HaveStreamKey'
    ];

    public function Booth()
    {
        return $this->belongsTo(booth::class, 'BoothID', 'id');
    }

    public function Speak()
    {
        return $this->hasOne(Auditorium::class, 'SpeakerID', 'id');
    }
}
