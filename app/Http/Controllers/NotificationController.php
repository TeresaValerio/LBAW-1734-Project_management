<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;
use DB;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
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
        return view('pages.userInfo');
    }




    public function markAsRead(Request $request){

        $userId = auth()->user()->id;

        $this->validate($request, [
            'id_notification'=>'required'
        ]);

        $notificationId=$request->get('id_notification');

        echo $notificationId;
        $notification = Notification::where('id',$notificationId)->first();

        $notification -> read = "true";

        $notification->save();

        return redirect($userId.'/personalInfo'); 
        
    }


        /**
     * Where to redirect users after change password.
     *
     * @var string
     */
    protected $redirectTo = '/{userId}/personalInfo';
}
