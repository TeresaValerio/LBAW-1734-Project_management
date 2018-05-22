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

    $checkLogin = DB::table('users') -> select('id')-> where (['e_mail'=>$login_email,'password'=>$login_password])->get();
    


	if(count($checkLogin)>0)
	{
        echo (gettype($checkLogin));
        return redirect ('/personalInfo'.$checkLogin);


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
