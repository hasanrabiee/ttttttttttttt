<?php

namespace App\Http\Controllers;

use App\AdminChat;
use App\booth;
use App\Chat;
use App\Statistics;
use App\Traits\Uploader;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ExhibitorOperatorController extends Controller
{

    public function __construct()
    {
        $this->middleware('verified');
    }


    use Uploader;


    public function Booth()
    {
        return booth::find(Auth::user()->CompanyID);
    }

    public function index()
    {
        $newMessage = $this->hasanChatCount();
        return view('Exhibitor-Operator.index')->with(['Booth' => $this->Booth(),'newMessage'=>$newMessage]);
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
            $CHatsssss = Chat::where('BoothID', $request->BoothID)->where('UserID', $request->UserID)->where('Sender','Visitor')->get();
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


    public function InboxPost(Request $request){
        if (Chat::where('BoothID' , $request->BoothID)->where('UserID' , $request->UserID)->get()[0]->Owner != null){
            $Owner = Chat::where('BoothID' , $request->BoothID)->where('UserID' , $request->UserID)->first()->Owner;
        }else{
            $Owner = Auth::id();
        }
        $request->validate([
            'Text' => 'required|string',
            'UserID' => 'required|integer'
        ]);

        Chat::create([
            'UserID' => $request->UserID,
            'BoothID' => $request->BoothID,
            'Text' => $request->Text,
            'Sender' => 'Exhibitor',
            'Owner' => $Owner,
            'Status'=>'New'

        ]);
    }

    public function InboxGet(Request $request){
        $request->validate([
            'UserID' => 'required'
        ]);
        $Chat = Chat::where('BoothID', $request->BoothID)->where('UserID', $request->UserID)->get();
        return response()->json([
            'Chat' => $Chat
        ],200);


    }


    public function Inbox(Request $request)
    {





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





        $boothID = User::where("id",\auth()->user()->id)->first()->CompanyID;
        $Booth =booth::where("id",$boothID)->first();
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
            $users_list_view = view('Exhibitor-Operator.user-list-data', compact('Users' , 'Booth'))->render();


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
            return view('Exhibitor-Operator.Inbox')->with(['Booth' => $Booth, 'Users' => $Users, 'Chat' => $Chat]);
        }




        if (\request()->SearchTerm) {
            $UsersAll = User::where('UserName', 'LIKE', '%' . \request()->SearchTerm . '%')->get();
            foreach ($UsersAll as $user) {
                $Users[] = User::find($user->id);
            }
        }
        return view('Exhibitor-Operator.Inbox')->with(['Booth' => $Booth, 'Users' => $Users]);
    }



    public function Chat(Request $request)
    {
        $Owner = Auth::id();
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






    public function ChatGet(){
        $Chats = AdminChat::where('ReceiverID' , Auth::id())->get();
        return response()->json([
            'Chat' => $Chats
        ],200);
    }


    public function ChatAdmin(Request $request){
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
            'Sender' => 'Exhibitor-Operator',
        ]);
        $Chats = AdminChat::where('ReceiverID' , Auth::id())->get();
        return response()->json([
            'Chat' => $Chats
        ],200);
    }


    public function Statistics()
    {
        $newMessage = $this->hasanChatCount();
        $Statistic = Statistics::where('BoothID',$this->Booth()->id)->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get(array(
                \DB::raw('Date(created_at) as date'),
                \DB::raw('COUNT(*) as "views"')
            ));
        $Profession = Statistics::where('BoothID',$this->Booth()->id)->groupBy('Profession')
            ->orderBy('Profession', 'ASC')
            ->get(array(
                \DB::raw('Profession'),
                \DB::raw('COUNT(*) as "views"'),
            ));

        return view('Exhibitor-Operator.Statistics')->with([
            'Booth' => $this->Booth(),
            'Statistic' => $Statistic,
            'newMessage'=>$newMessage
        ])->with('Profession', $Profession);

    }


    public function History(){

        $newMessage = $this->hasanChatCount();


        $Booth = $this->Booth();
        $Statistic = Statistics::where('BoothID' , $Booth->id )->get();
        $Users = [];
        $uniques = array();
        foreach ($Statistic as $obj) {
            $uniques[$obj->UserID] = $obj;
        }
        foreach ($uniques as $item) {
            $Users[] = User::find($item->UserID);
        }

        foreach ($Users as $User) {
            $usernamesForSearch[] = $User->UserName;
        }
        $UsersSearched = array();
        if (\request()->search){
            $User = User::find(\request()->UserID);
            $input = preg_quote(\request()->search, '~');
            $data = $usernamesForSearch;
            $results = preg_grep('~' . $input . '~', $data);
            foreach ($results as $result){
                $UsersSearched[] = User::where("UserName","LIKE",$result)->first();
            }

            if (count($UsersSearched) != 0) {
                return view('Exhibitor-Operator.History')->with(['Booth' => $Booth , 'Users' => $UsersSearched , 'User' => $User,'newMessage'=>$newMessage]);
            }else {
                return redirect()->back();
            }
        }










        if (\request()->UserID){
            $User = User::find(\request()->UserID);
            return view('Exhibitor-Operator.History')->with(['Booth' => $Booth , 'Users' => $Users , 'User' => $User]);
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
                return view('Exhibitor-Operator.History')->with(['Booth' => $Booth, 'Users' => $final]);
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
                return redirect()->back();
            }else{
                return view('Exhibitor-Operator.History')->with(['Booth' => $Booth, 'Users' => $final]);
            }


        }

        if (\request()->search) {

            $UserName = User::where('UserName', 'LIKE', '%' . \request()->search . '%')->get();
            if ($UserName->count() <= 0) {
                return redirect()->back();
            }else{
                return view('Exhibitor-Operator.History')->with(['Booth' => $Booth, 'Users' => $UserName]);

            }

        }


        return view('Exhibitor-Operator.History')->with(['Booth' => $Booth , 'Users' => $Users]);


    }



    public function ContactUs(){
        $newMessage = $this->hasanChatCount();
        $Chats = AdminChat::where('ReceiverID' , Auth::id())->get();

        return view('Exhibitor-Operator.ContactUS')->with(['Chats' => $Chats, 'Booth' => $this->Booth(),'newMessage',$newMessage]);
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
            Alert::success('Password Changed Successfully');
            return redirect()->route('PassChanged');
        }
        Alert::error('please try again');

        return redirect()->back();


    }

    public static function ChatCountEx($id)
    {

        $user = User::find($id);
        $myUserID = \auth()->user()->CompanyID;
        $Booth = booth::where("id",$myUserID)->first();

        $Count = Chat::where([['BoothID' , $Booth->id],['UserID' , $user->id],['Sender' , 'Visitor'],['Status' , 'New']])->count();
        User::where("id",$id)->update(["newmessage"=>$Count]);

        if ($Count > 0) {
            return $Count;
        } else {
            return 0;
        }
    }



    public function hasanChatCount(){
        $userID = \auth()->user()->CompanyID;
        $boothID = booth::where("id",$userID)->first();
        $newMessage = Chat::where("Status","New")->where("Sender","!=","Exhibitor")->where("BoothID",$boothID)->count();
        return $newMessage;
    }




    public function exhibitorOperatorContactUsAjax()
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


}
