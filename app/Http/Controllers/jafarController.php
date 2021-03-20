<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class jafarController extends Controller
{
    public function myusers(Request $request){

        $users = User::paginate(1);
        if ($request->ajax()) {
            $view = view('jafar-data',compact('users'))->render();
            return response()->json(['html'=>$view]);
        }


        return view('jafar',compact('users'));




    }
}
