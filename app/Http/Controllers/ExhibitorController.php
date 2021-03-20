<?php

namespace App\Http\Controllers;

use App\AdminChat;
use App\booth;
use App\Chat;
use App\Conference;
use App\ConferenceRequest;
use App\Invitation;
use App\Jobs;
use App\Mail\InviteOperators;
use App\Mail\SpeakerRegister;
use App\Meeting;
use App\MeetingRequest;
use App\Site;
use App\Speaker;
use App\Statistics;
use App\Traits\Uploader;
use App\User;
use Aws\S3\S3Client;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use MacsiDigital\Zoom\Facades\Zoom;
use RealRashid\SweetAlert\Facades\Alert;

class ExhibitorController extends Controller
{
    use  Uploader;


    public function MeetingScheduleIndex(Request $request)
    {
        $meeting_email = Auth::user()->email;



        if(Zoom::user()->find($meeting_email) == null || Zoom::user()->find($meeting_email)->status != 'active'){


            Alert::success('Confirm your Zoom Account', "Check your inbox at '$meeting_email' and comeback after confirmation");
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

        $visitor = null;
        if($request->visitor){

            $visitor = User::where('id', $request->visitor)->first();
//            $visitor = User::where('id', $request->visitor)->where('Rule', 'Visitor')->first();


        }



        $meeting_requests = MeetingRequest::where('exhibitor_id', Auth::user()->id)
            ->whereDate( 'request_time', $request->Day )
            ->get();

//        $meet_req = $meeting_requests[0];
//
//        $start_date = Carbon::parse($meet_req->request_time)->toDateString();
//
//        dd(Carbon::parse($meet_req->request_time)->addMinutes(30));




        return view('Exhibitor.MeetingSchedule')->with([
            'Days' => $Days,
            'times' => $times,
            'visitor' => $visitor,
            'meeting_requests' => $meeting_requests
            ]);
    }


    public function RejectMeeting($meeting_id) {



        $meet_req = MeetingRequest::where('id', $meeting_id)->where('exhibitor_id', Auth::user()->id)->first();


        if ($meet_req->status == 'accepted') {

            $tmp = Meeting::where('reserved_by', $meet_req->user_id)
                ->whereDate( 'start_time', Carbon::parse($meet_req->request_time)->toDateString() )
                ->whereTime( 'start_time', Carbon::parse($meet_req->request_time)->toTimeString() )->first();

            $tmp->reserved = false;
            $tmp->save();


        }


        $meet_req->status = "rejected";
        $meet_req->save();



        Alert::success('User Meeting Request Rejected Successfully');
        return redirect()->back();


    }


    public function create_webinar(Conference  $conference) {

        $user =  Zoom::user()->find(env('WEBINAR_MAIL'));
        $webinar = Zoom::webinar()->make([
            'topic' => $conference->title,
            'type' => 5,
            'password' => '123456',
            'start_time' => \Carbon\Carbon::now(), // best to use a Carbon instance here.
            'timezone' => 'Europe/Vienna',

        ]);

        $webinar->settings()->make([
            'approval_type' => 0,
            'registration_type' => 2,
            'enforce_login' => false,
        ]);
        $user->webinars()->save($webinar);


        $conference->webinar_id = $webinar->id;
        $conference->webinar_name =   $webinar->topic;
        $conference->webinar_password =  $webinar->password;
        $conference->start_url = $webinar->start_url;
        $conference->save();


        $this->start_webinar($conference);

        return view('zoom-webinar.start')->with([
            'webinar' => $conference,
            'role' => '1',

        ]);

    }

    public function start_webinar(Conference $conference){


        $user =  \MacsiDigital\Zoom\Facades\Zoom::user()->find(env('WEBINAR_MAIL'));
        foreach ($user->webinars as $current_webinar){

            if($current_webinar->id != $conference->webinar_id){

                \MacsiDigital\Zoom\Facades\Zoom::webinar()->find($current_webinar->id)->endWebinar();
                \MacsiDigital\Zoom\Facades\Zoom::webinar()->find($current_webinar->id)->delete();
//                $db_webinar = webinar::where('webinar_id', $current_webinar->id)->first();
//                if($db_webinar != null){
//                    $db_webinar->delete();
//                }

            }


        }


        $role = 1;
        if (!$conference->started) {
            $conference->update([
                'started' => true
            ]);
        }




    }

    public function join_meeting($meeting) {


        $meeting = MeetingRequest::where('id',$meeting)->first();


        $meeting_exhibitor = Meeting::where('owner_id', Auth::user()->id)
            ->whereDate('start_time', Carbon::parse($meeting->request_time)->toDateString())
            ->whereTime('start_time', Carbon::parse($meeting->request_time)->toTimeString())
            ->first();



        $meeting_exhibitor->is_started = true;
        $meeting_exhibitor->save();

        $role = 1;


        return view('Zoom.start')->with([

            'role' => $role,
            'meeting' => $meeting_exhibitor
        ]);



    }

   public function MeetingAccept($meeting_id) {



        $meet_req = MeetingRequest::where('id', $meeting_id)->where('exhibitor_id', Auth::user()->id)->first();
        $meet_req->status = "accepted";
        $meet_req->save();



        $temp1 = Meeting::where('owner_id', Auth::user()->id)->whereDate('start_time', '=' , Carbon::parse($meet_req->request_time)->toDateTime())->whereTime('start_time', '=' , Carbon::parse($meet_req->request_time)->toTimeString())->first();
        $temp1->reserved = true;
        $temp1->reserved_by = $meet_req->user_id;


       $meeting = Zoom::meeting()->make([
           'topic' => $temp1->title,
           'type' => 2,
           'start_time' => Carbon::now(), // best to use a Carbon instance here.
           'timezone' => 'Europe/Vienna', // best to use a Carbon instance here.
       ]);

       $meeting->settings()->make([
           'join_before_host' => true,
           'approval_type' => 0,
           'enforce_login' => false,
           'waiting_room' => false,
       ]);

       Zoom::user()->find(Auth::user()->email)->meetings()->save($meeting);


       $temp1->password = '123456';
       $temp1->meeting_id = $meeting->id;
       $temp1->is_finished = false;
       $temp1->is_started = false;
       $temp1->is_active = false;
       $temp1->type = 'meeting';
       $temp1->save();











        Alert::success('User Meeting Request Accepted Successfully');
        return redirect()->back();


    }

    public function MeetingActivateTime($day, $time) {



        $intervals = CarbonInterval::minutes(30)->toPeriod('09:00', '17:00');
        $times = [];
        foreach ($intervals as $date) {
            $times[] = $date->format('H:i');
        }

        if(!in_array($time, $times)){


            Alert::error('Illegal Time');
            return redirect()->back();

        }

        $date = Carbon::parse($day . ' ' . $time)->format('Y-m-d H:i:s');

        $meeting_exists = Meeting::where('owner_id', Auth::user()->id)->where('start_time', $date)->first();

        if($meeting_exists != null){

            Alert::error('Meeting Already Exists');
            return redirect()->back();

        }



        $meeting = new Meeting();


        $meeting->start_time = $date;
        $meeting->owner_id = Auth::user()->id;
        $meeting->title = "Meeting with " . Auth::user()->FirstName . ' ' . Auth::user()->LastName;
        $meeting->password = uniqid('password_');
        $meeting->meeting_id = '1111111';
        $meeting->is_finished = false;
        $meeting->is_started = false;
        $meeting->is_active = false;

        $meeting->save();



        Alert::success('Meeting Activated');

        return redirect()->back();






    }


    public function MeetingDeActivateTime($day, $time) {


        $intervals = CarbonInterval::minutes(30)->toPeriod('09:00', '17:00');
        $times = [];
        foreach ($intervals as $date) {
            $times[] = $date->format('H:i');
        }

        if(!in_array($time, $times)){


            Alert::error('Illegal Time');
            return redirect()->back();

        }

        $date = Carbon::parse($day . ' ' . $time)->format('Y-m-d H:i:s');

        $meeting_exists = Meeting::where('owner_id', Auth::user()->id)->where('start_time', $date)->first();

        if(!$meeting_exists->id){

            Alert::error('Meeting Does not to deactivate');
            return redirect()->back();

        }


        $meeting_exists->delete();

        Alert::success('Meeting Deactivated Successfully');
        return redirect()->back();



        $meeting = new Meeting();


        $meeting->start_time = $date;
        $meeting->owner_id = Auth::user()->id;
        $meeting->title = "Meeting with " . Auth::user()->FirstName . ' ' . Auth::user()->LastName;
        $meeting->password = uniqid('password_');
        $meeting->meeting_id = '1111111';
        $meeting->is_finished = false;
        $meeting->is_started = false;
        $meeting->is_active = false;

        $meeting->save();
        dd(1);







    }




    // Add Conference Starts HERE


    public function AddConferenceIndex(Request $request)
    {

        $current_booth = $this->Booth();

        $speakers = Speaker::where('booth', $current_booth->id)->get();

        $can_submit = "yes";
        $current_conference = (object)[];

        if(Auth::user()->finalize_conference == 'yes'){




            $can_submit = "no";
            $current_conference = ConferenceRequest::where('booth', $current_booth->id)->first();

            if(\App\Conference::where('booth', $current_conference->booth)->first() != null) {
                Alert::success("You're conference has been approved");

            }

            else{
                Alert::success('You have a submitted conference');

            }




        }


        return view('Exhibitor.AddConference')->with([
            'speakers' => $speakers,
            'can_submit' => $can_submit,
            'current_conference' => $current_conference,
        ]);


    }
    public function leave_meeting(Request $request) {


        Alert::success('Successfully left the meeting');
        return redirect()->to('/');



    }
    public function AddConferenceSpeaker(Request $request) {



        $request->validate([
            'Name' => 'required|string',
            'email' => 'required|string|unique:speakers',
            'UserName' => 'required|string|unique:speakers',
            'password' => 'required|string|min:8|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/',

        ]);

        $current_booth = $this->Booth();



        $Speaker = Speaker::create([
            'Name' => $request->Name,
            'email' => $request->email,
            'UserName' => $request->UserName,
            'password' => $request->password,
            'SpeechTitle' => 'inherit from booth',
            'PreferredDate1' => Carbon::now(),
            'PreferredDate2' => Carbon::now(),
            'PreferredDate3' => Carbon::now(),
            'booth' => $current_booth->id,
            'cid' => '0',

        ]);


        $data = [
            'Name' => $request->Name,
            'email' => $request->email,
            'UserName' => $request->UserName,
            'password' => $request->password,
            'Speech Title' => 'Account Registered Waiting for Verification',
        ];
        //Mail::to($Speaker->email)->send(new SpeakerRegister($data));

        Alert::success('Speaker Registered Successfully');

        return redirect()->back();


    }


    public function AddConferenceFinalize(Request $request){


        $request->validate([

            'date1' => 'required|date',
            'date2' => 'required|date',
            'date3' => 'required|date',
            'title' => 'required|string',
            'abstract' => 'required|string',

        ]);

        $current_booth = $this->Booth();


        ConferenceRequest::create([

            "booth" => $current_booth->id,
            "date1" => $request->date1,
            "date2" => $request->date2,
            "date3" => $request->date3,
            "title" => $request->title,
            "abstract" => $request->abstract,


        ]);

        $conf = ConferenceRequest::where('booth', $current_booth->id)->first();


        $speakers = Speaker::where('booth', $current_booth->id)->get();

        foreach ($speakers as $sp){
            $sp->cid = $conf->id;
            $sp->save();
        }






        $user = Auth::user();
        $user->finalize_conference = 'yes';
        $user->save();

        Alert::success('Conference submitted successfully');

        return redirect()->back();



    }


    // Add Conference Ends HERE



    public function __construct()
    {
        $this->middleware('verified');


        $this->middleware(function ($request, $next) {



            if (booth::where('UserID', Auth::id())->get()[0]->StepTwo == 'Passed') {
                return $next($request);
            }
            return redirect()->route('Exhibitor-Register-To');
        });


        $this->middleware(function ($request, $next) {
            if ($this->Booth()->Status != 'Active') {
                return redirect()->route('Exhibitor-Register-Three');
            }
            return $next($request);
        });
    }

    public function Booth()
    {
        return booth::where('UserID', Auth::id())->get()[0];

    }

    public function GetUsers(Request $request)
    {
        $Users = [];
        $UniqueUser = array();
        $Chats = Chat::where('BoothID', $request->BoothID)->where('Sender', 'Visitor')->get();
        foreach ($Chats as $obj) {
            $UniqueUser[$obj->UserID] = $obj;
        }
        foreach ($UniqueUser as $user) {
            $Users[] = User::find($user->UserID);
        }


        return response()->json([
            'Users' => $Users
        ], 200);
    }

    public function ChatCount()
    {

        if (\request()->UserID && \request()->BoothID) {
            return Chat::where(['UserID' => \request()->UserID, 'BoothID' => \request()->BoothID])->where('Status', 'New')->count();
        }

    }


    public function ChangeChatStatus(Request $request){
        if ($request->BoothID && $request->UserID) {
            $CHatsssss = Chat::where('BoothID', $request->BoothID)->where('UserID', $request->UserID)->where("Sender","visitor")->get();
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

    public function UpdateJob(Request $request){


        $request->validate([
            'Title' => 'required|string',
            'Description' => 'required|string',
            'Number' => 'required|integer',
            'Salary' => 'nullable',
            'ID' => 'required|integer'
        ]);


        $Job = Jobs::find($request->ID);
        $Job->Title = $request->Title;
        $Job->Description = $request->Description;
        $Job->Number = $request->Number;
        $Job->Salary = $request->Salary ?? '';
        $Job->save();
        return redirect()->back();

    }

    public function AddJob(Request $request)
    {
        $request->validate([
            'Title' => 'required|string',
            'Description' => 'required|string',
            'Number' => 'required|integer',
            'Salary' => 'nullable',
        ]);
        Jobs::create([
            'Title' => $request->Title,
            'Description' => $request->Description,
            'Number' => $request->Number,
            'Salary' => $request->Salary ?? '',
            'BoothID' => $this->Booth()->id
        ]);
        Alert::success(__("message.jobcreated"));
        return redirect()->back();
    }

    public function index()
    {
        $newMessage = $this->newMessages() ;


        if (auth()->user()->isOnline()){
            User::where("id",auth()->user()->id)->update(["userStatus"=>1]);
        }else{
            User::where("id",auth()->user()->id)->update(["userStatus"=>0]);
        }

        $Booth = $this->Booth();
        $Booth_id = booth::find($Booth->id)->user->id;
        $userInfo = User::whereId($Booth_id)->first();
        return view('Exhibitor.index')->with(['Booth' => $Booth,'userInfo'=>$userInfo,'newMessage'=>$newMessage]);
    }

    public function Statistics()
    {
        $Statistic = Statistics::where('BoothID', $this->Booth()->id)->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                \DB::raw('Date(created_at) as date'),
                \DB::raw('COUNT(*) as "views"')
            ));
        $Profession = Statistics::where('BoothID', $this->Booth()->id)->groupBy('Profession')
            ->orderBy('Profession', 'ASC')
            ->get(array(
                \DB::raw('Profession'),
                \DB::raw('COUNT(*) as "views"'),
            ));

        return view('Exhibitor.Statistics')->with([
            'Booth' => $this->Booth(),
            'Statistic' => $Statistic,
            'Profession', $Profession
        ])->with('Profession', $Profession);

    }

    public function Payment()
    {
        $newMessage = $this->newMessages() ;
        return view('Exhibitor.Payment')->with(['Booth' => $this->Booth(),'newMessage'=>$newMessage]);
    }

    public function Confirmation()
    {
        $newMessage = $this->newMessages() ;
        return view('Exhibitor.Confrimation')->with(['Booth' => $this->Booth(),'newMessage'=>$newMessage]);

    }

    public function ContactUs()
    {
        $newMessage = $this->newMessages() ;
        $Chats = AdminChat::where('ReceiverID', Auth::id())->get();
        return view('Exhibitor.ContactUS')->with(['Booth' => $this->Booth(), 'Chats' => $Chats,'newMessage' =>$newMessage]);
    }

    public function ChatGet()
    {
        $Chats = AdminChat::where('ReceiverID', Auth::id())->get();
        return response()->json([
            'Chat' => $Chats
        ], 200);
    }

    public function ChatAdmin(Request $request)
    {
        $request->validate([
            'Text' => ['required', 'max:255']
        ]);
        $Owner = User::where(['Rule' => 'Admin-Operator', 'ChatMode' => 'Available'])->orderBy('ActiveSlave', 'ASC')->first();
        if ($Owner == null) {
            $Owner = User::where('Rule', 'Admin')->get()[0]->id;
        } else {
            $Owner->ActiveSlave = $Owner->ActiveSlave + 1;
            $Owner->save();
            $Owner = $Owner->id;
        }
        AdminChat::create([
            'Text' => $request->Text,
            'UserID' => $Owner,
            'ReceiverID' => Auth::id(),
            'Sender' => 'Exhibitor',
        ]);
        $Chats = AdminChat::where('ReceiverID', Auth::id())->get();
        return response()->json([
            'Chat' => $Chats
        ], 200);
    }


    public function InboxGet(Request $request)
    {
        $request->validate([
            'UserID' => 'required'
        ]);
        $Chat = Chat::where('BoothID', $request->BoothID)->where('UserID', $request->UserID)->get();
        return response()->json([
            'Chat' => $Chat
        ], 200);


    }

    public function Inbox(Request $request)
    {
        $newMessage = 0 ;

        if ($request->gender) {
            $Booth = $this->Booth();
            $UniqueUser = array();
            $Chats = Chat::where('BoothID', $Booth->id)->where('Sender', 'Visitor')->get();
            foreach ($Chats as $obj) {
                $UniqueUser[$obj->UserID] = $obj->UserID;
            }
            $Users = array();
            foreach ($UniqueUser as $item) {
                if (User::where('id',$item)->where("gender",$request->gender)->first() != null) {
                    array_push($Users,User::where('id',$item)->where("gender",$request->gender)->first());
                }
            }
            return view("Exhibitor.inbox-filtered",compact("Users","Booth"));
        }

        if ($request->profession) {
            $Booth = $this->Booth();
            $UniqueUser = array();
            $Chats = Chat::where('BoothID', $Booth->id)->where('Sender', 'Visitor')->get();
            foreach ($Chats as $obj) {
                $UniqueUser[$obj->UserID] = $obj->UserID;
            }
            $Users = array();
            foreach ($UniqueUser as $item) {
                if (User::where('id',$item)->where("profession",$request->profession)->first() != null) {
                    array_push($Users,User::where('id',$item)->where("profession",$request->profession)->first());
                }
            }
            return view("Exhibitor.inbox-filtered",compact("Users","Booth"));
        }



        if (\request()->Mode) {
            switch (\request()->Mode) {
                case 'Available':
                    Auth::user()->ChatMode = 'Available';
                    Auth::user()->save();
                    break;
                case 'Busy':
                    Auth::user()->ChatMode = 'Busy';
                    Auth::user()->save();
                    break;
            }
        }






        $Booth = $this->Booth();
        $Users = [];


        if ($request->ajax()) {
            // prepare users



            if ($request->SearchTerm){

                $UniqueUser = array();
                $Chats = Chat::where('BoothID', $Booth->id)->where('Sender', 'Visitor')->where('UserName','LIKE','%'.$request->SearchTerm.'%')->get();
                foreach ($Chats as $obj) {
                    $UniqueUser[$obj->UserID] = $obj->UserID;
                }
                $Users = User::whereIn('id',$UniqueUser)->paginate(10);


            }
            else{
                $UniqueUser = array();
                $Chats = Chat::where('BoothID', $Booth->id)->where('Sender', 'Visitor')->get();
                foreach ($Chats as $obj) {
                    $UniqueUser[$obj->UserID] = $obj->UserID;
                }
                $Users = User::whereIn('id',$UniqueUser)->orderBy("newmessage","Desc")->paginate(10);

            }
            $users_list_view = view('Exhibitor.user-list-data', compact('Users' , 'Booth'))->render();


            // end prepare users


            return response()->json(['Users' => $users_list_view]);

        }




        if (Auth::user()->ChatMode == 'Available') {
            $UniqueUser = array();
            $Chats = Chat::where('BoothID', $Booth->id)->where('Sender', 'Visitor')->get();
            foreach ($Chats as $obj) {
                $UniqueUser[$obj->UserID] = $obj->UserID;
            }
            $Users = User::whereIn('id',$UniqueUser)->paginate(10);

        }

        if (\request()->UserID) {
            $Chat = Chat::where('BoothID', $Booth->id)->where('UserID', \request()->UserID)->get();
            $CHatsssss = Chat::where('BoothID', $Booth->id)->where('UserID', \request()->UserID)->where('Sender','Visitor')->get();
            foreach ($CHatsssss as $ch) {
                $ch->Status = 'Viewed';
                $ch->save();
            }
            return view('Exhibitor.inbox')->with(['Booth' => $Booth, 'Users' => $Users, 'Chat' => $Chat]);
        }


        if (\request()->SearchTerm) {
            $UsersAll = User::where('UserName', 'LIKE', '%' . \request()->SearchTerm . '%')->get();
            foreach ($UsersAll as $user) {
                $Users[] = User::find($user->id);
            }
        }
        return view('Exhibitor.inbox')->with(['Booth' => $Booth, 'Users' => $Users]);
    }


    public function InboxPost(Request $request)
    {
        if (Chat::where('BoothID', $request->BoothID)->where('UserID', $request->UserID)->get()[0]->Owner != null) {
            $Owner = Chat::where('BoothID', $request->BoothID)->where('UserID', $request->UserID)->first()->Owner;
        } else {
            $Owner = Auth::id();
        }
        $request->validate([
            'Text' => 'required|string',
            'UserID' => 'required|integer',
            'Status'=>'required'
        ]);

        Chat::create([
            'UserID' => $request->UserID,
            'BoothID' => $request->BoothID,
            'Text' => $request->Text,
            'Sender' => 'Exhibitor',
            'Owner' => $Owner,
            'Status'=>$request->Status
        ]);
    }


    public function History()
    {
        $newMessage = $this->newMessages() ;
        $Booth = $this->Booth();
        if (\request()->SearchTerm) {
            $UserName = User::where('UserName', 'LIKE', '%' . \request()->SearchTerm . '%')->get();
            if ($UserName->count() <= 0) {
                return redirect()->back();
            }else{
                return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $UserName,'newMessage'=>$newMessage]);

            }
            $Statistic = Statistics::where('UserID', $UserName[0]->id)->where('BoothID', $Booth->id)->get();
        }
        else {
            $Statistic = Statistics::where('BoothID', $Booth->id)->get();
        }
        $Users = [];
        $uniques = array();
        foreach ($Statistic as $obj) {
            $uniques[$obj->UserID] = $obj;
        }
        foreach ($uniques as $item) {
            $Users[] = User::find($item->UserID);
            if (\request()->gender) {
//                $UsersGender[] = User::where("id",$item->UserID)->where("Gender",\request()->gender)->first();
            }
        }





