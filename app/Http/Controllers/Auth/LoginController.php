<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;

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
    public function login (Request $req)
    {
	$login_email = $req -> input('login_email');
	$login_password = $req -> input('login_password');

	$checkLogin = DB::table('User') -> where (['e_mail'=>$login_email,'password'=>$login_password])->get();

	if(count($checkLogin)>0)
	{
		return view('pages.userInfo');
	}
	else
	{
		return view('pages.welcome');
	}	

    }
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/userInfo';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
