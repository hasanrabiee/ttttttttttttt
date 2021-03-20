<?php

namespace App\Http\Controllers\Auth;

use App\booth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Site;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'FirstName' => ['required', 'string', 'max:255'],
            'LastName' => ['required', 'string', 'max:255'],
            'UserName' => ['required', 'string', 'max:255' , 'unique:users'],
            'Gender' => ['string', 'max:255'],
            'PhoneNumber' => ['max:255','string' , 'nullable'],
            'Profession' => ['string', 'max:255'],
            'Country' => ['required', 'string', 'max:255'],
            'CountryCode' => ['string', 'max:255' , 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed' ,'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@#$%^&*]).*$/'],
        ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        dd($data);
        $Payment = Site::find(1)->VisitorPayment;
        $PhoneNumber = preg_replace('/-/','',$data['PhoneNumber']);
        $PhoneNumber = preg_replace('/\(/','',$PhoneNumber);
        $PhoneNumber = preg_replace('/\)/','',$PhoneNumber);
        $CountryCode = isset($data['CountryCode']) ? $data['CountryCode'] : '+1';
        $PhoneNumber =  $CountryCode . $PhoneNumber;
        return User::create([
            'FirstName' => $data['FirstName'],
            'LastName' => $data['LastName'],
            'UserName' => $data['UserName'],
            'PhoneNumber' => $PhoneNumber != null ? $PhoneNumber : 'Not Set',
            'Profession' => isset($data['professionInterestedToApply']) ? $data['professionInterestedToApply'] : 'Other',
            'Gender' => isset($data['Gender']) ? $data['Gender'] : 'Other',
            'Country' => $data['Country'],
            'City' => $data['City'],
            'BirthDate' => isset($data['BirthDate']) ? $data['BirthDate'] : Carbon::now(),
            'Image' => '/assets/img/DefaultPic.png',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'Rule' => 'Visitor',
            'AccountStatus' => 'Active',
            'Payment' => $Payment > 0 ? 'UnPaid' : 'Paid',
            'education' => isset($data['education']) ? $data["education"] : null,
            'countryStudy' => isset($data['countryStudy']) ? $data["countryStudy"] : null,
            'interestedDegree' => isset($data['InterestedDegree']) ? $data['InterestedDegree'] : null,
            'interestedField' => isset($data['InterestedField']) ? $data['InterestedField'] : null,
            'languageOfStudy' => isset($data["languageOfStudy"]) ? $data["languageOfStudy"] : null,
            'onlineDegreeProgram' => isset($data['onlineDegreeProgram']) ? $data["onlineDegreeProgram"] : null,
            'interestedScholarShip' => isset($data['interestedScholarShip']) ? $data["interestedScholarShip"] : null,
            'admissionSemester' => isset($data['admissionSemester']) ? $data["admissionSemester"] : null,
            'InterNationalPrograms' => isset($data['interNationalPrograms']) ? $data["interNationalPrograms"] : null,
            'professionInterestedToApply' => isset($data['professionInterestedToApply']) ? $data["professionInterestedToApply"] : null,
            'profile' => isset($data['profile']) ? $data["profile"] : null,
            'userCompanyName' => isset($data['userCompanyName']) ? $data["userCompanyName"] : null,
            'tel' => isset($data['tel']) ? $data["tel"] : null,
            'website' => isset($data['website']) ? $data["website"] : null,
            'zipCode' => isset($data['zipCode']) ? $data["zipCode"] : null,
            'institutionEmail' => isset($data['institutionEmail']) ? $data["institutionEmail"] : null,
            'fax' => isset($data['fax']) ? $data["fax"] : null,
            'position' => isset($data['position']) ? $data["position"] : null,
            'mainCompany' => isset($data['mainCompany']) ? $data["mainCompany"] : null,
            'formRule' => isset($data['formRule']) ? $data["formRule"] : null,
            'companyAddress' => isset($data['companyAddress']) ? $data["companyAddress"] : null,
            "app_token" => Str::random(16),
        ]);

    }
}
