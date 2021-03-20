<?php

namespace App\Http\Controllers;

use App\AdminChat;
use App\booth;
use App\Chat;
use App\Lounge;
use App\LoungeChat;
use App\Statistics;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminOperatorController extends Controller
{



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

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->SearchTermBooth)
                $booth_list = booth::select('id', "UserID", "CompanyName")->where('CompanyName', 'LIKE', '%' . \request()->SearchTermBooth . '%')->paginate(10);
            else
                $booth_list = booth::select('id', "UserID", "CompanyName")->paginate(10);
            $booth_list_view = view('company-list-data', compact('booth_list'))->render();

            if ($request->SearchTermUser)
                $users_list = User::select("id", "UserName")->where('UserName', 'LIKE', '%' . \request()->SearchTermUser . '%')->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->paginate(10);
            else
                $users_list = User::select("id", "UserName")->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->paginate(10);
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
            $booth_list = booth::select('id', "UserID", "CompanyName")->where("id", "!=", \request()->CompanyID)->paginate(10);


            $collection = collect();

            $collection->push($selected_booth);


            foreach ($booth_list as $bl)
                $collection->push($bl);

            $booth_list = $collection;


        } else {

            if (\request()->SearchTermBooth) {
                $booth_list = booth::where('CompanyName', 'LIKE', '%' . \request()->SearchTermBooth . '%')->get(['id', "UserID", "CompanyName"]);
            } else {
                $booth_list = booth::select('id', "UserID", "CompanyName")->paginate(10);

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


            $users_list = User::select("id", "UserName")->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->where('id', '!=', \request()->UserID)->paginate(10);
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
                $users_list = User::select("id", "UserName")->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->paginate(10);

            }


        }


        if (isset($Chats))

            return view('Admin-Operator.index', compact('booth_list', 'users_list', 'Chats'));
        else
            return view('Admin-Operator.index', compact('booth_list', 'users_list'));

    }

    public function ChatGet(Request $request){
        $request->validate([
            'Mode' => ['required'],
            'ID' => ['required'],
            'UserID' => ['required'],
        ]);
        if ($request->Mode == 'Company') {
            $ID = booth::find($request->ID)->UserID;
        }else{
            $ID = $request->ID;
        }
        $Chats = AdminChat::where('UserID', $request->UserID)->where('ReceiverID', $ID)->get();
        return response()->json([
            'Chat' => $Chats
        ],200);
    }

    public function ChangeChatStatus(Request $request)
    {
        if ($request->ID && $request->UserID) {
            $Chatsssss = AdminChat::where('UserID', $request->UserID)->where('ReceiverID', $request->ID)->get();

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




    public function CompanyList(){
        if (\request()->SearchTermBooth) {
            $Booths = booth::where('CompanyName', 'LIKE', '%' . \request()->SearchTermBooth . '%')->get();
        }else{
            $Booths = booth::all();
        }
        return response()->json([
            'Booths' => $Booths
        ],200);
    }

    public static function ChatCount($id){

        if (\request()->id) {
            return AdminChat::where('ReceiverID' , \request()->id)->where('Status' , 'New')->count();
        }
        $Count = AdminChat::where([
            ['UserID', $id],
            ['Status', 'New'],
        ])->count();
        if ($Count > 0) {
            return $Count;
        }else{
            return 0;
        }

    }


    public function UserList(){
        if (\request()->SearchTermUser) {
            $User = User::where('UserName', 'LIKE', '%' . \request()->SearchTermUser . '%')->whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->get();
        } else {
            $User = User::whereIn('Rule', ['Visitor', 'Exhibitor-Operator'])->get();
        }
        return response()->json([
            'Users' => $User
        ],200);
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
        }else{
            $ID = $request->ID;
        }
        AdminChat::create([
            'Text' => $request->Text,
            'UserID' => $request->UserID,
            'ReceiverID' => $ID,
            'Sender' => 'Admin',
            'Status' => 'Viewed'
        ]);
        $Chats = AdminChat::where('ReceiverID' , $ID)->get();
        return response()->json([
            'Chat' => $Chats
        ],200);
    }


    public function History(){
        if (\request()->SearchTermBooth) {
            $Booths = booth::where('CompanyName', 'LIKE', '%' . \request()->SearchTermBooth . '%')->get();
        } else {
            $Booths = booth::all();
        }
        if (\request()->SearchTermUser) {
            $User = User::where('UserName', 'LIKE', '%' . \request()->SearchTermUser . '%')->whereIn('Rule' , ['Visitor' , 'Exhibitor-Operator'])->get();
        } else {
            $User = User::whereIn('Rule' , ['Visitor' , 'Exhibitor-Operator'])->get();
        }

        if (\request()->CompanyID) {
            $ID = booth::find(\request()->CompanyID)->UserID ;
            $Chats = AdminChat::where('UserID', Auth::id())->where('ReceiverID', $ID)->get();
            return view('Admin-Operator.History')->with(['Booths' => $Booths, 'Chats' => $Chats, 'Users' => $User]);
        }
        if (\request()->UserID) {
            $Chats = AdminChat::where('UserID', Auth::id())->where('ReceiverID', \request()->UserID)->get();
            return view('Admin-Operator.History')->with(['Booths' => $Booths, 'Chats' => $Chats, 'Users' => $User]);
        }

        return view('Admin-Operator.History')->with(['Booths' => $Booths, 'Users' => $User]);
    }

    public function Lounge(){
        $Lounges = Lounge::all();
        if (\request()->LoungID) {
            $Lounge = Lounge::find(\request()->LoungID);
            $Chats = LoungeChat::where('LoungeID', \request()->LoungID)->get();
            return view('Admin-Operator.Lounge')->with(['Lounges' => $Lounges, 'Lounge' => $Lounge, 'Chats' => $Chats]);
        }
        if (\request()->RemoveUser) {
            $Lounge = Lounge::find(\request()->LoungeID);
            $Members = json_decode($Lounge->Members);
            if (($key = array_search(\request()->RemoveUser, $Members)) !== false) {
                unset($Members[$key]);
            }
            $Lounge->Members = $Members;
            $Lounge->save();
            return redirect()->back();
        }
        return view('Admin-Operator.Lounge')->with(['Lounges' => $Lounges]);
    }


    public function UserPaid(Request $request){
        $User = User::find($request->UserID);

        if ($User->Payment == 'Paid'){
            $User->Payment = 'UnPaid';
            $User->AccountStatus = 'Suspend';
        }else{
            $User->Payment = 'Paid';
            $User->AccountStatus = 'Active';
        }
        $User->save();
        Alert::success('Changes Saved');
        return redirect()->back();
    }

    public function Statistics(){
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
        return view('Admin-Operator.statistics')->with([
            'Company' => $Company,
            'Gender' => $Gender,
            'Profession' => $Profession,
            'Date' => $Date,
            'AllCompany' => $AllCompany,
            'AllGroups' => $AllGroups
        ]);
    }


    public function RegisteredVisitor()
    {
        if (\request()->SearchTerm) {
            $Users = User::where('Rule', 'Visitor')->where('UserName', 'LIKE', '%' . \request()->SearchTerm . '%')->get();

        } else {
            $Users = User::where('Rule', 'Visitor')->get();
        }
        if (\request()->UserID) {
            $User = User::find(\request()->UserID);
            return view('Admin-Operator.visitors')->with(['Users' => $Users, 'User' => $User]);

        }
        return view('Admin-Operator.visitors')->with(['Users' => $Users]);
    }

    public function RegisteredExhibitor()
    {
        if (\request()->SearchTerm) {
            $Booths = booth::where('CompanyName', 'LIKE', '%' . \request()->SearchTerm . '%')->get();

        } else {
            $Booths = booth::all();
        }
        if (\request()->BoothID) {
            $Booth = booth::find(\request()->BoothID);
            return view('Admin-Operator.exhibitors')->with(['Booths' => $Booths, 'Booth' => $Booth]);
        }
        return view('Admin-Operator.exhibitors')->with(['Booths' => $Booths]);
    }


    public function Setting(){
        return view('Admin-Operator.Setting');
    }

    public function SettingPost(Request $request)
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







    public function SuspendUser($UserID)
    {
        $User = User::find($UserID);

        if (\request()->has('AccountStatus')) {
            $User->AccountStatus = 'Suspend';
        } else {
            $User->AccountStatus = 'Active';
        }
        $User->save();
        return redirect()->back();
    }

    public function SuspendUserWithUrl($UserID)
    {
        $User = User::find($UserID);

        if ($User->AccountStatus == 'Active') {
            $User->AccountStatus = 'Suspend';
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
        }
        $User->save();
        Alert::success('User Changed Successful');

        return redirect()->back();
    }


//    public function SuspendBooth($BoothID)
//    {
//        $Booth = booth::find($BoothID);
//
//        if (\request()->has('BoothStatus')) {
//            $Booth->Status = 'Active';
//        } else {
//            $Booth->Status = 'DeActive';
//        }
//        $Booth->save();
//        return redirect()->back();
//    }
}