<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    protected $fillable=[
      "firstname","surname","phoneNumber","email","profile"
    ];
}
