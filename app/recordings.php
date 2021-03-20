<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recordings extends Model
{
    protected $fillable = [
        "title",
        "speakers",
        "description",
        "active",
        "download_url",
        "play_url",
    ];
}
