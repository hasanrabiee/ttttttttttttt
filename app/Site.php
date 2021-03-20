<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'Name' , 'Description' , 'Logo1' ,'Logo2','Logo3','AdminBackground',
        'Terms' , 'AdminTel' , 'AdminLocation' , 'AdminAddress','SigninBackground',
        'ExhabitionTitle' , 'VisitorBackGround' ,'VisitorWelcome' ,'VisitorAbout' ,'VisitorAboutPayment',
        'VisitorPayment' , 'VisitorGender' ,'VisitorProfession' , 'ExhibitorBackGround',
        'ExhibitorWelcome' , 'ExhibitorAbout' , 'ExhibitorAboutPayment' , 'ExhibitorPayment' ,
        'ExhibitorGender' , 'ExhibitorProfession' , 'ExhibitorMaximumOperator', 'MoneyType',
        'RtmpAddress' , 'StreamKey', 'PlaybackUrl'
    ];

    public static function AdminBackground(){
        return Site::find(1)->AdminBackground;
    }
    public static function VisitorBackground(){
        return Site::find(1)->VisitorBackGround;
    }
    public static function ExhibitorBackground(){
        return Site::find(1)->ExhibitorBackGround;
    }
}
