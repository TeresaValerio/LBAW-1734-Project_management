<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;


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


    $checkLogin = DB::table('users') -> where ('e_mail',$login_email) ->where('password',$login_password)-> pluck('id');
    $userId = $checkLogin;

	if(count($checkLogin)>0)
	{
        Auth::loginUsingId($userId);
        return redirect ($userId.'/personalInfo');
	}
	else
	{
		return back() -> withErrors([
            'message' => 'Check your credentials and try again']);
	}	

    }

    
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/{userId}/personalInfo';

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
