<?php

namespace App\Http\Controllers;

use App\AdminChat;
use App\booth;
use App\Chat;
use App\Mail\newMessage;
use App\Meeting;
use App\MeetingRequest;
use App\Site;
use App\Statistics;
use App\Traits\Uploader;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use MacsiDigital\Zoom\Facades\Zoom;
use RealRashid\SweetAlert\Facades\Alert;

class VisitorController extends Controller
{
    use Uploader;

    public function join_meeting($meeting){



        $meeting = Meeting::where('meeting_id', $meeting)->first();

        if($meeting->is_started == false){

            Alert::error('Meeting Not Started yet');
            return redirect()->back();
        }

        $role = 0;

        return view('Zoom.start', compact('meeting', 'role'));


    }

    public function leave_meeting(Request $request) {


        Alert::success('Successfully left the meeting');
        return redirect()->to('/');



    }




    public function MeetingScheduleIndex($companyID){

        $userID = booth::where("id",$companyID)->first()->UserID;




        $available_meetings = [];


        $already_requested_meeting = MeetingRequest::where('user_id', Auth::user()->id)->where('exhibitor_id', $userID)->orderBy('id','DESC')->first();

//        if($already_requested_meeting != null && $already_requested_meeting->status == 'none' &&   Carbon::now()->toTimeString() <  Carbon::parse($already_requested_meeting->request_time)->addMinutes(30)->toTimeString() &&  Carbon::parse($already_requested_meeting->request_time)->toDateString() == Carbon::now()->toDateString()){
//
//            $message = "You're request is being checked by the company ";
//
//            return view('Visitor.alreadyRequestedMeeting')->with(['message'=>$message]);
//
//        }
//        if($already_requested_meeting != null && $already_requested_meeting->status == 'accepted' &&  Carbon::now()->toTimeString() <  Carbon::parse($already_requested_meeting->request_time)->addMinutes(30)->toTimeString() && Carbon::parse($already_requested_meeting->request_time)->toDateString() == Carbon::now()->toDateString()){
//
//
//
//
//            $message = "You've been accepted for your meeting, go to your dashboard";
//
//            return view('Visitor.alreadyRequestedMeeting')->with(['message'=>$message]);
//
//        }


        if(\request()->has('Day')){





        $available_meetings = Meeting::where('owner_id', $userID)
            ->where('type','meeting')
            ->whereDate( 'start_time', Carbon::parse(\request()->Day)->format('Y-m-d') )
            ->get(['start_time']);



        }


        if (\request()->exists('time') && \request()->exists('Day')) {

            $meet_req = new MeetingRequest();
            $meet_req->user_id = Auth::user()->id;
            $the_date = Carbon::parse(\request()->Day . ' ' . \request()->time)->format('Y-m-d H:i:s');
            $meet_req->request_time = $the_date;
            $meet_req->exhibitor_id = (int)$userID;
            $meet_req->status = 'none';
            $meet_req->save();

            Alert::success("Request was successful, check status in your dashboard");
            return redirect()->back();

        }



        $StartDate = Site::find(1)->StartDate;
        $Days = [];
        for ($i = 0; $i < 10; $i++) {
            $Days[] = Carbon::parse($StartDate)->format('Y-m-d');
            $StartDate = Carbon::parse($StartDate)->addDay();
        }


        $intervals = CarbonInterval::minutes(30)->toPeriod('09:00', '17:00');
        $times = [];
        foreach ($intervals as $date) {
            $times[] = $date->format('H:i');
        }



        $company = booth::where('UserID', $userID)->first();





        return view('Visitor.requestMeeting')->with([
            'company' => $company,
            'Days' => $Days,
            'times' => $available_meetings,
        ]);






    }



