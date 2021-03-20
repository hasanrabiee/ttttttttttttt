<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OperatorController extends Controller
{

    public function index($token){
        $Invite = Invitation::where('token' , $token)->first();
        if ($Invite == null || empty($Invite) || $Invite->count < 0){
            abort(404);
        }
        return view('auth.register-Operator')->with(['Invite'=> $Invite]);
    }
    public function Register(Request $request){

        $request->validate([
            'UserName' => 'required|string|unique:users',
            'FirstName' => 'required|string',
            'LastName' => 'required|string',
            'password' => 'required|string|min:8|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/',
            'email' => 'required|string|email|unique:users',
            'CountryCode' => 'required|string',
            'PhoneNumber' => 'required',
            'Rule' => 'string',
            'ParentID' => 'integer',
            'Image' => '/assets/img/DefaultPic.png',

        ]);
        if ($request->Rule == 'AdminOperator'){
            $User = User::create([
                'UserName' => $request->UserName,
                'FirstName' => $request->FirstName,
                'LastName' => $request->LastName,
                'password' => Hash::make($request->password),
                'City' => 'Universe',
                'email' => $request->email,
                'email_verified_at' => Carbon::now()->format('Y-m-d'),
                'Gender' => 'Operator',
                'Country' => 'Universe',
                'PhoneNumber' => $request->CountryCode .$request->PhoneNumber,
                'Profession' =>  $request->Rule == 'AdminOperator' ? 'Admin-Operator' : 'Exhibitor-Operator',
                'BirthDate' =>  Carbon::now()->format('Y-m-d'),
                'Rule' =>  $request->Rule == 'AdminOperator' ? 'Admin-Operator' : 'Exhibitor-Operator',
                'Image' => '/assets/img/DefaultPic.png',
                'AccountStatus' => 'Active',
                'Payment' => 'UnPaid',
                'ChatMode' => 'Available'
            ]);
            $User->markEmailAsVerified();
        }else{
            $User = User::create([
                'UserName' => $request->UserName,
                'FirstName' => $request->FirstName,
                'LastName' => $request->LastName,
                'password' => Hash::make($request->password),
                'City' => 'Universe',
                'email' => $request->email,
                'email_verified_at' => Carbon::now()->format('Y-m-d'),
                'Gender' => $request->Gender,
                'Country' => 'Universe',
                'PhoneNumber' => $request->PhoneNumber,
                'Profession' =>  $request->Profession ?? '',
                'BirthDate' =>  Carbon::now()->format('Y-m-d'),
                'Rule' =>  $request->Rule == 'AdminOperator' ? 'Admin-Operator' : 'Exhibitor-Operator',
                'Image' => '/assets/img/DefaultPic.png',
                'AccountStatus' => 'Active',
                'Payment' => 'UnPaid',
                'CompanyID' => $request->ParentID,
                'ChatMode' => 'Available'
            ]);
            $User->markEmailAsVerified();
        }
        $Invite = Invitation::where('token' , $request->token)->update([
            "token"=>"null"
        ]);
        if ($Invite == null || empty($Invite) || $Invite == "") {
            abort(404);
        }



        Auth::loginUsingId($User->id);
        return redirect()->route('login');
    }
}
