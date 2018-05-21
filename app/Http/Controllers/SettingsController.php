<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/{userId}/settings';

    protected function validator(array $data)
    {
        return Validator::make($data, [
	    'new_password' => 'required',
        'new_password2' => 'required',
        'register_fullname' => 'required',
        'register_password' => 'required'
        ]);
        
    }

    public function change(Request $request){
 
 
        $validatedData = $request->validate([
            'new_password' => 'required',
            'new_password2' => 'required|string|min:6|confirmed',
        ]);
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
 
        return redirect()->back()->with("success","Password changed successfully !");
 
    }
}
