<?php

namespace App\Http\Controllers;

use App\Auditorium;
use App\booth;
use App\Conference;
use App\ExhibitorForms;
use App\Hall;
use App\Jobs;
use App\Organizer;
use App\Site;
use App\Traits\Uploader;
use App\User;
use App\VisitorForm;
use Carbon\Carbon;
use Hamcrest\Core\BothForms;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Aws\S3\S3Client;
use RealRashid\SweetAlert\Facades\Alert;

class WebController extends Controller
{

    use  Uploader;


    public function test()
    {
        return view("Test.test");
    }



    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    /**
     * Write code on MethodsendNotification
     *
     * @return response()
     */
    public function sendNotification(Request $request)
    {
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $SERVER_API_KEY = env('FIREBASE_SERVER_KEY','xxxxxxxxx');

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => 'Ping',
                "body" => 'this is working fine',
                "click_action" => 'https://google.com/',
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

        dd($response);
    }




















    public function leave_meeting(Request $request) {

        Alert::success('Successfully left the meeting');
        return redirect()->to('/');



    }

    public function join_webinar( $conference){

        $role = 0;


        $conference = Conference::find($conference);

        if (Session::get('Speaker') != null) {

            $role = 1;

        }elseif (Auth::user()->Rule =='Exhibitor' && booth::find($conference->booth)->UserID == Auth::user()->id) {
            $role = 1;
        }



        return view('zoom-webinar.start')->with([
            'webinar' => $conference,
            'role' => $role,

        ]);


    }

    public function PassChanged(){
        Alert::success('Password Changed');
        return redirect()->route('login');
    }
    public function ActiveAccount()
    {
        return view('Errors.ActiveAccount');
    }


    public function Verify(){
        return view('Errors.Verified');
    }



    public function Install()
    {
        User::create([
            'FirstName' => 'admin',
            'LastName' => 'admin',
            'UserName' => 'Admin',
            'PhoneNumber' => '111111111111',
            'Gender' => 'Male',
            'Rule' => 'Admin',
            'Image' => 'assets/img/NoPic.png',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'City' => 'Mellborn',
            'Country' => 'USA',
            'Payment' => 'Paid',
            'BirthDate' => '2020-01-01',
            'VisitExperience' => 'ok',
        ]);

        Hall::create([
            'id' => 1,
            'Loby1' => 'test'
        ]);


        Site::create([
            'Name' => 'Amitiss',
            'Description' => 'Amitiss',
            'Logo1' => '1',
            'VisitorGender'=>"test",
            'VisitorProfession'=>"test"
        ]);


        ExhibitorForms::create([
            "institutionItems"=>"test"
        ]);

        VisitorForm::create([
            "education"=>"active"
        ]);



        return redirect()->route('login');

    }


    public function Jobs($BoothID)
    {
        $Jobs = Jobs::where('BoothID' , $BoothID)->get();

        return view('Jobs')->with(['Jobs' => $Jobs]);
    }


    public function index()
    {

        $editedStartDate = Carbon::parse(Site::first()->StartDate);

        if (Auth::user()->Rule == 'Admin') {
            return redirect()->route('Admin.History');
        } elseif (Auth::user()->Rule == 'Exhibitor') {
            return redirect()->route('Exhibitor.index');
        } elseif (Auth::user()->Rule == 'Visitor') {
            return redirect()->route('Visitor.index');
        } elseif (Auth::user()->Rule == 'Exhibitor-Operator') {
            return redirect()->route('ExhibitorOperator.index');
        } elseif (Auth::user()->Rule == 'Admin-Operator') {
            return redirect()->route('AdminOperator.index');
        } else {
            Auth::logout();
            return redirect()->route('login',compact("editedStartDate"));
        }
    }


    public function Auditorium(){
        $List = Conference::orderBy( 'start_date', 'ASC')->orderBy('start_time', 'ASC')->get();

        return view('AuditoriumList')->with(['List' => $List]);
    }

    public function AuditoriumPlay($id){


        $conference = Conference::where('id',$id)->first();

        return view('AuditoriumAbstract')->with([

            'conference' => $conference,

        ]);
    }

    public function PDF()
    {
        if (!\request('PDF')) {
            return 'PDF Link Not Found';
        }
        return view('pdf')->with([
            'PDF' => \request('PDF')
        ]);
    }

    public function video($id)
    {
        $Booth = booth::find($id);

        return view('video')->with([
            'Video' => 'https://uploadcloudforamitiss.s3.ir-thr-at1.arvanstorage.com/173b1afa9f0e7873b559648e24bfe3a5957730.mp4'
        ]);
    }


    public function SetLocale($locale)
    {
        Session::put('locale', $locale);
        return redirect()->back();
    }



//    Mobile Pass Routes

    public function PassChangeViaMobile()
    {
        return view("auth.passwords.mobile");
    }

    public function PassChangeCheckMobile(Request $request)
    {
        if (User::where("PhoneNumber",$request->phoneNumber)->get()->count() > 0){
            User::where("PhoneNumber",$request->phoneNumber)->update([
                "phoneToken"=>mt_rand(100000,999999)
            ]);
//            $api->send("1000596446","09211585538",User::where("PhoneNumber",$request->phoneNumber)->first()->phoneToken);

            $this->sendSMS(User::where("PhoneNumber",$request->phoneNumber)->first()->phoneToken,User::where("PhoneNumber",$request->phoneNumber)->first()->PhoneNumber);

            Alert::success("Message sent !!");
            return redirect(route("ChangingPassHasan"));
        }else{
            Alert::error("There is no user with this phone number");
            return redirect()->back();
        }
    }

    public function phoneCode()
    {
        return view("auth.passwords.changingPassHasan");
    }

    public function ChangingPassHasanPost(Request $request)
    {
        if (User::where("phoneToken",$request->phoneToken)->get()->count() > 0){
            return redirect(route("finalStep",["phoneToken"=>$request->phoneToken]));
        }else{
            Alert::error("this code is not exist");
            return redirect()->back();
        };


    }

    public function finalStep()
    {
        return view("auth.passwords.finalstep");
    }

    public function finalStepPost(Request $request)
    {

        if ($request->password == $request->passwordConfirmation) {
            User::where("phoneToken",$request->phoneToken)->update([
                "password"=>Hash::make($request->password),
                "phoneToken"=>null
            ]);

            Alert::Success("Password Change Successfuly");
            return redirect("/");
        }else{
            Alert::error("Passwords Not Match");
            return redirect()->back();
        }


    }

    public function Organizer()
    {
        $Organizers = Organizer::all();
        $OrganizerID=null;
        $Organizer=null;
        if (\request("OrganizerID")) {
            $OrganizerID = \request("OrganizerID");
        }
        return view("eventOrganizer",compact("Organizers","OrganizerID"));
    }



    public function socials($id)
    {
        $Booth=booth::find($id);
        return view("socials-company",compact("Booth"));
    }



//  Mobile Pass Routes End here

}
