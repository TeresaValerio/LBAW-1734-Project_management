<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;
use App\Http\Controllers\Controller;

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



    public function changePassword(Request $request, User $user){

        $userId = auth()->user()->id;

        //$user = DB::table('users') -> where ('id',$userId)->get();
        $user = User::where('id',$userId)->first();

        $this->validate($request, [
            'password' => 'required|confirmed'
        ]);

        $user_new_password = $request -> input('password');
        $user -> password = $user_new_password;

        $user->save();

        return redirect($userId.'/settings')->with('success', 'Password changed');   
    }

    public function changeFullName(Request $request){

        $userId = auth()->user()->id;

        //$user = DB::table('users') -> where ('id',$userId)->get();
        $user = User::where('id',$userId)->first();

        $this->validate($request, [
            'full_name' => 'required'
        ]);

        $user_new_full_name = $request -> input('full_name');
        $user -> full_name = $user_new_full_name;

        $user->save();

        return redirect($userId.'/settings')->with('success', 'Password changed'); 
        
    }


    public function changePrivacy(Request $request){

        $userId = auth()->user()->id;

        //$user = DB::table('users') -> where ('id',$userId)->get();
        $user = User::where('id',$userId)->first();

        $this->validate($request, [
            'full_name' => 'required'
        ]);

        $user_new_full_name = $request -> input('full_name');
        $user -> full_name = $user_new_full_name;

        $user->save();

        return redirect($userId.'/settings')->with('success', 'Password changed'); 
        
    }


    public function deleteAccount(Request $request){

        $userId = auth()->user()->id;

        $user = User::where('id',$userId)->first();
        $user->delete();

        Auth::logout();
        return redirect('/');
        
    }


    

        /**
     * Where to redirect users after change password.
     *
     * @var string
     */
    protected $redirectTo = '/{userId}/settings';
}
