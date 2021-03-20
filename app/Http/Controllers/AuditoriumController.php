<?php

namespace App\Http\Controllers;

use App\Auditorium;
use App\AuditoriumChat;
use App\Conference;
use App\Jobs\FinishStream;
use App\Site;
use App\Speaker;
use App\Traits\Uploader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuditoriumController extends Controller
{
    use  Uploader;


    public function ChangePassword(Request $request){
        $request->validate([
            'OldPassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        $Speaker = Speaker::find(Session::get('Speaker')->id);
            if ($Speaker->password === $request->OldPassword) {
            $Speaker->password = $request->password;
            $Speaker->save();
            Session::forget('Speaker');
            Alert::success('Password Changed Successfully');

            return redirect()->route('Auditorium.Login');

        }else{
            return redirect()->back()->withErrors(['msg' => 'Enter Correct Old Password']);

        }


    }

    public function UpdateAvatar(Request $request)
    {
        $request->validate([
            'Avatar' => 'image|required'
        ]);
        $User = Speaker::find(Session::get('Speaker')->id);
        $User->avatar = $this->UploadPic($request, 'Avatar', 'UserProfiles', 'Profile');
        $User->save();
        return redirect()->back();
    }
    public function UpdateProfile(Request $request)
    {
        $request->validate([
            'PdfFile' => 'nullable',
            'abstract' => 'nullable'
        ]);
        $User = Speaker::find(Session::get('Speaker')->id);
        $User->pdf = $request->hasFile('PdfFile') ? $this->S3Doc($request, 'PdfFile') : $User->pdf;
        $User->abstract = $request->has('abstract') ? $request->abstract : $User->abstract;

        $User->save();
        Alert::success('Profile updated successfully');
        return redirect()->back();
    }


    public function StreamKey(Request $request){

        $Speaker = Speaker::find($request->SpeakerID);
        $Site = Site::find(1);
            $Speaker->StreamID = $Site->StreamKey;
            $Speaker->StreamUrl = $Site->RtmpAddress;
            $Speaker->HaveStreamKey = 'Yes';
            $Speaker->save();
            Carbon::now()->diffInMinutes(Carbon::parse($Speaker->End));
            FinishStream::dispatch($Speaker->id)->delay(now()->addMinutes(Carbon::parse($Speaker->Speak->Start)->diffInMinutes(Carbon::parse($Speaker->Speak->End))));
            Alert::success('Rtmp Address Url =>' . $Site->RtmpAddress . '<br>' . 'Secret Key =>' .$Site->StreamKey);
            return redirect()->back();

    }


    public function Login(){
        return view('Auditorium.login');
    }
    public function LoginPost(Request $request){
        $request->validate([
            'UserName' => 'required|string',
            'password' => 'required'
        ]);
        $User = Speaker::where('UserName' , $request->UserName)->orWhere('email'  , $request->UserName)->get();
        if (!empty($User[0])){
            if ($request->password == $User[0]->password){
                unset($User[0]->password);
                Session::put('Speaker', $User[0]);
                return redirect()->route('Auditorium.Index');
            }
            else{
                return redirect()->back()->withErrors(['msg' => 'These credentials do not match our records']);
            }
        }
        else{
            return redirect()->back()->withErrors(['msg' => 'These credentials do not match our records']);
        }
    }

    public function LogOut(){
        Session::forget('Speaker');
        return redirect()->route('Auditorium.Login');

    }
    public function Index(){
        if (Session::get('Speaker') != null){

            $speaker = Speaker::where('id',Session::get('Speaker')->id)->first();
            $conference = Conference::where('crid', $speaker->cid)->first();
            return view('Auditorium.main')->with([
                'conference' => $conference,
            ]);




        }else{
            return redirect()->route('Auditorium.Login');
        }
    }
    public function Chats($ID){
        $Auditorium = Auditorium::where('SpeakerID' , $ID)->get();
        if ($Auditorium[0] == null || empty($Auditorium[0]) || $Auditorium->count() <= 0) {
            Alert::error('You Havent Any Speak');
            return redirect()->back();
        }else{


            return view('Auditorium.Chats')->with('SpeakeID' , $Auditorium[0]->id);
        }
    }

    public function ChatGet(Request $request){
        $Chats = AuditoriumChat::where('auditoriaID' , $request->AuditoriumID)->get();
        return response()->json([
            'Chat' => $Chats
        ]);
    }

}
