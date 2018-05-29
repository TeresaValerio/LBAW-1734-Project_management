<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/{userId}/userProjects', 'SearchProjectsController@index');
Route::get('/userProjects/search','SearchProjectsController@action')->name('userProjects.search');

////////////////////
///// HOMEPAGE /////
////////////////////

Route::get('/', function () {
    try{
    $userAuth = auth()->user()->id;
    return back()->withInput();;
    }
    catch (\Exception $e){
   
    return view('pages.welcome');
    }  
});


/////////////////////////
///// PERSONAL INFO /////
/////////////////////////

Route::get('/{userId}/personalInfo', function ($userId){
    try{
    $userAuth = auth()->user()->id;
    }
    catch (\Exception $e){
        return redirect ('/');
    }
    
    if ($userAuth == $userId){
    $person = DB::table('users')->find($userId);
    $picture=DB::table('profile_picture')->where('id_user',$userId)->value('path');

    return view('pages.userInfo', compact('person','picture'));
    }
    else{
    $userId=$userAuth;
    $person = DB::table('users')->find($userId);
    $picture=DB::table('profile_picture')->where('id_user',$userId)->value('path');
    return redirect ($userAuth.'/personalInfo');
    }
});


/////////////////////////
///// USER CALENDAR /////
/////////////////////////

Route::get('/{userId}/userCalendar', function ($userId){
    try{
    $userAuth = auth()->user()->id;
    }
    catch (\Exception $e){
        return redirect ('/');
    }
    
    if ($userAuth == $userId){
    $person = DB::table('users')->find($userId);
    
    $tasks_deadlines = DB::table('task')->where('id_creator',$userId)->pluck('deadline');
    $tasks_names = DB::table('task')->where('id_creator',$userId)->pluck('name');

    $projects_deadlines = DB::table('projects')->where('id_coordinator',$userId)->pluck('end_date');
    $projects_names = DB::table('projects')->where('id_coordinator',$userId)->pluck('name');

    $projects_deadlines2 = DB::table('projects')->join('project_team','projects.id','=','project_team.id_project')->where('id_user',$userId)->pluck('end_date');
    echo("PROJECTS DEADLINES 2: ");
    echo ($projects_deadlines2);
    $projects_names2 = DB::table('projects')->join('project_team','projects.id','=','project_team.id_project')->where('id_user',$userId)->pluck('name');
    echo("PROJECTS DEADLINES 2: ");
    echo ($projects_names2);

<<<<<<< HEAD
    /*$personal_events_date = DB::table('personal_event')->where('id_user',$userId)->pluck('date');
    echo("PERSONAL EVENTS DATE: ");
    echo ($personal_events_date);
    $personal_events_name= DB::table('personal_event')->where('id_user',$userId)->pluck('name');
    echo("PERSONAL EVENTS NAME: ");
    echo ($personal_events_name);
    $personal_events_place = DB::table('personal_event')->where('id_user',$userId)->pluck('place');
    echo("PERSONAL EVENTS PLACE: ");
    echo ($personal_events_place);*/

=======
    $personal_events_dates = DB::table('personal_event')->where('id_user',$userId)->pluck('date');
    $personal_events_names= DB::table('personal_event')->where('id_user',$userId)->pluck('name');
    $personal_events_places = DB::table('personal_event')->where('id_user',$userId)->pluck('place');
>>>>>>> bacae6ec7f28bb6021188564fc69cd420fd2bbeb


    $meetings_dates = DB::table('meeting')->join('board_team','meeting.id_board','=','board_team.id_board')->where('id_user',$userId)->pluck('date');
    $meetings_places = DB::table('meeting')->join('board_team','meeting.id_board','=','board_team.id_board')->where('id_user',$userId)->pluck('place');
    $meetings_names = DB::table('meeting')->join('board','meeting.id_board','=','board.id')->join('board_team','meeting.id_board','=','board_team.id_board')->where('id_user',$userId)->pluck('board.name');

<<<<<<< HEAD
    return view('pages.userCalendar', compact('person','picture','tasks_deadlines','tasks_names','projects_deadlines','projects_names','projects_deadlines2','projects_names2'));
=======
    return view('pages.userCalendar', compact('person','picture','tasks_deadlines','tasks_names','projects_deadlines','projects_names','projects_deadlines2','projects_names2','personal_events_dates','personal_events_names','personal_events_places','meetings_dates','meetings_places','meetings_names'));
>>>>>>> bacae6ec7f28bb6021188564fc69cd420fd2bbeb
    }
    else{
    $userId=$userAuth;
    $person = DB::table('users')->find($userId);
    return redirect ($userAuth.'/userCalendar');
    }
});


/////////////////////////
///// USER PROJECTS /////
/////////////////////////

Route::get('/{userId}/userProjects', function ($userId) {
    try{
    $userAuth = auth()->user()->id;
    }
    catch (\Exception $e){
        return redirect ('/');
    }

    if ($userAuth == $userId){
    $person=DB::table('users')->find($userId);
    $created_ids=DB::table('projects')->where('id_coordinator',$userId)->pluck('id');
    $working_ids=DB::table('project_team')->where('id_user',$userId)->pluck('id_project');

    return view('pages.userProjects', compact ('person', 'created_ids', 'working_ids'));
    }

    else{
    $userId=$userAuth;
    
    return redirect ($userAuth.'/userProjects');
    }
});



////////////////////
///// SETTINGS /////
////////////////////

Route::get('/{userId}/settings', function ($userId) {
    try{
    $userAuth = auth()->user()->id;
    }
    catch (\Exception $e){
        return redirect ('/');
    }

    if ($userAuth == $userId){
    $person = DB::table('users')->find($userId);
    
    return view('pages.settings', compact('person'));
    }
    else{
        $userId=$userAuth;
        $person = DB::table('users')->find($userId);
    return redirect ($userAuth.'/settings');    
    }

});


//////////////////////////
///// PROJECT BOARDS /////
//////////////////////////

Route::get('/{projectId}/projectBoards', function ($projectId) {
    $project = DB::table('projects')->find($projectId);
    $boards_ids = DB::table('board')->where('id_project',$projectId)->pluck('id');
    return view('pages.projectBoard', compact('project', 'boards_ids'));
});


////////////////////////
///// PROJECT TEAM /////
////////////////////////

Route::get('/{projectId}/projectTeam', function ($projectId) {
    $project = DB::table('projects')->find($projectId);
    $team_ids = DB::table('project_team')->where('id_project',$projectId)->pluck('id_user');
    return view('pages.projectTeam', compact('project', 'team_ids'));
});

////////////////////////
///// PROJECT INFO /////
////////////////////////

Route::get('/{projectId}/projectInfo', function ($projectId) {
    $project = DB::table('projects')->find($projectId);
    return view('pages.projectInfo', compact('project'));
});

////////////////////////
///// PROJECT CAL /////
////////////////////////

Route::get('/{projectId}/projectCalendar', function ($projectId) {
    $project = DB::table('projects')->find($projectId);
    return view('pages.projectCalendar', compact('project'));
});

Route::post('/project','ProjectsController@store');

Route::post('/loginme','Auth\LoginController@login');

Route::post('/register','Auth\RegisterController@register');

Route::get('/logout','Auth\LogoutController@logout');

Route::post('/changePassword','SettingsController@changePassword');
Route::post('/changeFullName','SettingsController@changeFullName');
Route::post('/changePrivacy','SettingsController@changePrivacy');

Route::post('/addContact', 'ContactController@addContact');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

