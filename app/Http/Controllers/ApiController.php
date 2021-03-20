<?php

namespace App\Http\Controllers;

use App\AdminChat;
use App\AuditoriumChat;
use App\booth;
use App\Chat;
use App\ContactUs;
use App\Hall;
use App\Jobs;
use App\Lounge;
use App\LoungeChat;
use App\Mail\offlineBooth;
use App\Mail\Reminder;
use App\Statistics;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApiController extends Controller
{

    public function AudituriumChatGet(Request $request){
        $Chats = AuditoriumChat::where('auditoriaID' , $request->auditoriaID)->get(['UserID','Text','Username']);
        return response()->json([
            'Chat' => $Chats
        ]);
    }

    public function WhatIsUserName($user_id = 999){
        return User::find($user_id)->UserName;
    }

    public function AudituriumChat(Request $request){
        $request->validate([
            'UserID' => 'required|string',
            'Username' => 'required|string',
            'auditoriaID' => 'required|string',
            'Text' => 'required|string'
        ]);
        AuditoriumChat::create([
            'UserID' => $request->UserID,
            'Username' => $request->Username,
            'auditoriaID' => $request->auditoriaID,
            'Text' => $request->Text
        ]);
        $Chats = AuditoriumChat::where('auditoriaID' , $request->auditoriaID)->get(['UserID', 'Username', 'Text']);
        return response()->json([
            'Status' => 'Success',
            'Chat' => $Chats
        ],200);

    }


    public function LoungeCount($id){


        $array =  Lounge::where('id', $id)->get(["Members"])->first()->Members;
        eval("\$myarray = $array;"); // should be json_decode($array);

        $count = count($myarray);



        return response()->json([
            'Count' => $count,
            'ID' => $id
        ]);
    }
    public function LoungeGet($id){


        $lounge_Chats = LoungeChat::where('LoungeID', $id)->get(["Text", "UserID", "Username"]);





        return response()->json([
            'Chat' => $lounge_Chats
        ]);
    }

    public function LoungePost(Request $request){


        LoungeChat::create($request->all());
        $Chats = LoungeChat::where('LoungeID' , $request->LoungeID)->get();
        return response()->json([
            'Status' => 'Success',
            'Chat' => $Chats
        ],200);

    }


    public function JobDetails($JobID){
        $Job = Jobs::find($JobID);
        return json_encode($Job);
    }


    public function HallIsFull($HallName)
    {

        $Booth = booth::where('Hall', $HallName)->count();
        if ($Booth >= 25) {
            return json_encode('Full');
        }
        return json_encode('NotFull');
    }

    public function PositionIsAvailable($HallID,$Position){

        $Convertor = [
            'booth_1' => 10,
            'booth_2' => 12,
            'booth_3' => 14,
            'booth_4' => 11,
            'booth_5' => 13,
            'booth_6' => 15,
            'booth_7' => 16,
            'booth_8' => 19,
            'booth_9' => 17,
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


        $Booth = booth::where('Hall' , $HallID)->where('Position' , $Convertor[$Position])->count();
        if ($Booth >= 1){
            return json_encode('Full');
        }
        return json_encode('NotFull');
    }

    public function Images()
    {


        $Main = Hall::find(1);
        $LoginData = $Main->only('Main1', 'Main2', 'Main3', 'Main4', 'Main5', 'Main6');
        $LobyData = $Main->only('Loby1', 'Loby2', 'Loby3', 'Loby4');
        $PanPosterData = $Main->only('Panposter1', 'Panposter2', 'Panposter3');
        $WallPosterData = $Main->only('Wallposter1', 'Wallposter2', 'Wallposter3', 'Wallposter4', 'Wallposter5', 'Wallposter6', 'Wallposter7', 'Wallposter8');
        $StandData = $Main->only('Stand1', 'Stand2', 'Stand3', 'Stand4', 'Stand5', 'Stand6', 'Stand7');
        $BillBoardData = $Main->only('Billboard1', 'Billboard2', 'Billboard3', 'Billboard4', 'Billboard5', 'Billboard6');
        $RotationposterData = $Main->only('Rotationposter1', 'Rotationposter2', 'Rotationposter3', 'Rotationposter4', 'Rotationposter5', 'Rotationposter6', 'Rotationposter7', 'Rotationposter8', 'Rotationposter9', 'Rotationposter10', 'Rotationposter11', 'Rotationposter12', 'Rotationposter13', 'Rotationposter14', 'Rotationposter15', 'Rotationposter16', 'Rotationposter17', 'Rotationposter18', 'Rotationposter19', 'Rotationposter20', 'Rotationposter21', 'Rotationposter22', 'Rotationposter23', 'Rotationposter24');
        $TextData = $Main->only('Text1', 'Text2', 'Text3');
        foreach ($LoginData as $item => $value) {
            $Login[] = $value;
        }
        foreach ($LobyData as $item => $lobyDatum) {
            $Loby[] = $lobyDatum;
        }
        foreach ($WallPosterData as $item => $value) {
            $WallPoster[] = $value;
        }
        foreach ($BillBoardData as $item => $value) {
            $BillBoard[] = $value;
        }
        foreach ($StandData as $item => $value) {
            $Stand[] = $value;
        }
        foreach ($PanPosterData as $item => $value) {
            $PanPoster[] = $value;
        }
        foreach ($RotationposterData as $item => $value) {
            $Rotationposter[] = $value;
        }
        foreach ($TextData as $item => $value) {
            $Text[] = $value;
        }

        $LobyLinks=[$Main->lobyLink1,$Main->lobyLink2,$Main->lobyLink3,$Main->lobyLink4,$Main->welcomeVideo];



        return response()->json(
            ['Data' => array(
                'Login' => $Login,
                'Loby' => $Loby,
                'LobyLinks'=>$LobyLinks,
                'Hall' => array(
                    'WallPoster' => $WallPoster,
                    'Billboard' => $BillBoard,
                    'Stand' => $Stand,
                    'Panposter' => $PanPoster,
                    'Rotationposter' => $Rotationposter,
                    'Text' => $Text
                )
            )]
            , 200);
    }



    public function rotation1(){
        $Main = Hall::find(1);
        $RotationposterData = [$Main->Rotationposter1,$Main->Rotationposter2,$Main->Rotationposter3,$Main->Rotationposter4];
        return response()->json(
            ["1"=>$RotationposterData],200
        );
    }

    public function rotation2(){
        $Main = Hall::find(1);
        $RotationposterData = [$Main->Rotationposter5,$Main->Rotationposter6,$Main->Rotationposter7,$Main->Rotationposter8];
        return response()->json(
            ["2"=>$RotationposterData],200
        );
    }

    public function rotation3(){
        $Main = Hall::find(1);
        $RotationposterData = [$Main->Rotationposter9,$Main->Rotationposter10,$Main->Rotationposter11,$Main->Rotationposter12];
        return response()->json(
            ["3"=>$RotationposterData],200
        );
    }

    public function rotation4(){
        $Main = Hall::find(1);
        $RotationposterData = [$Main->Rotationposter13,$Main->Rotationposter14,$Main->Rotationposter15,$Main->Rotationposter16];
        return response()->json(
            ["4"=>$RotationposterData],200
        );
    }

    public function rotation5(){
        $Main = Hall::find(1);
        $RotationposterData = [$Main->Rotationposter17,$Main->Rotationposter18,$Main->Rotationposter19,$Main->Rotationposter20];
        return response()->json(
            ["5"=>$RotationposterData],200
        );
    }

    public function rotation6(){
        $Main = Hall::find(1);
        $RotationposterData = [$Main->Rotationposter21,$Main->Rotationposter22,$Main->Rotationposter23,$Main->Rotationposter24];
        return response()->json(
            ["6"=>$RotationposterData],200
        );
    }



    public function Login(Request $request)
    {
        $User = User::where('email', $request->email)->orWhere('UserName' , $request->email)->first();
        if ($User == null || empty($User) || $User->count() <= 0) {
            return response()->json([
                'Status' => 'Failed',
                'Message' => 'User not Found',
                'User' => null
            ], 200);
        }
        if ($User->AccountStatus == 'Suspend'){
            return response()->json([
                'Status' => 'Failed',
                'Message' => 'Account Suspended',
                'User' => null
            ], 200);
        }
        if ($User->email_verified_at == null){
            return response()->json([
                'Status' => 'Failed',
                'Message' => 'Please Active Your Account From Email',
                'User' => null
            ], 200);
        }
        if (Hash::check($request->password, $User->password)) {
            return response()->json([
                'Status' => 'Success',
                'Message' => 'User Logged in',
                'User' => $User,
            ], 200);
        } else {
            return response()->json([
                'Status' => 'Failed',
                'Message' => 'Password not match',
                'User' => null
            ], 200);
        }

    }

    public function LoginShowroom(Request $request)
    {
        $User = User::where('email', $request->email)->orWhere('UserName' , $request->email)->first();
        if ($User == null || empty($User) || $User->count() <= 0) {
            return response()->json([
                'Status' => 'Failed',
                'Message' => 'User not Found',
                'User' => null
            ], 200);
        }
        if ($User->AccountStatus == 'Suspend'){
            return response()->json([
                'Status' => 'Failed',
                'Message' => 'Account Suspended',
                'User' => null
            ], 200);
        }
        if ($User->email_verified_at == null){
            return response()->json([
                'Status' => 'Failed',
                'Message' => 'Please Active Your Account From Email',
                'User' => null
            ], 200);
        }
        if (Hash::check($request->password, $User->password)) {
            return response()->json([
                'Status' => 'Success',
                'Message' => 'User Logged in',
                'User' => $User,
                'Hall'=> $User->Booth->Hall
            ], 200);
        } else {
            return response()->json([
                'Status' => 'Failed',
                'Message' => 'Password not match',
                'User' => null
            ], 200);
        }

    }



    public function ChatStore(Request $request)
    {

        if (Chat::where('BoothID' , $request->BoothID)->where('UserID' , $request->UserID)->count() > 0){
            $Owner = Chat::where('BoothID' , $request->BoothID)->where('UserID' , $request->UserID)->first()->Owner;
        }
        else{

            $Owner = User::where(['CompanyID' => $request->BoothID , 'ChatMode' => 'Available' , 'AccountStatus' => 'Active'])->orderBy('ActiveSlave', 'ASC')->first();
            if ($Owner == null){
                $Owner = booth::find($request->BoothID)->UserID;
            }else{
                $Owner->ActiveSlave = $Owner->ActiveSlave + 1;
                $Owner->save();
                $Owner = $Owner->id;
            }

        }

        $User = User::find($request->UserID);

        Chat::where("BoothID",$request->BoothID)->where("UserID",$request->UserID)->update([
            "infoUIIndex"=>$request->infoUIIndex
        ]);

        $Chat = Chat::create([
            'UserID' => $User->id,
            'BoothID' => $request->BoothID,
            'Text' => $request->Text,
            'Sender' => 'Visitor',
            'Owner' => $Owner,
            'UserName' => $User->UserName,
            'infoUIIndex'=>$request->infoUIIndex
        ]);





        if ($Chat->id > 0) {
            return response()->json(
                ['Status' => 'OK']
                , 202);
        } else {
            return response()->json(
                ['Status' => 'Failed']
                , 400);
        }
    }




    public function ChatStoreAdmin(Request $request)
    {

        $request->validate([
            'Text' => ['required', 'max:255']
        ]);
        $ID = User::where('Rule' , 'Admin')->get()[0]->id;
        $Chat = AdminChat::create([
            'Text' => $request->Text,
            'UserID' => $ID ,
            'ReceiverID' => $request->UserID,
            'Sender' => 'Visitor',
        ]);




        if ($Chat->id > 0) {
            return response()->json(
                ['Status' => 'OK']
                , 202);
        } else {
            return response()->json(
                ['Status' => 'Failed']
                , 400);
        }
    }

    public function ChatGetAdmin(Request $request)
    {
        $request->validate([
            'UserID' => 'required|integer',
        ]);

        $Chats = AdminChat::where('ReceiverID', \request()->UserID)->where('Sender' , 'Admin')->latest('id')->first();

        return response()->json(
            ['Chat' => $Chats]
            , 200);
    }


    public function ChatGet(Request $request)
    {
        $request->validate([
            'UserID' => 'required|integer',
            'BoothID' => 'required|integer',
        ]);
        $Chat = Chat::where('UserID', $request->UserID)->where('BoothID', $request->BoothID)->where('Sender' , 'Exhibitor')->latest('id')->first();


        return response()->json(
            ['Chat' => $Chat]
            , 200);
    }



    //hasan auto login start here


    public function autoLogin(Request $request)
    {
        return response()->json([
            "ip"=>$request->ip,
            "username"=>$request->username
        ],200);
    }



    //hasan auto login end here




    //hasan chat start here


    public function emailSender(Request $request)
    {
        $request->validate([
            "UserID"=>"required"
        ]);

        $user=User::where("id",$request->UserID)->first();
        Mail::to($user->email)->send(new offlineBooth($user));
        return response()->json([
            "status"=>"success"
        ]);
    }



    public function newChatAdmin(Request $request)
    {
        $request->validate([
            "UserID" => "required|integer"
        ]);

        $newChats = AdminChat::where("ReceiverID", $request->UserID)->where("Status", "New")->where("Sender", "Admin")->get();

        foreach ($newChats as $newChat) {
            $text[]=$newChat->Text."INCAHFTRRPCHATHASANREZA".$newChat->id;;
        }

        if ($newChats->count() > 0 ) {
            return response()->json(
                ["data"=>$text]
            );
        }else{
            return response()->json(
                ["status"=>"failed"]
            );
        }
    }


    public function newChatAdminDestroy(Request $request)
    {

        $request->validate([
            "ChatID"=>"required",
        ]);



        $obj=json_decode($request->ChatID);
        foreach ($obj->ChatID as $item){

            $chatDestroy=AdminChat::where("id",$item)->where("Status", "New")->get();
            if ($chatDestroy->count()>0) {


                AdminChat::where("id", $item)->where("Status", "New")->update(
                    [
                        "Status" => "Viewed",
                    ]
                );

            }else {
                return response()->json([
                    "status"=>"failed"
                ]);
            }



        }
        return response()->json([
            "status"=>"success"
        ]);


    }






    public function newChat(Request $request)
    {


        $request->validate([
            "UserID"=>"required|integer"
        ]);


        $CompaniesCount=booth::get()->count();

        for ($i=0;$i<$CompaniesCount;$i++){
            $booth=booth::skip($i)->first();
            $newChatText=[];
            $newChats=Chat::where("UserID",$request->UserID)->where("BoothID",$booth->id)->where("status","New")->where("Sender","Exhibitor")->get();
            if ($newChats->count() > 0) {
                $newChats=Chat::where("UserID",$request->UserID)->where("BoothID",$booth->id)->where("status","New")->where("Sender","Exhibitor")->get();
                foreach ($newChats as $newChat) {
                    $newChatText[]=$newChat->Text."INCAHFTRRPCHATHASANREZA".$newChat->id;
                }

            }
            else {
                $newChatText=[];
            }

            $data[]=[
                "Text"=>$newChatText,
                "CompanyName"=>$booth->CompanyName,
                "BoothID"=>$booth->id,
                "UserID"=>$booth->UserID
            ];

        }

        $newChats1=[
            "data"=>$data
        ]

        ;



        return response()->json([
            "newChats"=>$newChats1
        ],200);

    }

    public function newChatDestroy(Request $request)
    {

        $request->validate([
            "UserID"=>"required",
            "BoothID"=>"required",
            "ChatID"=>"required",
        ]);



        $obj=json_decode($request->ChatID);
        foreach ($obj->ChatID as $item){

            $chatDestroy=Chat::where("id",$item)->where("UserID",$request->UserID)->where("BoothID", $request->BoothID)->where("Status", "New")->get();
            if ($chatDestroy->count()>0) {


                Chat::where("id", $item)->where("UserID", $request->UserID)->where("BoothID", $request->BoothID)->where("Status", "New")->update(
                    [
                        "Status" => "Viewed",
                    ]
                );

            }else {
                return response()->json([
                    "status"=>"failed"
                ]);
            }



        }
        return response()->json([
            "status"=>"success"
        ]);


    }


    //


    public function UserDetails($id)
    {

        $User = User::find($id);
        return response()->json(
            $User
            , 200);
    }


    public function BoothGet($id)
    {
        //---------------------
        $BoothA = range(1,25);
        $BoothAFinal = [];
        foreach ($BoothA as $item) {
            if (booth::where('Position' , $item)->where('Hall' , 1)->count() > 0){
                if (booth::where('Position' , $item)->where('Hall' , 1)->first()->User->AccountStatus == 'Active'){
                    $temp_booth = booth::where('Position' , $item)->where('Hall' , 1)->get()[0];
                    if (!Str::startsWith($temp_booth->WebSite, ["http://", "https://"])) {

                        $temp_booth->WebSite = "http://". $temp_booth->WebSite;

                    }
                    $BoothAFinal[] = $temp_booth;
                }else{
                    $BoothAFinal[] = null;
                }
            }else{
                $BoothAFinal[] = null;
            }
        }
        $BoothAFinal = array_values($BoothAFinal);
        //---------------------
        $BoothB = range(1,25);
        $BoothBFinal = [];
        foreach ($BoothB as $item) {
            if (booth::where('Position' , $item)->where('Hall' , 2)->count() > 0){
                if (booth::where('Position' , $item)->where('Hall' , 2)->first()->User->AccountStatus == 'Active') {
                    $temp_booth = booth::where('Position' , $item)->where('Hall' , 2)->get()[0];
                    if (!Str::startsWith($temp_booth->WebSite, ["http://", "https://"])) {
                        $temp_booth->WebSite = "http://". $temp_booth->WebSite;
                    }
                    $BoothBFinal[] = $temp_booth;





                }else{
                    $BoothBFinal[] = null;
                }
            }else{
                $BoothBFinal[] = null;
            }
        }
        $BoothBFinal = array_values($BoothBFinal);
        //---------------------
        $BoothC = range(1,25);
        $BoothCFinal = [];
        foreach ($BoothC as $item) {
            if (booth::where('Position' , $item)->where('Hall' , 3)->count() > 0){
                if (booth::where('Position' , $item)->where('Hall' , 3)->first()->User->AccountStatus == 'Active') {
                    $temp_booth = booth::where('Position' , $item)->where('Hall' , 3)->get()[0];
                    if (!Str::startsWith($temp_booth->WebSite, ["http://", "https://"])) {
                        $temp_booth->WebSite = "http://". $temp_booth->WebSite;
                    }
                    $BoothCFinal[] = $temp_booth;

                }else{
                    $BoothCFinal[] = null;

                }
            }else{
                $BoothCFinal[] = null;
            }
        }
        $BoothCFinal = array_values($BoothCFinal);
        //---------------------
        $BoothD = range(1,25);
        $BoothDFinal = [];
        foreach ($BoothD as $item) {
            if (booth::where('Position' , $item)->where('Hall' , 4)->count() > 0){
                if (booth::where('Position' , $item)->where('Hall' , 4)->first()->User->AccountStatus == 'Active') {
                    $temp_booth = booth::where('Position' , $item)->where('Hall' , 4)->get()[0];
                    if (!Str::startsWith($temp_booth->WebSite, ["http://", "https://"])) {
                        $temp_booth->WebSite = "http://". $temp_booth->WebSite;
                    }
                    $BoothDFinal[] = $temp_booth;

                }else{
                    $BoothDFinal[] = null;
                }
            }else{
                $BoothDFinal[] = null;
            }
        }
        $BoothDFinal = array_values($BoothDFinal);
        //---------------------
        $Data = array(
            'Hall-A' => $BoothAFinal,
            'Hall-B' => $BoothBFinal,
            'Hall-C' => $BoothCFinal,
            'Hall-D' => $BoothDFinal,
        );
        return response()->json(
            ['Data' => $Data]
            , 200);
    }


    public function BoothOnline($id)
    {
        $OperatorStatus = null;
        if (User::where("CompanyID",$id)->count() > 0) {
            $OperatorStatus = User::where("CompanyID",$id)->first()->userStatus;
        }
        $Booth=booth::findOrFail($id);


        if ($Booth->user->userStatus == 1 || $OperatorStatus == 1) {
            return response()->json([
                "userStatus"=>1
            ]);
        }else {
            return response()->json([
                "userStatus"=>0
            ]);
        }


    }



    public function ContactUs(Request $request)
    {
        $request->validate([
            'Name' => 'required|string',
            'Email' => 'required|string|email',
            'Text' => 'required|string',
        ]);
        $Item = ContactUs::create([
            'Name' => $request->Name,
            'Email' => $request->Email,
            'Text' => $request->Text,
        ]);
        return response()->json(
            $Item
            , 200);
    }


    public function Statistics(Request $request)
    {


        if (Statistics::whereDate('created_at', Carbon::today())->where('UserID' , $request->UserID)->where('BoothID' ,$request->BoothID)->count() <= 0){
            $Statistics = Statistics::create([
                'UserID' => $request->UserID,
                'BoothID' => $request->BoothID,
                'Profession' => User::find($request->UserID)->Profession != null ? User::find($request->UserID)->Profession : 'Visitor',
                'Gender' => User::find($request->UserID)->Gender != null ? User::find($request->UserID)->Gender : 'No Gender'
            ]);
            return response()->json(
                $Statistics
                , 200);
        }
        return response()->json(
            ['Data' => 'Visited Today']
            , 200);
    }

    public function hexToRgb($hex)
    {
        $length = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        $rgb['a'] = 1;
        return response()->json(
            $rgb
            , 200);
    }

//    Auto Login App


    public function autoLoginApp(Request $request)
    {

        $request->validate([
//            "UserIP"=>"required",
        ]);

        $user = User::where("app_token",$request->app_token)->first();
        $password = $request->Password;
        $user1 = [$user,$password];


//        dd($user1);



        Cache::put(\request("app_token"),["Username"=>$user->UserName,"Password"=>$request->Password],10);
//            dd(Cache::get(\request("app_token")));
        return response()->json($user1,200);



    }


    public function autoLoginApiDestroy(Request $request)
    {
        $request->validate([
            "UserID"=>"required"
        ]);
        User::where('id', $request->UserID)->update(['logout' => true]);

        return response()->json([
            "status"=>"success"
        ]);

    }


    public function url()
    {
        return response()->json([
            "url"=>"http://185.81.96.44"
        ]);
    }

}
