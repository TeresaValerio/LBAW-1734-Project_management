<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings');
    }



    public function changePassword(Request $request){

        $userId = auth()->user()->id;
        //$userId = Auth::user()->id;

        $user = DB::table('users') -> where ('id',$userId);
        
        $this->authorize('update', $user);

        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);

        $user->password=$request->input('password');
        $user->save();
        echo ($userId);
        //return redirect($userId.'/settings')->with('success', 'Password changed');   
    }

    public function changeFullName(Request $request){

        //Change Password
        //$User=User::find(Auth::user()->id);
        //echo $User;
        $userId = User::find($id);

        $this->authorize('update', $user);

        $this->validate($request, [
            'full_name' => 'required'
        ]);

        $user->full_name=$request->input('full_name');
        $user->save();

        return redirect($userId.'/settings')->with('success', 'Full name changed');

        
    }


    

        /**
     * Where to redirect users after change password.
     *
     * @var string
     */
    protected $redirectTo = '/{userId}/settings';
}
