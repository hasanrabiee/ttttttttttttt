<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $UserName;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Get the login UserName to be used by the controller.
     *
     * @return string
     */


    public function login() {

        $input = \request()->all();

        $this->validate(\request(), [
            'login' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var(\request()->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['login'], 'password' => $input['password'])))
        {

            \Auth::user()->laravel_remember_session = \request()->password;
            Auth::user()->save();
            return redirect()->route('home');
        }else{
            return redirect()->back()->withErrors(['msg' => 'These credentials do not match our records']);
        }

    }


    /**
     * Get UserName property.
     *
     * @return string
     */
    public function UserName()
    {
        return $this->UserName;
    }






}
