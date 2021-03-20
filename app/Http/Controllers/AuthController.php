<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function register($Type){
        if ($Type == 'exhibitor'){
            return view('auth.register-Exhibitor');
        }else{
            return view('auth.register-Visitor');
        }
    }

    public function registerPOST(Request  $request){
        $request->validate([
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            'UserName' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|confirmed',
            'BirthDate' => 'required|date',
            'Gender' => 'required|string',
            'PhoneNumber' => 'required|string',
            'CountryCode' => 'required|string',
            'City' => 'required|string',
            'Profession' => 'required|string',
        ]);
        try {
            $User = User::create([
                'FirstName' => $request->FirstName,
                'LastName' => $request->LastName,
                'UserName' => $request->UserName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'BirthDate' => $request->BirthDate,
                'Gender' => $request->Gender,
                'PhoneNumber' => $request->CountryCode.$request->PhoneNumber,
                'City' => $request->City,
                'Profession' => $request->Profession ?? '',
            ]);







            return view('auth.verify');


        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception->getMessage());
        }
    }


    public function loginshow(){
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        if (Auth::attempt($validator)) {
            if (Auth::user()->email_verified_at == null){
                return  view('auth.verify');
            }
            return redirect()->route('home');
        }
        return  redirect()->back();
    }



    public function logout()
    {

        Session::flush();
        flash('Logout Successful', 'success');
        Auth::logout();
        return back();
    }

    public function jobSeeker()
    {

        return view("auth.register-jobseeker");

    }

    public function UserCompanyRegister()
    {

        return view("auth.register-company-user");

    }

    public function selectForm()
    {
        return view("auth.register-select");
    }

}
