<?php

namespace App\Http\Controllers;

use App\Lounge;
use App\LoungeChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoungeController extends Controller
{





    public function index(){
        if (Auth::check() == false){
            Auth::loginUsingId(\request()->UserID);
        }
        if (Auth::check() == true){
            if (\request()->GroupName){
                $Groups = Lounge::where('Name' , 'LIKE' , '%' . \request()->GroupName . '%')->get();
            }else{
                $Groups = Lounge::all();
            }
            if (\request()->GroupID){
                $Group = Lounge::find(\request()->GroupID);
                $Members = json_decode($Group->Members);

                if (in_array(Auth::id(),$Members) == false) {
                    $Members[] = Auth::id();
                }
                $Group->Members = json_encode($Members);
                $Group->save();
                return view('Lounge')->with(['Groups' => $Groups , 'Group' => $Group ]);
            }
            return view('Lounge')->with(['Groups' => $Groups]);
        }
        else{
            return redirect()->route('login');
        }

    }



    public function GroupList(){
        if (\request()->GroupName){
            $Groups = Lounge::where('Name' , 'LIKE' , '%' . \request()->GroupName . '%')->get();
        }else{
            $Groups = Lounge::all();
        }
        return response()->json([
            'Groups' => $Groups
        ],200);
    }

    public function Chat(Request $request){
        $request->validate([
            'Text' => 'required|max:255',
            'LoungeID' => 'required|integer'
        ]);
        $request->validate([
            'Text' => ['required', 'max:255']
        ]);
        LoungeChat::create([
            'UserID' => Auth::id(),
            'LoungeID' => $request->LoungeID,
            'Text' => $request->Text
        ]);

        return redirect()->back();
    }
}