    public function MeetingsIndex(Request $request){


        $meetings_request = [];

        if($request->has('search')){

            $searchTerm = $request->has('search');

            $booths = booth::where('CompanyName', 'LIKE', "%{$searchTerm}%")->get(['id']);

            $booths_id = [];
            foreach ($booths as $booth){
                $booths_id[] = $booth->id;
            }


            $meetings_request = MeetingRequest::where('user_id', Auth::user()->id)->whereIn('exhibitor_id', $booths_id )->get();


        }else{

            $meetings_request = MeetingRequest::where('user_id', Auth::user()->id)->get();


        }


        $selected_meeting = [];
        $selected_company = [];
        $meeting_exhibitor = [];

        if(\request()->has('rid')){


            $selected_meeting = MeetingRequest::where('id', $request->rid)->first();

            $meeting_exhibitor = Meeting::where('reserved_by', Auth::user()->id)
                ->whereDate('start_time', Carbon::parse($selected_meeting->request_time)->toDateString())
                ->whereTime('start_time', Carbon::parse($selected_meeting->request_time)->toTimeString())
                ->first();






            $selected_company = \App\booth::where('UserID', $selected_meeting->exhibitor_id)->first();



        }





        return view('Visitor.meeting')->with([

            'meetings' => $meetings_request,

            'selected_meeting' => $selected_meeting,
            'selected_company' => $selected_meeting,
            'meeting_exhibitor' => $meeting_exhibitor,



        ]);
    }

    public function __construct()
    {
        $this->middleware('verified');
    }



    public function Resume(Request $request){


        $this->validate($request,
            [
                'resume' => 'required|mimes:pdf'
            ]
        );



        $user = Auth::user();
        $user->resume = $request->hasFile('resume') ? $this->S3Doc($request, 'resume') : $user->resume;

        $user->save();

        Alert::success('Ok');
        return redirect()->back();



    }




    public function index(){
//        $this->sendMessage("sssssss","+995557687274");
        return view('Visitor.index');
    }

    public function UpdateAvatar(Request $request){
        $request->validate([
            'Avatar' => 'image|required'
        ]);
        $User = Auth::user();
        $User->Image = $this->UploadPic($request , 'Avatar' , 'UserProfiles' , 'Profile');
        $User->save();
        return redirect()->back();
    }

    public function ChangePassword(Request $request){
        $request->validate([
            'OldPassword' => 'required',
            'password' => 'required|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/',
        ]);
        if (Hash::check($request->OldPassword,Auth::user()->password)){
            Auth::user()->password = Hash::make($request->password);
            Auth::user()->save();
            Auth::logout();
            Alert::success('Password Changed Successfully');

            return redirect()->route('login');
        }
        return redirect()->back();


    }

    public function VisitExperience(Request $request){
        $request->validate([
            'VisitExperience' => 'required|string'
        ]);
        Auth::user()->VisitExperience = $request->VisitExperience;
        Auth::user()->save();
        Alert::success("Your Feedback is Submitted to Admin");
        return redirect()->back();
    }

    public function VisitHistory(){



        $Statistic = Statistics::where('UserID' , Auth::id())->get();
        $Booths = [];
        $uniques = array();
        foreach ($Statistic as $obj) {
            $uniques[$obj->BoothID] = $obj;
        }
        foreach ($uniques as $item) {
            $Booths[] = booth::find($item->BoothID);
        }



//        if (\request()->profile) {
//            $booths = null;
//            $Usersf = User::where("profile",\request()->profile)->get();
//
//            foreach ($Usersf as $Userf){
//                $ids[] = $Userf->id;
//                $users = [];
//                foreach ($ids as $id){
//                    $users[] = User::where("id",$id)->first();
//                }
//
//                foreach ($users as $user){
//                    $booth = booth::where("UserID",$user->id)->first();
//                    if (!empty($booth)) {
//                        $booths2[] = $booth;
//                    }
//                }
//
//
//            }
//
//
//            if ($booths2 != null) {
//                return view('Visitor.VisitHistory')->with(['Booths' => $booths2]);
//            }else {
//                Alert::error("nothing found");
//                return redirect()->back();
//            }
//
//
//        }


        if (\request()->CompanyID){
            $Booth = booth::find(\request()->CompanyID);
            $Booth_id = booth::find(\request()->CompanyID)->user->id;
            $userInfo=User::where("id",$Booth_id)->first();
            return view('Visitor.VisitHistory')->with(['Booths' => $Booths , 'Booth' => $Booth,'userInfo'=>$userInfo]);
        }

        if (\request()->search) {
            if (booth::where('CompanyName', 'LIKE', '%' . \request()->search . '%')->count() > 0) {
                $Booths = booth::where('CompanyName', 'LIKE', '%' . \request()->search . '%')->get();
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }
            return view('Visitor.VisitHistory')->with(['Booths' => $Booths]);
        }

        return view('Visitor.VisitHistory')->with(['Booths' => $Booths]);
    }


//written by hasan


