<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    protected function validator(array $data)
    {
        return Validator::make($data, [
	    'password' => 'required|confirmed'
        ]);
        
    }

    public function change(Request $request){

        //Change Password
        return User::create([
        'password'=>$data['new_password']
        ]);

        
    }

        /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/settings';
}
