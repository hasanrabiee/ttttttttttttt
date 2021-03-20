<?php

namespace App\Http\Controllers;

use App\booth;
use App\Invitation;
use App\Jobs;
use App\Mail\exInfo;
use App\Mail\InviteOperators;
use App\Mail\SpeakerRegister;
use App\Site;
use App\Speaker;
use App\Traits\Uploader;
use App\User;
use Aws\S3\S3Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use MacsiDigital\Zoom\Facades\Zoom;
use RealRashid\SweetAlert\Facades\Alert;

class BoothController extends Controller
{
    use Uploader;

    public function Booth()
    {
        return booth::where('UserID', Auth::id())->get()[0];
    }


    public function Register()
    {
        return view('auth.register-Exhibitor');
    }


    public function RegisterOne(Request $request)
    {

//        dd($request);

        $myvar = 1;
        $request->validate([
            'password' => 'required|string|min:8|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/',
            'CompanyName' => 'required|string|unique:booths',
            'City' => 'required|string',
            'CountryCode' => 'required',
            'email' => 'required|string|email|unique:users',
            'Country' => 'required|string',
            'PhoneNumber' => 'required',
            'WebSite' => 'string|nullable',
        ]);
        $Payment = Site::find(1)->ExhabitorPayment;





        $PhoneNumber = preg_replace('/-/', '', $request->PhoneNumber);
        $PhoneNumber = preg_replace('/\(/', '', $PhoneNumber);
        $PhoneNumber = preg_replace('/\)/', '', $PhoneNumber);

        $dataex = [
            'UserName' => $request->CompanyName,
            'LastName' => 'User',
            'password' => $request->password,
            'City' => $request->City,
            'email' => $request->email,
            'Gender' => 'Company',
            'Country' => $request->Country,
            'PhoneNumber' => $PhoneNumber,
            'AccountStatus' => 'Suspend',
            'Payment' => $Payment > 0 ? 'UnPaid' : 'Paid',
            'PositionUser' => $request->PositionUser ? $request->PositionUser : ''
        ];


        Mail::to("test@test.com")->send(new exInfo($dataex));

        $User = User::create([
            'UserName' => $request->CompanyName,
            'FirstName' => $request->FirstName != null ? $request->FirstName : 'System',
            'LastName' => $request->LastName != null ? $request->LastName : 'User',
            'password' => Hash::make($request->password),
            'City' => $request->City,
            'email' => $request->email,
            'Gender' => $request->Gender,
            'Country' => $request->Country,
            'PhoneNumber' => $PhoneNumber,
            'AccountStatus' => 'Suspend',
            'Payment' => $Payment > 0 ? 'UnPaid' : 'Paid',
            'Rule' => 'Exhibitor',
            'Image' => '/assets/img/DefaultPic.png',
            'PositionUser' => $request->PositionUser ? $request->PositionUser : '',
            'companyAddress' => isset($request->companyAddress) ? $request->companyAddress :null,
            'zipCode'=>isset($request->zipCode) ? $request->zipCode : null,
            'mainCompany'=>isset($request->mainCompany) ? $request->mainCompany :null,
            'institutionEmail'=>isset($request->institutionEmail) ? $request->institutionEmail : null,
            'phone'=>isset($request->phone) ? $request->phone : null,
            'fax'=>isset($request->fax) ? $request->fax : null,
            'institution'=>isset($request->institution) ? $request->institution : null,
            'ChatMode'=>'Available',
            "profile"=>isset($request->profile) ? $request->profile : null,
            "subProfile"=>isset($request->subProfile) ? $request->subProfile : null,
            "tel"=>isset($request->tel) ? $request->tel : null,
        ]);





        $Booth = booth::create([
            'CompanyName' => $request->CompanyName,
            'Representative' => $request->Representative == null ? "null" : $request->Representative,
            'WebSite' => $request->WebSite != null ? $request->WebSite : '',
            'Status' => 'DeActive',
            'UserID' => $User->id,
        ]);


        return view('Errors.ActiveAccount', compact('myvar'));
    }

    public function RegisterTo()
    {
        $BoothID = booth::where('UserID', Auth::id())->get()[0];
        $UserID = Auth::id();
        if ($BoothID->StepTwo == 'Waiting') {
            return view('auth.register-ExhibitorStepTwo')->with(['UserID' => $UserID, 'BoothID' => $BoothID->id]);

        } else {
            return redirect()->back();
        }


    }

