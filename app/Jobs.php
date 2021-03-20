<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $table = 'CompanyJobs';
    protected $fillable = [
        'Title' , 'Description' , 'Salary' , 'Number' , 'BoothID'
    ];
}
