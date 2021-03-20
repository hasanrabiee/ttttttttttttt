<?php

namespace App\Http\Controllers;

use App\AdminChat;
use App\Auditorium;
use App\AuditoriumChat;
use App\booth;
use App\Chat;
use App\Conference;
use App\ConferenceRequest;
use App\ExhibitorForms;
use App\Exports\AuditoriumExport;
use App\Exports\ExhibitorsExport;
use App\Exports\FeedbacksExport;
use App\Hall;
use App\Invitation;
use App\Jobs;
use App\Lounge;
use App\LoungeChat;
use App\Mail\AuditoriumPublish;
use App\Mail\ExhibitorFeedback;
use App\Mail\InviteOperators;
use App\Mail\Reminder;
use App\Mail\SpeakerRegister;
use App\Mail\SuspendExhibitor;
use App\Mail\thanks;
use App\Organizer;
use App\Site;
use App\Speaker;
use App\Statistics;
use App\Traits\Uploader;
use App\User;
use App\VisitorForm;
use Carbon\Carbon;
use DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\Response;
use \Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use MacsiDigital\Zoom\Facades\Zoom;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    use Uploader;


    public function AddConferenceIndex(Request $request)
    {

        $speakers = "";
        $current_speakers = "";





        if ($request->has('sid')) {

            $current_speakers = Speaker::where('id', \request()->sid)->first();

            if ($request->action == 'delete') {

                Alert::success('Speaker Deleted Successfully');
                $current_speakers->delete();
                return redirect()->route('Admin.conference-create');
            }


        }
        if ($request->has('cid')) {


            $speakers = Speaker::where('booth', '0')->where('cid', $request->cid)->get();


        }


        $StartDate = Site::find(1)->StartDate;
        $days = [];
        for ($i = 0; $i < 10; $i++) {
            $days[] = Carbon::parse($StartDate)->format('Y-m-d');
            $StartDate = Carbon::parse($StartDate)->addDay();
        }


        $conferences = "";

        if ($request->has('day')) {
            $conferences = ConferenceRequest::where('booth', '0')->where('date1', $request->day)->get();
        }


        $current_conference = \request()->has('cid') ? ConferenceRequest::where('id', \request()->cid)->first() : "";

        return view('Admin.Conference')->with([

            'speakers' => $speakers,
            'current_conference' => $current_conference,
            'days' => $days,
            'conferences' => $conferences,
            'current_speakers' => $current_speakers,
        ]);


    }

    public function AddConferenceAction(Request $request)
    {

        $request->validate([

            'date' => 'required|date',
            'title' => 'required|string',
            'abstract' => 'required|string',

        ]);



        if ($request->has('update')) {

            $current_conference = \request()->has('cid') ? ConferenceRequest::where('id', \request()->cid)->first() : "";

            $current_conference->title = $request->title ?? '';
            $current_conference->abstract = $request->abstract ?? '';

            $current_conference->save();


            $active_conf = Conference::where('crid', \request()->cid)->first();
            if($active_conf){

                $active_conf->title = $request->title ?? '';
                $active_conf->abstract = $request->abstract ?? '';
                $active_conf->save();

            }



            Alert::success('Conference Updated Successfully');

            return redirect()->back();


        }


        $current_booth = 0;

        ConferenceRequest::create([

            "booth" => '0',
            "date1" => $request->date,
            "date2" => $request->date,
            "date3" => $request->date,
            "title" => $request->title,
            "abstract" => $request->abstract,


        ]);

        Alert::success('Conference created successfully, you can now add speakers');
        return redirect()->back();


    }


    public function UpdateSpeaker(Request $request)
    {

        $request->validate([
            'Name' => 'required|string',
            'email' => 'required|string',
            'UserName' => 'required|string',
            'sid' => 'required|string',

        ]);

        $speaker = Speaker::where('id', $request->sid)->first();


        $speaker->Name = $request->Name;
        $speaker->email = $request->email;
        $speaker->UserName = $request->UserName;


        if ($request->has('password') && $request->password != null) {
            $speaker->password = Hash::make($request->password);

        }

        $speaker->save();

        Alert::success('Speaker Updated Successfully');
        return redirect()->route('Admin.conference-create');

    }

    public function AddSpeaker(Request $request)
    {


        $request->validate([
            'Name' => 'required|string',
            'email' => 'required|string|unique:speakers',
            'UserName' => 'required|string|unique:speakers',
            'password' => 'required|string|min:8|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/',
            'cid' => 'required|string',

        ]);

        $current_conference = ConferenceRequest::where('id', \request()->cid)->first();


        $Speaker = Speaker::create([
            'Name' => $request->Name,
            'email' => $request->email,
            'UserName' => $request->UserName,
            'password' => $request->password,
            'SpeechTitle' => $current_conference->title,
            'PreferredDate1' => $current_conference->date1,
            'PreferredDate2' => $current_conference->date1,
            'PreferredDate3' => $current_conference->date1,
            'cid' => \request()->cid,
            'booth' => '0',
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


    public function AddConferenceFinalize(Request $request)
    {


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


        $user = Auth::user();
        $user->finalize_conference = 'yes';
        $user->save();

        Alert::success('Conference submitted successfully');

        return redirect()->back();


    }


    public function CompanyList()
    {
        if (\request()->SearchTermBooth) {

            $Booths = booth::select('id', "UserID", "CompanyName")->where('CompanyName', 'LIKE', '%' . \request()->SearchTermBooth . '%')->get();
        } else {
            $Booths = booth::select('id', "UserID", "CompanyName")->get();
        }
        return response()->json([
            'Booths' => $Booths
        ], 200);
    }

    public function ChangeChatStatus(Request $request)
    {
        if ($request->ID && $request->UserID) {
            $Chatsssss = AdminChat::where('UserID', $request->UserID)->where('ReceiverID', $request->ID)->where('Sender',"!=",'Admin')->get();
            foreach ($Chatsssss as $ch) {
                $ch->Status = 'Viewed';
                $ch->save();
            }
            return response()->json([
                'msg' => 'Done'
            ], 200);
        } else {
            return response()->json([
                'msg' => 'Error'
            ], 200);

        }
    }


    public function hasanChatCount(){
        $newMessage = AdminChat::where("Status","New")->where("Sender","!=","Admin")->count();
        return $newMessage;
    }

    public static function ChatCount($id)
    {
        $Count = AdminChat::where([
            ['ReceiverID', $id],
            ['Status', 'New'],
            ['Sender','!=','Admin']
        ])->count();

        User::where("id",$id)->update(["newmessage"=>$Count]);


        booth::where("UserID",$id)->update(["newmessage"=>$Count]);

        if ($Count > 0) {
            return $Count;
        } else {
            return 0;
        }
    }


    public function ChatCountTest($id)
    {
        $Count = AdminChat::where([
            ['ReceiverID', $id],
            ['Status', 'New'],
            ['Sender','!=','Admin']
        ])->count();

        User::where("id",$id)->update(["newmessage"=>$Count]);

        booth::where("UserID",$id)->update(["newmessage"=>$Count]);

        if ($Count > 0) {
            return $Count;
        } else {
            return 0;
        }
    }


    public static function ChatCountEx($id)
    {

        $Booth = booth::where("UserID",\auth()->user()->id)->first();

        $Count = Chat::where([['BoothID' , $Booth->id],['UserID' , $id],['Sender' , 'Visitor'],['Status' , 'New']])->count();
        User::where("id",$id)->update(["newmessage"=>$Count]);

        if ($Count > 0) {
            return $Count;
        } else {
            return 0;
        }
    }


    public function index(Request $request)
    {

        $this->onlineShow();



        if ($request->ajax()) {
            if ($request->SearchTermBooth)
                $booth_list = booth::select('id', "UserID", "CompanyName")->where('CompanyName', 'LIKE', '%' . \request()->SearchTermBooth . '%')->paginate(10);
            else
                $booth_list = booth::select('id', "UserID", "CompanyName")->orderBy("newmessage","Desc")->paginate(10);
            $booth_list_view = view('company-list-data', compact('booth_list'))->render();

            if ($request->SearchTermUser)
                $users_list = User::select("id", "UserName")->where('UserName', 'LIKE', '%' . \request()->SearchTermUser . '%')->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->paginate(10);
            else
                $users_list = User::whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->where('id', '!=', \request()->UserID)->orderBy("newmessage","Desc")->paginate(10);
            $users_list_view = view('user-list-data', compact('users_list'))->render();
            return response()->json(['booth_list' => $booth_list_view, 'users_list' => $users_list_view]);

        }


        if (\request()->CompanyID) {
            $ID = booth::find(\request()->CompanyID)->UserID;
            $Chats = AdminChat::where('UserID', Auth::id())->where('ReceiverID', $ID)->get();
            $Chatsssss = AdminChat::where([
                ['ReceiverID', $ID],
                ['Status', 'New'],
            ])->get();
            foreach ($Chatsssss as $ch) {

                $ch->Status = 'Viewed';

                $ch->save();
            }

            $selected_booth = booth::select('id', "UserID", "CompanyName")->where("id", \request()->CompanyID)->first();
            $booth_list = booth::select('id', "UserID", "CompanyName")->where("id", "!=", \request()->CompanyID)->orderBy("newmessage","Desc")->paginate(10);


            $collection = collect();

            $collection->push($selected_booth);


            foreach ($booth_list as $bl)
                $collection->push($bl);

            $booth_list = $collection;


        } else {

            if (\request()->SearchTermBooth) {
                $booth_list = booth::where('CompanyName', 'LIKE', '%' . \request()->SearchTermBooth . '%')->get(['id', "UserID", "CompanyName"]);
            } else {
                $booth_list = booth::select('id', "UserID", "CompanyName")->orderBy("newmessage","Desc")->paginate(10);

            }

        }


        if (\request()->UserID) {
            $Chats = AdminChat::where('UserID', Auth::id())->where('ReceiverID', \request()->UserID)->get();
            $Chatsssss = AdminChat::where([
                ['ReceiverID', \request()->UserID],
                ['Status', 'New'],
            ])->get();
            foreach ($Chatsssss as $chatsssss) {
                $chatsssss->Status = 'Viewed';
                $chatsssss->save();
            }

//            $users_list = User::where('Rule', 'Visitor')->orderBy("newmessage")->paginate(10);
            $users_list = User::whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->where('id', '!=', \request()->UserID)->orderBy("newmessage","Desc")->paginate(10);
            $selected_user = User::select("id", "UserName")->where("id", \request()->UserID)->first();


            $collection = collect();

            $collection->push($selected_user);


            foreach ($users_list as $ul)
                $collection->push($ul);

            $users_list = $collection;


        } else {

            if (\request()->SearchTermUser) {

                $users_list = User::where('UserName', 'LIKE', '%' . \request()->SearchTermUser . '%')->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->get(["id", "UserName"]);


            } else {
                $users_list = User::whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->where('id', '!=', \request()->UserID)->orderBy("newmessage","Desc")->paginate(10);

            }


        }


        if (isset($Chats))

            return view('Admin.index', compact('booth_list', 'users_list', 'Chats'));
        else
            return view('Admin.index', compact('booth_list', 'users_list'));

    }


    public function UserList()
    {


        if (\request()->SearchTermUser) {
            $Users = User::select("id", "UserName")->where('UserName', 'LIKE', '%' . \request()->SearchTermUser . '%')->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->get();
        } else {
            $Users = User::whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->where('id', '!=', \request()->UserID)->where("newmessage","!=",0)->where("newmessage","!=",0)->orderBy("newmessage","Desc")->all();
        }
        return response()->json([
            'Users' => $Users
        ], 200);
    }

    public function InboxChatGet(Request $request)
    {
        $request->validate([
            'Mode' => ['required'],
            'ID' => ['required'],
            'UserID' => ['required'],
        ]);
        if ($request->Mode == 'Company') {
            $ID = booth::find($request->ID)->UserID;
        } else {
            $ID = $request->ID;
        }
        $Chats = AdminChat::where('ReceiverID', $ID)->get();
        return response()->json([
            'Chat' => $Chats
        ], 200);
    }


    public function SendMessage(Request $request)
    {
        $request->validate([
            'Text' => ['required', 'max:255'],
            'UserID' => ['required'],
            'ID' => ['required'],
        ]);
        if ($request->Mode == 'Company') {
            $ID = booth::find($request->ID)->UserID;
        } else {
            $ID = $request->ID;
        }
        AdminChat::create([
            'Text' => $request->Text,
            'UserID' => $request->UserID,
            'ReceiverID' => $ID,
            'Sender' => 'Admin',
            'Status' => 'New'
        ]);
        $Chats = AdminChat::where('ReceiverID', $ID)->where("Status","New")->get();
        return response()->json([
            'Chat' => $Chats
        ], 200);
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
            Alert::success('Password Changed Successfully');
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function UserPaid(Request $request)
    {
        $User = User::find($request->UserID);

        if ($User->Payment == 'Paid') {
            $User->Payment = 'UnPaid';
            $User->AccountStatus = 'Suspend';
        } else {
            $User->Payment = 'Paid';
            $User->AccountStatus = 'Active';
        }
        $User->save();
        Alert::success('Changes Saved');
        return redirect()->back();
    }

    public function BackUp()
    {
        Artisan::call('backup:run');
        Alert::success('BackUp Created Successfully');
        return redirect()->back();
    }


    public function ExportVisitors(){

        return Excel::download(new UsersExport, 'users.xlsx');

    }

    public function ExportExhibitors(){

        return Excel::download(new ExhibitorsExport, 'exhibitors.xlsx');

    }

    public function ExportFeedbacks(){

        return Excel::download(new FeedbacksExport, 'feedbacks.xlsx');

    }

    public function Restore()
    {
        //Final need Restore
    }


    public function Reset()
    {
        File::cleanDirectory(public_path('Uploads'));
        foreach (LoungeChat::all() as $item) {
            $item->delete();
        }
        foreach (Lounge::all() as $item) {
            $item->delete();
        }
        foreach (Chat::all() as $item) {
            $item->delete();
        }
        foreach (Statistics::all() as $item) {
            $item->delete();
        }
        foreach (Jobs::all() as $item) {
            $item->delete();
        }
        foreach (booth::all() as $item) {
            $item->delete();
        }
        foreach (User::all() as $item) {
            if ($item->Rule != 'Admin') {
                $item->delete();
            }
        }
        Alert::success('Site Reset SuccessFull');


        return redirect()->back();
    }


    public function History()
    {

        $newMessage = $this->hasanChatCount();

        $this->onlineShow();


        if (\request()->SearchTermBooth) {
            $Booths = booth::where('CompanyName', 'LIKE', '%' . \request()->SearchTermBooth . '%')->get();
        } else {
            $Booths = booth::all();
        }

        if (\request()->SearchTermUser) {
            $User = User::where('UserName', 'LIKE', '%' . \request()->SearchTermUser . '%')->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->get();
        } else {
            $User = User::whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->get();
        }


        if (\request()->CompanyID) {
            $ID = booth::find(\request()->CompanyID)->UserID;
            $Chats = AdminChat::where('UserID', Auth::id())->where('ReceiverID', $ID)->get();
            return view('Admin.History')->with(['Booths' => $Booths, 'Chats' => $Chats, 'Users' => $User,'newMessage'=>$newMessage]);
        }
        if (\request()->UserID) {
            $Chats = AdminChat::where('UserID', Auth::id())->where('ReceiverID', \request()->UserID)->get();

            return view('Admin.History')->with(['Booths' => $Booths, 'Chats' => $Chats, 'Users' => $User,'newMessage'=>$newMessage]);
        }


        if (\request()->institution) {
            $booths = null;
            $Usersf = User::where("institution",\request()->institution)->get();
            foreach ($Usersf as $Userf){
                if (booth::where("UserID",$Userf->id)->count() > 0) {
                    $booths [] = booth::where("UserID",$Userf->id)->first();
                }else{
                    $booths = null;
                }
            }

            if ($booths != null) {
                return view('Admin.History')->with(['Booths' => $booths, 'Users' => $User,'newMessage'=>$newMessage]);
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }


        }


        if (\request()->gender) {
            if (User::where("Gender",\request()->gender)->count() >0) {
                $Users = User::where("Gender",\request()->gender)->get();
                return view('Admin.History')->with(['Booths' => $Booths, 'Users' => $Users,'newMessage'=>$newMessage]);
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }

        }

        if (\request()->profession) {
//            dd(User::where("profession","test2")->count());
            if (User::where("Profession",\request()->profession)->count() >0) {
                $Users = User::where("Profession",\request()->profession)->get();
                return view('Admin.History')->with(['Booths' => $Booths, 'Users' => $Users,'newMessage'=>$newMessage]);
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }

        }

        if (\request()->country) {
            if (User::where("countryStudy",\request()->country)->count() >0) {
                $Users = User::where("countryStudy",\request()->country)->get();
                return view('Admin.History')->with(['Booths' => $Booths, 'Users' => $Users,'newMessage'=>$newMessage]);
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }

        }

        if (\request()->interestedDegree) {
            if (User::where("InterestedDegree",\request()->interestedDegree)->count() >0) {
                $Users = User::where("InterestedDegree",\request()->interestedDegree)->get();
                return view('Admin.History')->with(['Booths' => $Booths, 'Users' => $Users,'newMessage'=>$newMessage]);
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }

        }

        if (\request()->interestedField) {
            if (User::where("InterestedField",\request()->interestedField)->count() >0) {
                $Users = User::where("InterestedField",\request()->interestedField)->get();
                return view('Admin.History')->with(['Booths' => $Booths, 'Users' => $Users,'newMessage'=>$newMessage]);
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }

        }

        if (\request()->onDegree) {
            if (User::where("onlineDegreeProgram",\request()->onDegree)->count() >0) {
                $Users = User::where("onlineDegreeProgram",\request()->onDegree)->get();
                return view('Admin.History')->with(['Booths' => $Booths, 'Users' => $Users,'newMessage'=>$newMessage]);
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }

        }


        if (\request()->adSem) {
            if (User::where("admissionSemester",\request()->adSem)->count() >0) {
                $Users = User::where("admissionSemester",\request()->adSem)->get();
                return view('Admin.History')->with(['Booths' => $Booths, 'Users' => $Users,'newMessage'=>$newMessage]);
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }

        }

        if (\request()->intProf) {
            if (User::where("professionInterestedToApply",\request()->intProf)->count() >0) {
                $Users = User::where("professionInterestedToApply",\request()->intProf)->get();
                return view('Admin.History')->with(['Booths' => $Booths, 'Users' => $Users,'newMessage'=>$newMessage]);
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }

        }

        if (\request()->profile) {
            if (User::where("profile",\request()->profile)->count() >0) {
                $Users = User::where("profile",\request()->profile)->get();
                return view('Admin.History')->with(['Booths' => $Booths, 'Users' => $Users,'newMessage'=>$newMessage]);
            }else {
                Alert::error("nothing found");
                return redirect()->back();
            }

        }


        return view('Admin.History')->with(['Booths' => $Booths, 'Users' => $User,'newMessage'=>$newMessage]);
    }
    public function Lounge()
    {
        $newMessage = $this->hasanChatCount();
        $this->onlineShow();
        $Lounges = Lounge::all();
        if (\request()->LoungID) {
            $Lounge = Lounge::find(\request()->LoungID);
            $Chats = LoungeChat::where('LoungeID', \request()->LoungID)->get();
            return view('Admin.Lounge')->with(['Lounges' => $Lounges, 'Lounge' => $Lounge, 'Chats' => $Chats,'newMessage'=>$newMessage]);
        }
        if (\request()->RemoveUser) {
            $Lounge = Lounge::find(\request()->LoungeID);
            $Members = json_decode($Lounge->Members);
            if (($key = array_search(\request()->RemoveUser, $Members)) !== false) {
                unset($Members[$key]);
            }
            $Lounge->Members = $Members;
            $Lounge->save();
            Alert::success('Member Removed From Lounge  Created!!!');

            return redirect()->back();
        }
        return view('Admin.Lounge')->with(['Lounges' => $Lounges,'newMessage'=>$newMessage]);
    }


    public function SendMessagetoLounge($LoungeID, Request $request)
    {
        $request->validate([
            'Text' => ['required', 'max:255']
        ]);
        LoungeChat::create([
            'UserID' => Auth::id(),
            'LoungeID' => $LoungeID,
            'Text' => $request->Text
        ]);

        return redirect()->back();

    }

    public function CreateLounge(Request $request)
    {
        $request->validate([
            'Name' => 'required|string',
        ]);
        $Members = [Auth::id()];

        Lounge::create([
            'Name' => $request->Name,
            'Members' => json_encode($Members)
        ]);
        Alert::success('Lounge Group Created!!!');

        return redirect()->back();
    }

    public function RemoveLounge($id)
    {
        Lounge::whereId($id)->delete();
        Alert::success('Group Removed!!!');

        return redirect()->route('Admin.Lounge');
    }

    public function RemoveLoungeWithUrl($id)
    {
        $Lounge = Lounge::find($id);
        $Lounge->delete();
        Alert::success('Lounge  Removed!!!');

        return redirect()->back();
    }


    public function RemoveExhibitor($id)
    {
        $Booth = booth::find($id);
        $User = User::find($Booth->UserID);
        $Users = User::where('CompanyID', $Booth->id)->get();
        foreach ($Users as $user) {
            $user->delete();
        }
        $Booth->delete();
        $User->delete();
        Alert::success('Exhibitor  Removed!!!');

        return redirect()->route('Admin.RegisteredExhibitor');
    }

    public function Statistics()
    {
        $newMessage = $this->hasanChatCount();
        $this->onlineShow();
        $Date = Statistics::groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                \DB::raw('Date(created_at) as date'),
                \DB::raw('COUNT(*) as "views"')
            ));
        $Company = Statistics::limit(9)->groupBy('BoothID')
            ->orderBy('BoothID', 'ASC')
            ->get(array(
                \DB::raw('BoothID'),
                \DB::raw('COUNT(*) as "views"'),
            ));
        $Profession = Statistics::groupBy('Profession')
            ->orderBy('Profession', 'ASC')
            ->get(array(
                \DB::raw('Profession'),
                \DB::raw('COUNT(*) as "views"'),
            ));
        $Gender = Statistics::groupBy('Gender')
            ->orderBy('Gender', 'ASC')
            ->get(array(
                \DB::raw('Gender'),
                \DB::raw('COUNT(*) as "views"'),
            ));
        $AllCompany = Statistics::groupBy('BoothID')
            ->orderBy('BoothID', 'ASC')
            ->get(array(
                \DB::raw('BoothID'),
                \DB::raw('COUNT(*) as "views"'),
            ));

        $AllGroups = Lounge::all();

        return view('Admin.statistics')->with([
            'Company' => $Company,
            'Gender' => $Gender,
            'Profession' => $Profession,
            'Date' => $Date,
            'AllCompany' => $AllCompany,
            'AllGroups' => $AllGroups,
            'newMessage'=> $newMessage
        ]);
    }























    public function AuditoriumDelete($id = "empty")
    {


        if ($id == "empty")
            return redirect()->back();


        $conference = Conference::where('id', $id)->first();

        $conf_req_id = ConferenceRequest::where('id', $conference->crid)->first();
        $conf_req_id->used = 'notselected';
        $conf_req_id->save();

        $conference->delete();

        Alert::success('Conference deleted from Auditorium');
        return redirect()->back();


    }

    public function AuditoriumCreate(Request $request)
    {

        $request->validate([

            "start_time" => "required",
            "day" => "required",
            "end_time" => "required",
            "cid" => "required",
            "hall" => "required",


        ]);


        $conference_request = ConferenceRequest::where('id', $request->cid)->first();
        $conference_request->used = 'selected';
        $conference_request->save();


        Conference::create([


            "booth" => $conference_request->booth,
            "start_date" => $request->day,
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
            "title" => $conference_request->title,
            "abstract" => $conference_request->abstract,
            "hall" => $request->hall,
            "crid" => $conference_request->id,


        ]);

        Alert::success('Conference added to Auditorium successfully');

        return redirect()->back();


    }

    public function leave_meeting(Request $request) {


        Alert::success('Successfully left the meeting');
        return redirect()->to('/');



    }
    public function Auditorium()
    {

        $StartDate = Site::find(1)->StartDate;
        $Days = [];
        for ($i = 0; $i < 10; $i++) {
            $Days[] = Carbon::parse($StartDate)->format('Y-m-d');
            $StartDate = Carbon::parse($StartDate)->addDay();
        }
        if (\request()->day) {
            $Day = \request()->day;
            $Speakers = Speaker::where('Status', 'None')->get();
            $Speakers2 = Speaker::where('Status', 'None')->where('PreferredDate1', $Day)
                ->orWhere('PreferredDate2', $Day)
                ->orWhere('PreferredDate3', $Day)->get();
            $RegisteredSpeakers = Auditorium::where('Day', $Day)->get();
            $current_day_confs = ConferenceRequest::where('used', 'notselected')->where('date1', $Day)->orWhere('date2', $Day)
                ->orWhere('date3', $Day)->get();


            $all_conf_reqs = ConferenceRequest::where('used', 'notselected')->get();

            return view('Admin.Auditorium')->with([

                'current_day_confs' => $current_day_confs,
                'all_conf_reqs' => $all_conf_reqs,

                'Speakers2' => $Speakers2,
                'Days' => $Days,
                'Day' => $Day,
                'Speakers' => $Speakers,
                'RegisteredSpeakers' => $RegisteredSpeakers
            ]);
        }


        return view('Admin.Auditorium')->with([
            'Days' => $Days


        ]);
    }

    public function SpeakerPost(Request $request)
    {
        $request->validate([
            'Name' => 'required|string',
            'email' => 'required|string|unique:speakers',
            'UserName' => 'required|string|unique:speakers',
            'password' => 'required|string|min:8|confirmed|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/',
            'SpeechTitle' => 'required|string',
            'Day' => 'required|date',
        ]);

        $Speaker = Speaker::create([
            'Name' => $request->Name,
            'email' => $request->email,
            'UserName' => $request->UserName,
            'password' => $request->password,
            'SpeechTitle' => $request->SpeechTitle,
            'PreferredDate1' => $request->Day
        ]);

        $data = [
            'Name' => $request->Name,
            'email' => $request->email,
            'UserName' => $request->UserName,
            'password' => $request->password,
            'Speech Title' => $request->SpeechTitle,
            'Speach Date' => $request->Day
        ];
        Mail::to($Speaker->email)->send(new SpeakerRegister($data));

        Alert::success('Speaker Saved Successful');

        return redirect()->back();


    }

    public function RemoveSpeaker($id)
    {


        $Auditorium = Auditorium::where('SpeakerID', $id)->get()[0];
        $chats = AuditoriumChat::where('auditoriaID', $Auditorium->id)->get();
        foreach ($chats as $chat) {
            $chat->delete();
        }
        $Auditorium->delete();
        $Speaker = Speaker::find($id);
        $Speaker->Status = 'none';
        $Speaker->save();
        Alert::success('Speaker removed Successfully');
        return redirect()->back();


    }


    public function AuditoriumExport()
    {
        return Excel::download(new AuditoriumExport, 'FinalTableExport.xlsx');
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

        $this->sendNotification("Webinar Started", $conference->title . " started right now");





        return view('zoom-webinar.start')->with([
            'webinar' => $conference,
            'role' => '1',

        ]);

    }


    public function sendNotification($title,$message)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = env('FIREBASE_SERVER_KEY','xxxxxxxxx');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $message,
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);


        if(\request()->has('redirect')){

            Alert::success('Openning Anounced to users');

            return redirect()->back();
        }


    }



    public function sendNotificationModal(Request $request)
    {

        $request->validate([

            'title' => 'required',
            'body' => 'nullable'

        ]);


        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = env('FIREBASE_SERVER_KEY','xxxxxxxxx');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $request->title,
                "body" => $request->body ?? 'N/A',
            ]
        ];
        $dataString = json_encode($data);

        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);




            Alert::success('Notification Sent to users successfully');

            return redirect()->back();



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

    public function AuditoriumPublish()
    {
        $x = Excel::store(new AuditoriumExport(), 'FinalTableExport.xlsx', 'Export');

        $Users = User::all();

        foreach ($Users as $user) {
            Jobs\SendPublishEmail::dispatch($user->email);
        }
        $Auditoria = Conference::all();

        foreach ($Auditoria as $conf) {

            $speakers = Speaker::where('cid', $conf->crid)->get();

            foreach ($speakers as $Speaker){


                $data = [
                    'Speech Title' => $Speaker->SpeechTitle,
                    'Start Date' => $conf->start_date,
                    'Start Time' => $conf->start_time,
                    'End Time' => $conf->end_time,

                    'Name' => $Speaker->Name,
                    'Username' => $Speaker->UserName,
                    'password' => $Speaker->password,
                    'email' => $Speaker->email,

                ];
            Jobs\publishforspeaker::dispatch($data);

            }
        }
        Alert::success('Sending emails Started');
        unlink(public_path('Export/FinalTableExport.xlsx'));
        return redirect()->back();


    }

    public function AuditoriumPost(Request $request)
    {
        $request->validate([
            'Start' => 'required|date_format:H:i',
            'End' => 'required|date_format:H:i',
            'SpeakerID' => 'required',
            'Day' => 'required|date'
        ]);
        $Start = Carbon::parse($request->Start)->format('H:i');
        $End = Carbon::parse($request->End)->format('H:i');
        if ($Start > $End) {
            return redirect()->back()->withErrors(['Msg' => 'the end must be after start']);
        }

        Auditorium::create([
            'Start' => $request->Start,
            'End' => $request->End,
            'SpeakerID' => $request->SpeakerID,
            'Status' => 'Incoming',
            'Day' => $request->Day
        ]);
        $Speaker = Speaker::find($request->SpeakerID);
        $Speaker->Status = 'Selected';
        $Speaker->save();
        $data = [
            'Start Time' => $request->Start,
            'End Time' => $request->End,
            'Day' => $request->Day,
        ];
        Mail::to($Speaker->email)->send(new \App\Mail\Speaker($data));
        Alert::success('Speak Saved Successful');

        return redirect()->back();
    }
















































    public function RegisteredVisitor()
    {
        $newMessage = $this->hasanChatCount();
        if (\request()->SearchTerm) {
            $Users = User::where('Rule', 'Visitor')->where('UserName', 'LIKE', '%' . \request()->SearchTerm . '%')->get();

        } else {
            $Users = User::where('Rule', 'Visitor')->get();
        }
        if (\request()->UserID) {
            $User = User::find(\request()->UserID);
            return view('Admin.visitors')->with(['Users' => $Users, 'User' => $User,'newMessage'=>$newMessage]);

        }
        return view('Admin.visitors')->with(['Users' => $Users,'newMessage'=>$newMessage]);
    }

    public function RegisteredExhibitor()
    {
        $newMessage = $this->hasanChatCount();
        if (\request()->SearchTerm) {
            $Booths = booth::where('CompanyName', 'LIKE', '%' . \request()->SearchTerm . '%')->get();

        } else {
            $Booths = booth::all();
        }
        if (\request()->BoothID) {
            $Booth = booth::find(\request()->BoothID);
            return view('Admin.exhibitors')->with(['Booths' => $Booths, 'Booth' => $Booth,'newMessage'=>$newMessage]);
        }
        return view('Admin.exhibitors')->with(['Booths' => $Booths,'newMessage'=>$newMessage]);
    }

    public function Setting()
    {
        $newMessage = $this->hasanChatCount();
        $this->onlineShow();
        if (\request()->DeleteOperator) {
            $User = User::find(\request()->DeleteOperator);
            $User->delete();
            Alert::success('Operator Deleted');
            return redirect()->back();
        }

        $Site = Site::find(1);
        $Operators = User::where('Rule', 'Admin-Operator')->get();
        $Backups = File::allFiles(public_path('BackUp'));
        //dd();
        //dd($Backups[0]->getrelativePathname());
        return view('Admin.Setting')->with(['Site' => $Site, 'Operators' => $Operators, 'Backups' => $Backups,'newMessage' => $newMessage]);
    }

    public function SettingPost(Request $request)
    {

        $request->validate([
            'Logo1' => 'image',
            'StartDate' => 'string|nullable',
            'Logo2' => 'image',
            'Logo3' => 'image',
            'AdminBackground' => 'image|nullable',
            'AdminTel' => 'string|nullable',
            'AdminLocation' => 'string|nullable',
            'AdminAddress' => 'string|nullable',
            'OperatorEmails' => 'array',
            'SiteName' => 'string',
        ]);

        $Site = Site::find(1);
        $Site->Terms = $request->editor1;

        $Site->Logo1 = $request->hasFile('Logo1') ? $this->S3Setting($request, 'Logo1') : $Site->Logo1;
        $Site->Logo2 = $request->hasFile('Logo2') ? $this->S3Setting($request, 'Logo2') : $Site->Logo2;
        $Site->Logo3 = $request->hasFile('Logo3') ? $this->S3Setting($request, 'Logo3') : $Site->Logo3;
        $Site->AdminBackground = $request->hasFile('AdminBackground') ? $this->S3Setting($request, 'AdminBackground') : $Site->AdminBackground;
        $Site->AdminTel = $request->AdminTel;
        $Site->StartDate = $request->StartDate;
        $Site->AdminLocation = $request->AdminLocation;
        $Site->AdminAddress = $request->AdminAddress;
        $Site->Name = $request->SiteName;
//        if ($request->OperatorEmails[0] != null) {
//            foreach ($request->OperatorEmails as $operatorEmail) {
//                $Invite = Invitation::create([
//                    'email' => $operatorEmail,
//                    'token' => Str::random(20),
//                    'Rule' => 'AdminOperator',
//                    'ParentID' => Auth::id()
//                ]);
//                Mail::to($operatorEmail)->send(new InviteOperators($Invite->token));
//
//            }
//        }

        $Site->StreamKey = $request->StreamKey;
        $Site->RtmpAddress = $request->RtmpAddress;
        $Site->PlaybackUrl = $request->PlaybackUrl;
        $Site->save();
        Alert::success('Settings Saved Successful');

        return redirect()->back();
    }