    public function RegisterTwo(Request $request)
    {


        $BoothID = booth::where("UserID",\auth()->user()->id)->first()->id;

        $request->validate([
            'OperatorEmail' => 'string',
        ]);


        $Invite = Invitation::create([
            'email' => $request->OperatorEmail,
            'token' => Str::random(20),
            'Rule' => 'ExhibitorOperator',
            'ParentID' => $BoothID]);

        Mail::to($request->OperatorEmail)->send(new InviteOperators($Invite->token));

        Alert::success("Your Operator Created Successfully And Mail Sent To it");


//        if($request->has('need_live_conf')){
//
//
//
//            $request->validate([
//                'Name' => 'required|string',
//                'email' => 'required|string|unique:speakers',
//                'UserName' => 'required|string|unique:speakers',
//                'password' => 'required|string|min:8|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/',
//                'SpeechTitle' => 'required|string',
//                'PreferredDate1' => 'required|date',
//                'PreferredDate2' => 'required|date',
//                'PreferredDate3' => 'required|date',
//            ]);
//
//
//
//            $Speaker = Speaker::create([
//                'Name' => $request->Name,
//                'email' => $request->email,
//                'UserName' => $request->UserName,
//                'password' => $request->password,
//                'SpeechTitle' => $request->SpeechTitle,
//                'PreferredDate1' => $request->PreferredDate1,
//                'PreferredDate2' => $request->PreferredDate2,
//                'PreferredDate3' => $request->PreferredDate3,
//
//            ]);
//
//            $data = [
//                'Name' => $request->Name,
//                'email' => $request->email,
//                'UserName' => $request->UserName,
//                'password' => $request->password,
//                'Speech Title' => $request->SpeechTitle,
//
//            ];
//
//
//            Mail::to($Speaker->email)->send(new SpeakerRegister($data));
//
//
//
//
//        }



        return redirect()->back();
    }

    public function RegisterThree()
    {
        $Booth = $this->Booth();
        return view('auth.register-ExhibitorStepThree')->with(['Booth' => $Booth]);
    }


    public function RegisterThreePost(Request $request)
    {

        $request->validate([
            'Logo' => 'image',
            'Description' => 'string|nullable',
            'Position' => 'required|string',
            'HeaderName' => 'required|string',
            'WebSiteColor' => 'required|string',
            'Color1' => 'required|string',
            'Color2' => 'required|string',
            'Mode' => 'required|string'
        ]);
        $HallConvertor = [
            'a' => 1,
            'b' => 2,
            'c' => 3,
            'd' => 4
        ];


        $Convertor = [
            'booth_01' => 10,
            'booth_02' => 12,
            'booth_03' => 14,
            'booth_04' => 11,
            'booth_05' => 13,
            'booth_06' => 15,
            'booth_07' => 16,
            'booth_08' => 19,
            'booth_09' => 17,
            'booth_10' => 18,
            'booth_11' => 20,
            'booth_12' => 22,
            'booth_13' => 24,
            'booth_14' => 21,
            'booth_15' => 23,
            'booth_16' => 25,
            'booth_17' => 1,
            'booth_18' => 2,
            'booth_19' => 3,
            'booth_20' => 4,
            'booth_21' => 5,
            'booth_22' => 6,
            'booth_23' => 7,
            'booth_24' => 8,
            'booth_25' => 9
        ];


        $D = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
        $A = array(10, 11, 12, 13, 14, 15);
        $B = array(16, 17, 18, 19);
        $C = array(20, 21, 22, 23, 24, 25);
        $Position = $Convertor[$request->Position];
        $Type = '';
        if (in_array($Position, $A)) {
            $Type = 'A';
        } elseif (in_array($Position, $B)) {
            $Type = 'B';
        } elseif (in_array($Position, $C)) {
            $Type = 'C';
        } elseif (in_array($Position, $D)) {
            $Type = 'D';
        }


//        $Booth = booth::where('Hall' , $HallConvertor[$request->Hall])->where('Position' , $Convertor[$Position])->count();
//        if ($Booth >= 1){
//            Alert::error('Selected Booth is been taken by another user');
//            return redirect()->back();
//        }

        $Booth = $this->Booth();
        $Booth->Logo = $request->hasFile('Logo') ? $this->S3($request, 'Logo') : $Booth->Logo;
        $Booth->Description = $request->Description;
        $Booth->Type = $Type;
        $Booth->HeaderName = $request->HeaderName;
        $Booth->WebSiteColor = $request->WebSiteColor;
        $Booth->Color1 = $request->Color1;
        $Booth->Color2 = $request->Color2;
        $Booth->Position = $Position;
        $Booth->Hall = $HallConvertor[$request->Hall];
        $Booth->save();
        if ($request->Mode == 'Test') {
            Alert::success('Settings Saved');
            return redirect()->back();
        } elseif ($request->Mode == 'Finish') {
            $Booth->Status = 'Active';
            $Booth->save();



            Zoom::user()->create([
                'first_name' => $Booth->CompanyName . '_company',
                'last_name' => $Booth->CompanyName . '_company',
                'email' => Auth::user()->email,
                'password' => '1234@qwe'
            ]);





            return redirect()->route('Exhibitor.index');
        }





    }


}