        if (\request()->UserID) {
            $User = User::find(\request()->UserID);
            return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $Users, 'User' => $User]);
        }




        if (\request()->gender) {
            $final=[];
            foreach ($Users as $userFiltered) {

                if ($userFiltered->Gender == \request()->gender) {
                    $final[]=$userFiltered;
                }

            }


            if (count($final) <= 0) {
                Alert::error("nothing found");
                return redirect()->back();
            }else{
                return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $final]);
            }


        }


        if (\request()->profession) {
            $final=[];
            foreach ($Users as $userFiltered) {

                if ($userFiltered->Profession == \request()->profession) {
                    $final[]=$userFiltered;
                }

            }


            if (count($final) <= 0) {
                Alert::error("nothing found");
                return redirect()->back();
            }else{
                return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $final]);
            }


        }



        if (\request()->interestedDegree) {
            $final=[];
            foreach ($Users as $userFiltered) {

                if ($userFiltered->InterestedDegree == \request()->interestedDegree) {
                    $final[] = $userFiltered;
                }

            }


            if (count($final) <= 0) {
                Alert::error("nothing found");

                return redirect()->back();
            }else{
                return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $final]);
            }


        }


        if (\request()->interestedField) {
            $final=[];
            foreach ($Users as $userFiltered) {

                if ($userFiltered->InterestedField == \request()->interestedField) {
                    $final[] = $userFiltered;
                }

            }


            if (count($final) <= 0) {
                Alert::error("nothing found");

                return redirect()->back();
            }else{
                return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $final]);
            }


        }

        if (\request()->onDegree) {
            $final=[];
            foreach ($Users as $userFiltered) {

                if ($userFiltered->onlineDegreeProgram == \request()->onDegree) {
                    $final[] = $userFiltered;
                }

            }

            if (count($final) <= 0) {
                Alert::error("nothing found");
                return redirect()->back();
            }else{
                return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $final]);
            }
        }


        if (\request()->adSem) {
            $final=[];
            foreach ($Users as $userFiltered) {

                if ($userFiltered->admissionSemester == \request()->adSem) {
                    $final[] = $userFiltered;
                }

            }

            if (count($final) <= 0) {
                Alert::error("nothing found");
                return redirect()->back();
            }else{
                return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $final]);
            }
        }

        if (\request()->intProf) {
            $final=[];
            foreach ($Users as $userFiltered) {

                if ($userFiltered->professionInterestedToApply == \request()->intProf) {
                    $final[] = $userFiltered;
                }

            }

            if (count($final) <= 0) {
                Alert::error("nothing found");
                return redirect()->back();
            }else{
                return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $final]);
            }
        }


        if (\request()->profile) {
            $final=[];
            foreach ($Users as $userFiltered) {

                if ($userFiltered->profile == \request()->profile) {
                    $final[] = $userFiltered;
                }

            }

            if (count($final) <= 0) {
                Alert::error("nothing found");
                return redirect()->back();
            }else{
                return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $final]);
            }
        }

        if (\request()->edu) {
            $final=[];
            foreach ($Users as $userFiltered) {
                if ($userFiltered->education == \request()->edu) {
                    $final[] = $userFiltered;
                }
            }

            if (count($final) <= 0) {
                Alert::error("nothing found");
                return redirect()->back();
            }else{
                return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $final]);
            }
        }


        return view('Exhibitor.History')->with(['Booth' => $Booth, 'Users' => $Users,'newMessage'=>$newMessage]);


    }

    public function UpdateAvatar(Request $request)
    {
        $request->validate([
            'Avatar' => 'image|required'
        ]);
        $User = Auth::user();
        $User->Image = $this->UploadPic($request, 'Avatar', 'UserProfiles', 'Profile');
        $User->save();
        return redirect()->back();
    }

    public function ChangePassword(Request $request)
    {
        $request->validate([
            'OldPassword' => 'required',
            'password' => 'required|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/',
        ]);
        if (Hash::check($request->OldPassword, Auth::user()->password)) {
            Auth::user()->password = Hash::make($request->password);
            Auth::user()->save();
            Auth::logout();
            Alert::success("Password Changed Successfully");
            return redirect()->route('PassChanged');

        }
        Alert::error("Change Password failed, Try again");

        return redirect()->back();


    }

    public function AboutCompany(Request $request)
    {
        $request->validate([
            'Description' => 'required|string'
        ]);
        $Booth = $this->Booth();
        $Booth->Description = $request->Description;
        $Booth->save();
        return redirect()->back();

    }


    public function Chat(Request $request)
    {
        if (Chat::where('BoothID', $this->Booth()->id)->where('UserID', $request->UserID)->get()[0]->Owner != null) {
            $Owner = Chat::where('BoothID', $this->Booth()->id)->where('UserID', $request->UserID)->first()->Owner;
        } else {
            $Owner = Auth::id();
        }
        $request->validate([
            'Text' => 'required|string',
            'UserID' => 'required|integer'
        ]);

        Chat::create([
            'UserID' => $request->UserID,
            'BoothID' => $this->Booth()->id,
            'Text' => $request->Text,
            'Sender' => 'Exhibitor',
            'Owner' => $Owner
        ]);
        return redirect()->back();
    }


    public function MyBooth()
    {
        $newMessage = $this->newMessages() ;
        return view('Exhibitor.BoothInfo')->with(['Booth' => $this->Booth(),'newMessage'=>$newMessage]);
    }


    public function UpdateBooth(Request $request)
    {


        $Booth = $this->Booth();
        $Booth->Poster1 = $request->hasFile('Poster1') ? $this->S3Hasan($request,'Poster1') : $Booth->Poster1;
        $Booth->Poster2 = $request->hasFile('Poster2') ? $this->S3Hasan($request, 'Poster2') : $Booth->Poster2;
        $Booth->Poster3 = $request->hasFile('Poster3') ? $this->S3Hasan($request, 'Poster3') : $Booth->Poster3;
        $Booth->Logo = $request->hasFile('Logo') ? $this->S3Hasan($request, 'Logo') : $Booth->Logo;
        $Booth->Doc1 = $request->hasFile('PdfFile') ? $this->S3Doc($request, 'PdfFile') : $Booth->Doc1;
        if ($request->Video) {
            $Booth->Video = preg_match('/.*embed.*/', $request->Video) ? $request->Video : preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "https://www.youtube.com/embed/$1", $request->Video);
        }
        $Booth->Color1 = $request->Color1;
        $Booth->Color2 = $request->Color2;
        $Booth->WebSiteColor = $request->WebSiteColor;
        $Booth->WebSite = $request->WebSite;
        $Booth->linkedin = $request->linkedin;
        $Booth->facebook = $request->facebook;
        $Booth->instagram = $request->instagram;
        $Booth->save();
        Alert::success('Changes Saved');
        return redirect()->back();
    }

    public function DeleteJob($id)
    {
        $Job = Jobs::find($id);
        $Job->delete();
        Alert::success('Job Deleted SuccessFully');

        return redirect()->back();
    }


    public function AddStaff()
    {
        $newMessage = $this->newMessages() ;
        $BoothID = booth::where("UserID",\auth()->user()->id)->first()->id;
        $emails=Invitation::where("ParentID",$BoothID)->get();
        $opCount=Invitation::where("ParentID",$BoothID)->count();


        return view("Exhibitor.AddStaff",compact("emails","opCount",'newMessage'));
    }


    public function newMessages()
    {

        $Booth = $this->Booth();
        $newMessage = Chat::where('BoothID', $Booth->id)->where('Sender', 'Visitor')->where("Status","New")->count();
        return $newMessage;

    }




    public function exhibitorContactUsAjax()
    {
        $boothID = booth::where("UserID",auth()->user()->id)->first()->id;
        $Count = AdminChat::where([
            ['ReceiverID', auth()->user()->id],
            ['Status', 'New'],
            ['Sender','!=','Admin']
        ])->count();


        booth::where("id",$boothID)->update(["newmessage"=>$Count]);

        return response()->json([
            'newChat'=>$Count
        ]);
    }




}