    public function VisitInbox(){
        $Statistic = Statistics::where('UserID' , Auth::id())->get();
        $Booths = [];
        $uniques = array();
        foreach ($Statistic as $obj) {
            $uniques[$obj->BoothID] = $obj;
        }
        foreach ($uniques as $item) {
            $Booths[] = booth::find($item->BoothID);
        }

        if (\request()->CompanyID){
            $Booth = booth::find(\request()->CompanyID);
            $Booth_id = booth::find(\request()->CompanyID)->user->id;
            $userInfo=User::where("id",$Booth_id)->first();

            return view('Visitor.inbox')->with(['Booths' => $Booths , 'Booth' => $Booth,'userInfo'=>$userInfo]);
        }
        return view('Visitor.inbox')->with(['Booths' => $Booths]);
    }



    public function InboxGet(Request $request)
    {
//        $request->validate([
//            'UserID' => 'required'
//        ]);
        $Chat = Chat::where('BoothID', $request->BoothID)->where('UserID', \auth()->user()->id)->get();
        return response()->json([
            'Chat' => $Chat
        ], 200);

    }


    public function InboxPost(Request $request)
    {

//        dd($request);
//        if (Chat::where('BoothID', $request->BoothID)->where('UserID', $request->UserID)->get()[0]->Owner != null) {
//            $Owner = Chat::where('BoothID', $request->BoothID)->where('UserID', $request->UserID)->first()->Owner;
//        } else {
//            $Owner = Auth::id();
//        }
        $request->validate([
            'Text' => 'required|string',
            'UserID' => 'required|integer'
        ]);

        Chat::create([
            'UserID' => $request->UserID,
            'BoothID' => $request->BoothID,
            'Text' => $request->Text,
            'Sender' => 'Visitor',
            'Owner' => 1,
        ]);

    }



    public function ChangeChatStatus(Request $request){
        if ($request->BoothID && $request->UserID) {
            $CHatsssss = Chat::where('BoothID', $request->BoothID)->where('UserID', $request->UserID)->where('Sender','Exhibitor')->get();
            foreach ($CHatsssss as $ch) {
                $ch->Status = 'Viewed';
                $ch->save();
            }
            return response()->json([
                'msg' => 'Done'
            ],200);
        }else{
            return response()->json([
                'msg' => 'Error'
            ],200);

        }

    }


    public function ChangeIP(Request $request)
    {
        $user = User::find(\auth()->user()->id);
        $user->UserIP = $request->ip;
        $user->save();
    }



//end-written by hasan

    public function Payment(){
        return view('Visitor.Payment');
    }

    public function Contact(){
        $Chats = AdminChat::where('ReceiverID' , Auth::id())->get();


        if ($users_message=User::where("newmessage",">=",3)->count() != 0) {
            $users_message=User::where("newmessage",">=",3)->first();
            Mail::to("test@test.com")->send(new newMessage($users_message));

        }
        //        dd($users_message);
        //$Count = AdminChat::where('ReceiverID', $id)->where('Status', 'New')->count();

        return view('Visitor.ContactUs')->with(['Chats' => $Chats]);
    }


    public function visitorContactUsAjax()
    {

        $Count = AdminChat::where([
            ['ReceiverID', auth()->user()->id],
            ['Status', 'New'],
            ['sender',"!=","Admin"]
        ])->count();

        User::where("id",auth()->user()->id)->update(["newmessage"=>$Count]);

        return response()->json([
            'newChat'=>$Count
        ]);
    }

    public function ChatGet(){
        $Chats = AdminChat::where('ReceiverID' , Auth::id())->get();
        return response()->json([
            'Chat' => $Chats
        ],200);
    }

    public function Chat(Request $request){
        $request->validate([
            'Text' => ['required', 'max:255']
        ]);
        $Owner = User::where(['Rule' => 'Admin-Operator' , 'ChatMode' => 'Available'])->orderBy('ActiveSlave', 'ASC')->first();
        if ($Owner == null){
            $Owner = User::where('Rule' , 'Admin')->get()[0]->id;
        }else{
            $Owner->ActiveSlave = $Owner->ActiveSlave + 1;
            $Owner->save();
            $Owner = $Owner->id;
        }
        AdminChat::create([
            'Text' => $request->Text,
            'UserID' => $Owner ,
            'ReceiverID' => Auth::id(),
            'Sender' => 'Visitor',
        ]);
        $Chats = AdminChat::where('ReceiverID' , Auth::id())->get();
        return response()->json([
            'Chat' => $Chats
        ],200);

    }
}
