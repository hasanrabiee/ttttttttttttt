<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HallController extends Model
{
    protected $fillable = [
        'Loby1', 'Loby2', 'Loby3', 'Loby4',
        'Main1','Main2','Main3','Main4','Main5',
        'Billboard1','Billboard2','Billboard3','Billboard4','Billboard5','Billboard6',
        'Stand1','Stand2','Stand3','Stand4','Stand5','Stand6','Stand7',
        'Wallposter1','Wallposter2','Wallposter3','Wallposter4','Wallposter5','Wallposter6','Wallposter7','Wallposter8',
        'Rotationposter1','Rotationposter2','Rotationposter3','Rotationposter4','Rotationposter5','Rotationposter6',
        'Panposter1','Panposter2','Panposter3',
        'Text1','Text2','Text3'
    ];
}
