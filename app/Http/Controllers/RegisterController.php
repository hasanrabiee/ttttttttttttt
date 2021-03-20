<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function Start(){
        return view('auth.register');
    }
    public function StepOne(Request $request){
        Session::push('StepOne', $request->all());
        return view('welcome');
    }
}