//        } catch (\Exception $exception) {
//            Alert::error($exception);
//
//            return redirect()->back();
//        }


    public function Gallery()
    {
        $path = public_path('Uploads');
        $files = \File::allFiles($path);
        return view('Admin.Gallery')->with(['Files' => $files]);
    }

    public function Signin()
    {
        $newMessage = $this->hasanChatCount();
        $this->onlineShow();
        $Site = Site::find(1);
        return view("Admin.Signin",compact("Site","newMessage"));

    }

    public function SigninPost(Request $request)
    {
        $request->validate([
            'ExhabitionTitle' => 'string|nullable',
            'SigninBackground' => 'image',
        ]);
        $Site = Site::find(1);
        $Site->ExhabitionTitle = $request->ExhabitionTitle == '' ? '' : $request->ExhabitionTitle;
        $Site->SigninBackground = $request->hasFile('SigninBackground') ? $this->S3Setting($request, 'SigninBackground') : $Site->SigninBackground;
        $Site->save();
        Alert::success('Settings Saved Successful');

        return redirect()->back();


    }


    public function VisitorSetting()
    {
        $newMessage = $this->hasanChatCount();
        $this->onlineShow();
        $Site = Site::find(1);
        return view('Admin.VisitorSetting')->with(['Site' => $Site,'newMessage' =>$newMessage]);
    }

    public function VisitorSettingPost(Request $request)
    {
        $request->validate([
            'VisitorBackGround' => 'image',
            'VisitorWelcome' => 'string|nullable',
            'VisitorAbout' => 'string|nullable',
            'VisitorAboutPayment' => 'string|nullable',
            'VisitorPayment' => 'integer|nullable',
            'MoneyType' => 'nullable',
        ]);
        $Site = Site::find(1);
        $Site->VisitorBackGround = $request->hasFile('VisitorBackGround') ? $this->S3Setting($request, 'VisitorBackGround') : $Site->VisitorBackGround;
        $Site->VisitorWelcome = $request->VisitorWelcome;
        $Site->VisitorAbout = $request->VisitorAbout;
        $Site->VisitorAboutPayment = $request->VisitorAboutPayment;
        $Site->VisitorPayment = $request->VisitorPayment;
        $Site->MoneyType = $request->MoneyType;


        $Site->MoneyType = $request->MoneyType;

        if ($request->visitorRegistrationVideo) {
            $Site->visitorRegistrationVideo = preg_match('/.*embed.*/', $request->visitorRegistrationVideo) ? $request->visitorRegistrationVideo : preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "https://www.youtube.com/embed/$1", $request->visitorRegistrationVideo);
        }
        $Site->visitorRegistrationPDF = $request->hasFile('visitorRegistrationPDF') ? $this->S3Doc($request, 'visitorRegistrationPDF') : $Site->visitorRegistrationPDF;
        if ($request->visitorPanelVideo){
            $Site->visitorPanelVideo = preg_match('/.*embed.*/', $request->visitorPanelVideo) ? $request->visitorPanelVideo : preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "https://www.youtube.com/embed/$1", $request->visitorPanelVideo);
        }
        $Site->visitorPanelPDF = $request->hasFile('visitorPanelPDF') ? $this->S3Doc($request, 'visitorPanelPDF') : $Site->visitorPanelPDF;

        $Site->save();
        Alert::success('Settings Saved Successful');

        return redirect()->back();

    }


    public function ExhibitorSetting()
    {
        $newMessage = $this->hasanChatCount();
        $this->onlineShow();
        $Site = Site::find(1);
        return view('Admin.ExhibitorSetting')->with(['Site' => $Site,'newMessage'=>$newMessage]);
    }

    public function ExhibitorSettingPost(Request $request)
    {
        $request->validate([
            'ExhibitorBackGround' => 'image',
            'ExhibitorWelcome' => 'string|nullable',
            'ExhibitorAbout' => 'string|nullable',
            'ExhibitorAboutPayment' => 'string|nullable',
            'ExhibitorPayment' => 'integer|nullable',
            'ExhibitorMaximumOperator' => 'required|integer',
            'MoneyType' => 'nullable',
        ]);
        $Site = Site::find(1);
        $Site->ExhibitorBackGround = $request->hasFile('ExhibitorBackGround') ? $this->S3Setting($request, 'ExhibitorBackGround') : $Site->ExhibitorBackGround;
        $Site->ExhibitorWelcome = $request->ExhibitorWelcome;
        $Site->ExhibitorAbout = $request->ExhibitorAbout;
        $Site->ExhibitorAboutPayment = $request->ExhibitorAboutPayment;
        $Site->ExhibitorPayment = $request->ExhibitorPayment;
        $Site->ExhibitorMaximumOperator = $request->ExhibitorMaximumOperator;
        $Site->MoneyType = $request->MoneyType;

        if ($request->exRegistrationVideo) {
            $Site->exRegistrationVideo = preg_match('/.*embed.*/', $request->exRegistrationVideo) ? $request->exRegistrationVideo : preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "https://www.youtube.com/embed/$1", $request->exRegistrationVideo);
        }
        $Site->exRegistrationPDF = $request->hasFile('exRegistrationPDF') ? $this->S3Doc($request, 'exRegistrationPDF') : $Site->exRegistrationPDF;
        if ($request->exPanelVideo){
            $Site->exPanelVideo = preg_match('/.*embed.*/', $request->exPanelVideo) ? $request->exPanelVideo : preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "https://www.youtube.com/embed/$1", $request->exPanelVideo);
        }
        $Site->exPanelPDF = $request->hasFile('exPanelPDF') ? $this->S3Doc($request, 'exPanelPDF') : $Site->exPanelPDF;

        $Site->save();
        Alert::success('Settings Saved Successful');

        return redirect()->back();

    }


    public function AppAdjustment()
    {
        $newMessage = $this->hasanChatCount();
        $this->onlineShow();
        return view('Admin.AppAdjustment',compact("newMessage"));
    }

    public function AppAdjustmentPost(Request $request)
    {


        $request->validate([
            'Main1' => 'image',
            'Main2' => 'image',
            'Main3' => 'image',
            'Main4' => 'image',
            'Main5' => 'image',
            'Main6' => 'image',
            'Loby1' => 'image',
            'Loby2' => 'image',
            'Loby3' => 'image',
            'Loby4' => 'image',
            'Panposter1' => 'image',
            'Panposter2' => 'image',
            'Panposter3' => 'image',
            'Auditorium1' => 'image',
            'Auditorium2' => 'image',
            'Lounge1' => 'image',
            'Lounge2' => 'image',
            'Wallposter1' => 'image',
            'Wallposter2' => 'image',
            'Wallposter3' => 'image',
            'Wallposter4' => 'image',
            'Wallposter5' => 'image',
            'Wallposter6' => 'image',
            'Wallposter7' => 'image',
            'Wallposter8' => 'image',
            'Billboard1' => 'image',
            'Billboard2' => 'image',
            'Billboard3' => 'image',
            'Billboard4' => 'image',
            'Billboard5' => 'image',
            'Billboard6' => 'image',
            'Stand1' => 'image',
            'Stand2' => 'image',
            'Stand3' => 'image',
            'Stand4' => 'image',
            'Stand5' => 'image',
            'Stand6' => 'image',
            'Stand7' => 'image',
            'Rotationposter1' => 'image',
            'Rotationposter2' => 'image',
            'Rotationposter3' => 'image',
            'Rotationposter4' => 'image',
            'Rotationposter5' => 'image',
            'Rotationposter6' => 'image',
            'Rotationposter7' => 'image',
            'Rotationposter8' => 'image',
            'Rotationposter9' => 'image',
            'Rotationposter10' => 'image',
            'Rotationposter11' => 'image',
            'Rotationposter12' => 'image',
            'Rotationposter13' => 'image',
            'Rotationposter14' => 'image',
            'Rotationposter15' => 'image',
            'Rotationposter16' => 'image',
            'Rotationposter17' => 'image',
            'Rotationposter18' => 'image',
            'Rotationposter19' => 'image',
            'Rotationposter20' => 'image',
            'Rotationposter21' => 'image',
            'Rotationposter22' => 'image',
            'Rotationposter23' => 'image',
            'Rotationposter24' => 'image',
            'welcomeVideo' => 'string|nullable'
        ]);

        $Hall = Hall::find(1);




        $Hall->Main1 = $request->hasFile('Main1') ? $this->S3Hasan($request, 'Main1') : $Hall->Main1;
        $Hall->Main2 = $request->hasFile('Main2') ? $this->S3Hasan($request, 'Main2') : $Hall->Main2;
        $Hall->Main3 = $request->hasFile('Main3') ? $this->S3Hasan($request, 'Main3') : $Hall->Main3;
        $Hall->Main4 = $request->hasFile('Main4') ? $this->S3Hasan($request, 'Main4') : $Hall->Main4;
        $Hall->Main5 = $request->hasFile('Main5') ? $this->S3Hasan($request, 'Main5') : $Hall->Main5;
        $Hall->Main6 = $request->hasFile('Main6') ? $this->S3Hasan($request, 'Main6') : $Hall->Main6;
        $Hall->Loby1 = $request->hasFile('Loby1') ? $this->S3Hasan($request, 'Loby1') : $Hall->Loby1;
        $Hall->Loby2 = $request->hasFile('Loby2') ? $this->S3Hasan($request, 'Loby2') : $Hall->Loby2;
        $Hall->Loby3 = $request->hasFile('Loby3') ? $this->S3Hasan($request, 'Loby3') : $Hall->Loby3;
        $Hall->Loby4 = $request->hasFile('Loby4') ? $this->S3Hasan($request, 'Loby4') : $Hall->Loby4;
        $Hall->Auditorium1 = $request->hasFile('Auditorium1') ? $this->S3Hasan($request, 'Auditorium1') : $Hall->Auditorium1;
        $Hall->Auditorium2 = $request->hasFile('Auditorium2') ? $this->S3Hasan($request, 'Auditorium2') : $Hall->Auditorium2;
        $Hall->Lounge1 = $request->hasFile('Lounge1') ? $this->S3Hasan($request, 'Lounge1') : $Hall->Lounge1;
        $Hall->Lounge2 = $request->hasFile('Lounge2') ? $this->S3Hasan($request, 'Lounge2') : $Hall->Lounge2;
        $Hall->Wallposter1 = $request->hasFile('Wallposter1') ? $this->S3Hasan($request, 'Wallposter1') : $Hall->Wallposter1;
        $Hall->Wallposter2 = $request->hasFile('Wallposter2') ? $this->S3Hasan($request, 'Wallposter2') : $Hall->Wallposter2;
        $Hall->Wallposter3 = $request->hasFile('Wallposter3') ? $this->S3Hasan($request, 'Wallposter3') : $Hall->Wallposter3;
        $Hall->Wallposter4 = $request->hasFile('Wallposter4') ? $this->S3Hasan($request, 'Wallposter4') : $Hall->Wallposter4;
        $Hall->Wallposter5 = $request->hasFile('Wallposter5') ? $this->S3Hasan($request, 'Wallposter5') : $Hall->Wallposter5;
        $Hall->Wallposter6 = $request->hasFile('Wallposter6') ? $this->S3Hasan($request, 'Wallposter6') : $Hall->Wallposter6;
        $Hall->Wallposter7 = $request->hasFile('Wallposter7') ? $this->S3Hasan($request, 'Wallposter7') : $Hall->Wallposter7;
        $Hall->Wallposter8 = $request->hasFile('Wallposter8') ? $this->S3Hasan($request, 'Wallposter8') : $Hall->Wallposter8;
        $Hall->Billboard1 = $request->hasFile('Billboard1') ? $this->S3Hasan($request, 'Billboard1') : $Hall->Billboard1;
        $Hall->Billboard2 = $request->hasFile('Billboard2') ? $this->S3Hasan($request, 'Billboard2') : $Hall->Billboard2;
        $Hall->Billboard3 = $request->hasFile('Billboard3') ? $this->S3Hasan($request, 'Billboard3') : $Hall->Billboard3;
        $Hall->Billboard4 = $request->hasFile('Billboard4') ? $this->S3Hasan($request, 'Billboard4') : $Hall->Billboard4;
        $Hall->Billboard5 = $request->hasFile('Billboard5') ? $this->S3Hasan($request, 'Billboard5') : $Hall->Billboard5;
        $Hall->Billboard6 = $request->hasFile('Billboard6') ? $this->S3Hasan($request, 'Billboard6') : $Hall->Billboard6;
        $Hall->Stand1 = $request->hasFile('Stand1') ? $this->S3Hasan($request, 'Stand1') : $Hall->Stand1;
        $Hall->Stand2 = $request->hasFile('Stand2') ? $this->S3Hasan($request, 'Stand2') : $Hall->Stand2;
        $Hall->Stand3 = $request->hasFile('Stand3') ? $this->S3Hasan($request, 'Stand3') : $Hall->Stand3;
        $Hall->Stand4 = $request->hasFile('Stand4') ? $this->S3Hasan($request, 'Stand4') : $Hall->Stand4;
        $Hall->Stand5 = $request->hasFile('Stand5') ? $this->S3Hasan($request, 'Stand5') : $Hall->Stand5;
        $Hall->Stand6 = $request->hasFile('Stand6') ? $this->S3Hasan($request, 'Stand6') : $Hall->Stand6;
        $Hall->Stand7 = $request->hasFile('Stand7') ? $this->S3Hasan($request, 'Stand7') : $Hall->Stand7;
        $Hall->Panposter1 = $request->hasFile('Panposter1') ? $this->S3Hasan($request, 'Panposter1') : $Hall->Panposter1;
        $Hall->Panposter2 = $request->hasFile('Panposter2') ? $this->S3Hasan($request, 'Panposter2') : $Hall->Panposter2;
        $Hall->Panposter3 = $request->hasFile('Panposter3') ? $this->S3Hasan($request, 'Panposter3') : $Hall->Panposter3;
        $Hall->Rotationposter1 = $request->hasFile('Rotationposter1') ? $this->S3Hasan($request, 'Rotationposter1') : $Hall->Rotationposter1;
        $Hall->Rotationposter2 = $request->hasFile('Rotationposter2') ? $this->S3Hasan($request, 'Rotationposter2') : $Hall->Rotationposter2;
        $Hall->Rotationposter3 = $request->hasFile('Rotationposter3') ? $this->S3Hasan($request, 'Rotationposter3') : $Hall->Rotationposter3;
        $Hall->Rotationposter4 = $request->hasFile('Rotationposter4') ? $this->S3Hasan($request, 'Rotationposter4') : $Hall->Rotationposter4;
        $Hall->Rotationposter5 = $request->hasFile('Rotationposter5') ? $this->S3Hasan($request, 'Rotationposter5') : $Hall->Rotationposter5;
        $Hall->Rotationposter6 = $request->hasFile('Rotationposter6') ? $this->S3Hasan($request, 'Rotationposter6') : $Hall->Rotationposter6;
        $Hall->Rotationposter7 = $request->hasFile('Rotationposter7') ? $this->S3Hasan($request, 'Rotationposter7') : $Hall->Rotationposter7;
        $Hall->Rotationposter8 = $request->hasFile('Rotationposter8') ? $this->S3Hasan($request, 'Rotationposter8') : $Hall->Rotationposter8;
        $Hall->Rotationposter9 = $request->hasFile('Rotationposter9') ? $this->S3Hasan($request, 'Rotationposter9') : $Hall->Rotationposter9;
        $Hall->Rotationposter10 = $request->hasFile('Rotationposter10') ? $this->S3Hasan($request, 'Rotationposter10') : $Hall->Rotationposter10;
        $Hall->Rotationposter11 = $request->hasFile('Rotationposter11') ? $this->S3Hasan($request, 'Rotationposter11') : $Hall->Rotationposter11;
        $Hall->Rotationposter12 = $request->hasFile('Rotationposter12') ? $this->S3Hasan($request, 'Rotationposter12') : $Hall->Rotationposter12;
        $Hall->Rotationposter13 = $request->hasFile('Rotationposter13') ? $this->S3Hasan($request, 'Rotationposter13') : $Hall->Rotationposter13;
        $Hall->Rotationposter14 = $request->hasFile('Rotationposter14') ? $this->S3Hasan($request, 'Rotationposter14') : $Hall->Rotationposter14;
        $Hall->Rotationposter15 = $request->hasFile('Rotationposter15') ? $this->S3Hasan($request, 'Rotationposter15') : $Hall->Rotationposter15;
        $Hall->Rotationposter16 = $request->hasFile('Rotationposter16') ? $this->S3Hasan($request, 'Rotationposter16') : $Hall->Rotationposter16;
        $Hall->Rotationposter17 = $request->hasFile('Rotationposter17') ? $this->S3Hasan($request, 'Rotationposter17') : $Hall->Rotationposter17;
        $Hall->Rotationposter18 = $request->hasFile('Rotationposter18') ? $this->S3Hasan($request, 'Rotationposter18') : $Hall->Rotationposter18;
        $Hall->Rotationposter19 = $request->hasFile('Rotationposter19') ? $this->S3Hasan($request, 'Rotationposter19') : $Hall->Rotationposter19;
        $Hall->Rotationposter20 = $request->hasFile('Rotationposter20') ? $this->S3Hasan($request, 'Rotationposter20') : $Hall->Rotationposter20;
        $Hall->Rotationposter21 = $request->hasFile('Rotationposter21') ? $this->S3Hasan($request, 'Rotationposter21') : $Hall->Rotationposter21;
        $Hall->Rotationposter22 = $request->hasFile('Rotationposter22') ? $this->S3Hasan($request, 'Rotationposter22') : $Hall->Rotationposter22;
        $Hall->Rotationposter23 = $request->hasFile('Rotationposter23') ? $this->S3Hasan($request, 'Rotationposter23') : $Hall->Rotationposter23;
        $Hall->Rotationposter24 = $request->hasFile('Rotationposter24') ? $this->S3Hasan($request, 'Rotationposter24') : $Hall->Rotationposter24;
        if ($request->welcomeVideo) {
            $Hall->welcomeVideo = preg_match('/.*embed.*/', $request->welcomeVideo) ? $request->welcomeVideo : preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "https://www.youtube.com/embed/$1", $request->welcomeVideo);
        }

        $Hall->lobyLink1 = $request->lobyLink1;
        $Hall->lobyLink2 = $request->lobyLink2;
        $Hall->lobyLink3 = $request->lobyLink3;
        $Hall->lobyLink4 = $request->lobyLink4;

        $Hall->save();
        Alert::success('Images Saved Successful');
        return redirect()->back();
    }

    public function SuspendUser($UserID)
    {
        $User = User::find($UserID);

        if (\request()->has('AccountStatus')) {
            $User->AccountStatus = 'Suspend';
            $User->ChatMode = 'Busy';
        } else {
            $User->AccountStatus = 'Active';
        }
        $User->save();
        Alert::success('User Suspended Successful');

        return redirect()->back();
    }

    public function SuspendUserWithUrl($UserID)
    {
        $User = User::find($UserID);

        if ($User->AccountStatus == 'Active') {
            $User->AccountStatus = 'Suspend';
            $User->ChatMode = 'Busy';

        } else {
            $User->AccountStatus = 'Active';
        }
        $User->save();
        return redirect()->back();
    }

    public function SuspendBooth($BoothID)
    {
        $Booth = booth::find($BoothID);
        $User = User::find($Booth->UserID);

        if (\request()->has('BoothStatus')) {
            $User->AccountStatus = 'Active';

            if ($User->email_verified_at == null) {
                $User->sendEmailVerificationNotification();
            }
        } else {
            $User->AccountStatus = 'Suspend';
            Mail::to($User->email)->send(new SuspendExhibitor($User));
        }
        $User->save();
        Alert::success('User Changed Successful');

        return redirect()->back();
    }

    public function Organizers()
    {
        $newMessage = $this->hasanChatCount();
        $this->onlineShow();
        $Organizers=Organizer::all();
        $OrganizerID=null;
        $Organizer=null;
        if (\request("OrganizerID")) {
            $OrganizerID = \request("OrganizerID");

        }
        return view("Admin.OrganizersInformation",compact("Organizers","OrganizerID","newMessage"));
    }

    public function OrganizersPost(Request $request)
    {

        $request->validate([
            "firstname"=>"string|required",
            "surname"=>"string|required",
            "phoneNumber"=>"string|required",
            "email"=>"string|required|unique:organizers",

        ]);

        Organizer::create([
            "firstname"=>$request->firstname,
            "surname"=>$request->surname,
            "phoneNumber"=>$request->phoneNumber,
            "email"=>$request->email,
            "profile"=>$request->hasFile('profile') ? $this->S3Hasan($request, 'profile') : null

        ]);

        Alert::success('You Add Your Organizer Successfully');
        return redirect()->back();

    }

    public function DeleteOrganizer($id)
    {
        $Organizer = Organizer::find($id);
        $Organizer->delete();
        Alert::success('Organizer Delete Successfully');
        return redirect(route("Admin.Organizers"));
    }


    public function AddRecord()
    {
        return view("Admin.AddRecordConference");
    }

    public function VisitorInbox(Request $request)
    {

        if ($request->ajax()) {
            if ($request->SearchTermUser)
                $users_list = User::select("id", "UserName")->where('UserName', 'LIKE', '%' . \request()->SearchTermUser . '%')->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->get();
            else
                $users_list = User::whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->where('id', '!=', \request()->UserID)->orderBy("newmessage","Desc")->where("newmessage","!=",0)->get();
                $users_list_view = view('user-list-data', compact('users_list'))->render();
            return response()->json(['users_list' => $users_list_view]);

        }


        if (\request()->UserID) {
            $user = User::where("id",\request()->UserID)->first();
            $user->newmessage = 0 ;
            $user->save();

            $Chats = AdminChat::where('UserID', Auth::id())->where("Status","New")->where('ReceiverID', \request()->UserID)->get();
            $Chatsssss = AdminChat::where([
                ['ReceiverID', \request()->UserID],
                ['Status', 'New'],
                ['Sender','Visitor']
            ])->get()
            ;
            foreach ($Chatsssss as $chatsssss) {
                $chatsssss->Status = 'Viewed';
                $chatsssss->save();
            }


//            $users_list = User::where('Rule', 'Visitor')->orderBy("newmessage")->paginate(10);
            $users_list = User::whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->where('id', '!=', \request()->UserID)->where("newmessage","!=",0)->orderBy("newmessage","Desc")->paginate(10);
            $selected_user = User::select("id", "UserName")->where("id", \request()->UserID)->first();


            $collection = collect();

            $collection->push($selected_user);


            foreach ($users_list as $ul)
                $collection->push($ul);

            $users_list = $collection;


        } else {

            if (\request()->SearchTermUser) {

                $users_list = User::where('UserName', 'LIKE', '%' . \request()->SearchTermUser . '%')->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->get(["id", "UserName"]);


            } else {
                $users_list = User::whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->where('id', '!=', \request()->UserID)->where("newmessage","!=",0)->orderBy("newmessage","Desc")->get();

            }


        }


        if (isset($Chats))

            return view('Admin.visitorInbox', compact( 'users_list', 'Chats'));
        else
            return view('Admin.visitorInbox', compact( 'users_list'));
    }


    public function ExhibitorInbox(Request $request)
    {

        if ($request->ajax()) {
            if ($request->SearchTermBooth)
                $booth_list = booth::select('id', "UserID", "CompanyName")->where('CompanyName', 'LIKE', '%' . \request()->SearchTermBooth . '%')->paginate(10);
            else
                $booth_list = booth::select('id', "UserID", "CompanyName")->where("newmessage","!=",0)->orderBy("newmessage","Desc")->get();
            $booth_list_view = view('company-list-data', compact('booth_list'))->render();

            return response()->json(['booth_list' => $booth_list_view]);

        }


        if (\request()->CompanyID) {
            $ID = booth::find(\request()->CompanyID)->UserID;
            $Chats = AdminChat::where('UserID', Auth::id())->where('ReceiverID', $ID)->get();
            $Chatsssss = AdminChat::where([
                ['ReceiverID', $ID],
                ['Status', 'New'],
                ['Sender','!=','Admin']
            ])->get();
            foreach ($Chatsssss as $ch) {

                $ch->Status = 'Viewed';

                $ch->save();
            }

            $selected_booth = booth::select('id', "UserID", "CompanyName")->where("id", \request()->CompanyID)->first();
            $booth_list = booth::select('id', "UserID", "CompanyName")->where("id", "!=", \request()->CompanyID)->where("newmessage","!=",0)->orderBy("newmessage","Desc")->get();


            $collection = collect();

            $collection->push($selected_booth);


            foreach ($booth_list as $bl)
                $collection->push($bl);

            $booth_list = $collection;


        } else {

            if (\request()->SearchTermBooth) {
                $booth_list = booth::where('CompanyName', 'LIKE', '%' . \request()->SearchTermBooth . '%')->get(['id', "UserID", "CompanyName"]);
            } else {
                $booth_list = booth::select('id', "UserID", "CompanyName")->where("newmessage","!=",0)->orderBy("newmessage","Desc")->get();

            }

        }




        if (isset($Chats))

            return view('Admin.exhibitorInbox', compact('booth_list', 'Chats'));
        else
            return view('Admin.exhibitorInbox', compact('booth_list'));
    }

    public function SuspendUncompletedBooths()
    {
        $booths=booth::where("Poster1",null)->orWhere("Poster2",null)->orWhere("Poster3",null)->get();
        foreach ($booths as $booth){

            Mail::to(User::where("id",$booth->UserID)->first()->email)->send(new SuspendExhibitor($booth));

            User::where("id",$booth->UserID)->update([
                "AccountStatus"=>"Suspend"
            ]);
        }

        Alert::success('All Companies without Posters Suspended');
        return redirect()->back();

    }

    public function ReminderEmail()
    {
        $users=User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new Reminder($user));
        }

        Alert::success("Reminder Emails Sent To All Users");
        return redirect()->back();
    }

    public function ThanksEmail()
    {
        $booths=booth::all();
        foreach ($booths as $booth) {
            $boothEmail=User::find($booth->UserID)->email;
            Mail::to($boothEmail)->send(new thanks($booth));
        }

        Alert::success("Thanks Emails Sent To All Exhibitors");
        return redirect()->back();
    }

    public function ExhibitorsFeedbacksEmail()
    {
        $booths=booth::all();
        foreach ($booths as $booth) {
            $boothEmail=User::find($booth->UserID)->email;
            $boothUser=User::find($booth->UserID);
            Mail::to($boothEmail)->send(new ExhibitorFeedback($boothUser));
        }

        Alert::success("Feedbacks Emails Sent To All Exhibitors");
        return redirect()->back();
    }

    public function SendExhibitorsFeedback()
    {
        $user=User::where("password",\request("token"))->first();
        $Company=booth::where("UserID",$user->id)->first();
        if ($Company == null || empty($Company)) {
            abort(404);
        }
        return view("SendExhibitorsFeedback",compact("Company"));
    }

    public function ShowOnlines()
    {
        $site=Site::find(1);
        if ($site->onlinesCountStatus == 0) {
            $site->onlinesCountStatus = 1;
            $site->save();
            Alert::success("Online Users Count Showable now");


        }else{
            $site->onlinesCountStatus = 0;
            $site->save();
            Alert::success("Online Users Count Disable Showing now");
        }


        return redirect()->back();

    }

    public function ExhibitorForm()
    {
        $newMessage = $this->hasanChatCount();
        return view("Admin.FormExhibitor",compact("newMessage"));
    }

    public function ExhibitorFormPost(Request $request){

        ExhibitorForms::whereId(1)->update([
            "firstName"=>$request->firstName,
            "lastName"=>$request->lastName,
            "position"=>$request->position,
            "companyAddress"=>$request->companyAddress,
            "city"=>$request->city,
            "zipCode"=>$request->zipCode,
            "country"=>$request->country,
            "website"=>$request->website,
            "mainCompany"=>$request->mainCompany,
            "institution"=>$request->institution,
            "institutionEmail"=>$request->institutionEmail,
            "phone"=>$request->phone,
            "mob"=>$request->mob,
            "fax"=>$request->fax,
            "institutionItems"=>$request->institutionItems,
        ]);

        Site::whereId(1)->update([
            "VisitorGender"=>$request->VisitorGender
        ]);

        Alert::success("Your Changes Successfully Saved");
        return redirect()->back();
    }


    public function VisitorForm()
    {
        $newMessage = $this->hasanChatCount();
        return view("Admin.FormVisitor",compact("newMessage"));
    }

    public function VisitorFormPost(Request $request)
    {





        VisitorForm::whereId(1)->update([
            "education"=>$request->education,
            "countryStudy"=>$request->countryStudy,
            "InterestedDegree"=>$request->InterestedDegree,
            "InterestedField"=>$request->InterestedField,
            "languageOfStudy"=>$request->languageOfStudy,
            "onlineDegreeProgram"=>$request->onlineDegreeProgram,
            "interestedScholarShip"=>$request->interestedScholarShip,
            "educationItems"=>$request->educationItems,
            "interestedDegreeItems"=>$request->interestedDegreeItems,
            "interestedFieldItems"=>$request->interestedFieldItems,
            "gender"=>$request->gender,
            "cityItems"=>$request->cityItems,
            "countryInterestedItems"=>$request->countryInterestedItems,
            "onlineDegreeProgramsItems"=>$request->onlineDegreeProgramsItems,
            "admissionSemesterItems"=>$request->admissionSemesterItems,
            "professionInterestedItems"=>$request->professionInterestedItems,
            "profileItems"=>$request->profileItems,
            "studentStatus"=>$request->studentStatus,
            "jobSeekerStatus"=>$request->jobSeekerStatus,
            "companyStatus"=>$request->companyStatus

        ]);




        Site::whereId(1)->update([
            "VisitorProfession" => $request->VisitorProfession,
            "VisitorGender" => $request->VisitorGender
        ]);

        Alert::success("Your Changes Successfully Saved");
        return redirect()->back();
    }




    public static function onlineShow()
    {
        $onlines=0;
        $users_online=User::all();

        foreach ($users_online as $user_online) {
            if ($user_online->isOnline()){
                $onlines++;
                User::where("id",$user_online->id)->update(["userStatus"=>1]);
                Site::where("id",1)->update(["onlinesCount"=>$onlines]);
            }else{
                User::where("id",$user_online->id)->update(["userStatus"=>0]);
            }
        }
        return $onlines;
    }


    public function onlineAjax()
    {
        $onlines=0;
        $users_online=User::all();

        foreach ($users_online as $user_online) {
            if ($user_online->isOnline()){
                $onlines++;
                User::where("id",$user_online->id)->update(["userStatus"=>1]);
                Site::where("id",1)->update(["onlinesCount"=>$onlines]);
            }else{
                User::where("id",$user_online->id)->update(["userStatus"=>0]);
            }
        }
        return response()->json([
            "onlines" => $onlines
        ]);
    }


}
