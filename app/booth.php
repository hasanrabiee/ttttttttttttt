<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class booth extends Model
{
    protected $fillable = [
        'Type' , 'Color1' , 'HeaderName' ,
        'HeaderColor' , 'Logo' , 'Hall' ,
        'Status','UserID','Poster1',
        'Poster2','Poster3','HallColor',
        'Texture1','Texture2','Color2',
        'WebSite', 'Representative', 'CompanyName',
        'WebSiteColor','Video','Doc1',
        'Doc2','Position','Description'
    ];



    public function User(){
        return $this->belongsTo(User::class,'UserID','id');
    }

    public function Jobs(){
        return $this->hasMany(Jobs::class,'BoothID','id');
    }

    public static function Oprators($BoothID){
        return User::where('CompanyID' , $BoothID)->where('Rule' , 'Exhibitor-Operator')->get();
    }

    public static function PositionConvertor($BoothPosition){
        $Convertor = [
            10 => 'booth_01' ,
            12 => 'booth_02' ,
            14 => 'booth_03' ,
            11 => 'booth_04' ,
            13 => 'booth_05' ,
            15 => 'booth_06' ,
            16 => 'booth_07' ,
            19 => 'booth_08' ,
            17 => 'booth_09' ,
            18 => 'booth_10' ,
            20 => 'booth_11' ,
            22 => 'booth_12' ,
            24 => 'booth_13' ,
            21 => 'booth_14' ,
            23 => 'booth_15' ,
            25 => 'booth_16' ,
            1 => 'booth_17' ,
            2 => 'booth_18' ,
            3 => 'booth_19' ,
            4 => 'booth_20' ,
            5 => 'booth_21' ,
            6 => 'booth_22' ,
            7 => 'booth_23' ,
            8 => 'booth_24' ,
            9 => 'booth_25'
        ];
        return $Convertor[$BoothPosition];
    }
}
