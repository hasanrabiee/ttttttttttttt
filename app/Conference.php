<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $fillable = [


        "booth",
"start_date",
"start_time",
"end_time",
"title",
"abstract",
"hall",
"crid",

        "webinar_id",
"webinar_name",
"webinar_password",
"start_url",
"started",
"is_active",
"finished",

    ];
}
