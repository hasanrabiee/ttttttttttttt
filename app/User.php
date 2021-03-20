<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FirstName', 'LastName', 'email', 'UserName',
        'PhoneNumber', 'Position', 'Gender', 'password',
        'Image','AccountStatus','City','Country','Payment',
        'BirthDate','CompanyID','VisitExperience','Rule',
        'Profession','City','ChatMode','PositionUser','email_verified_at', 'laravel_remember_session',
        'companyAddress','zipCode','mainCompany','institutionEmail',
        'phone','fax','institution','education','countryStudy','interestedDegree','interestedField',
        'languageOfStudy','onlineDegreeProgram','interestedScholarShip',
        'device_token','admissionSemester','InterNationalPrograms',
        'professionInterestedToApply','userCompanyName','profile','website','tel','app_token','position','formRule','subProfile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function Booth(){
        return $this->hasOne(booth::class,'UserID','id');
    }

    public function AuditoriumChat() {

        return $this->hasMany('App\AuditoriumChat');

    }




    public function isOnline()
    {
        return Cache::has('user-is-online-'.$this->id);
    }

}
