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
    $projects_names2 = DB::table('projects')->join('project_team','projects.id','=','project_team.id_project')->where('id_user',$userId)->pluck('name');

    $personal_events_dates = DB::table('personal_event')->where('id_user',$userId)->pluck('date');
    $personal_events_names= DB::table('personal_event')->where('id_user',$userId)->pluck('name');
    $personal_events_places = DB::table('personal_event')->where('id_user',$userId)->pluck('place');


    $meetings_dates = DB::table('meeting')->join('board_team','meeting.id_board','=','board_team.id_board')->where('id_user',$userId)->pluck('date');
    $meetings_places = DB::table('meeting')->join('board_team','meeting.id_board','=','board_team.id_board')->where('id_user',$userId)->pluck('place');
    $meetings_names = DB::table('meeting')->join('board','meeting.id_board','=','board.id')->join('board_team','meeting.id_board','=','board_team.id_board')->where('id_user',$userId)->pluck('board.name');

    return view('pages.userCalendar', compact('person','picture','tasks_deadlines','tasks_names','projects_deadlines','projects_names','projects_deadlines2','projects_names2','personal_events_dates','personal_events_names','personal_events_places','meetings_dates','meetings_names','meetings_places'));
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
    try{
    $userAuth = auth()->user()->id;
    }
    catch (\Exception $e){
        return redirect ('/');
    }
    
    $project = DB::table('projects')->find($projectId);
    $boards_ids = DB::table('board')->where('id_project',$projectId)->pluck('id');

    $users=DB::table('projects')->where('id',$projectId)->where('id_coordinator',$userAuth)->count();
    $users2=DB::table('project_team')->where('id_project',$projectId)->where('id_user',$userAuth)->count();
    $users_total=$users + $users2;
    if ($users_total >0){
        return view('pages.projectBoard', compact('project', 'boards_ids'));
    }else{
        return redirect ($userAuth.'/userProjects');
    }
    
});


////////////////////////
///// PROJECT TEAM /////
////////////////////////

Route::get('/{projectId}/projectTeam', function ($projectId) {
    try{
    $userAuth = auth()->user()->id;
    }
    catch (\Exception $e){
        return redirect ('/');
    }
    
    $project = DB::table('projects')->find($projectId);
    $team_ids = DB::table('project_team')->where('id_project',$projectId)->pluck('id_user');

    $users=DB::table('projects')->where('id',$projectId)->where('id_coordinator',$userAuth)->count();
    $users2=DB::table('project_team')->where('id_project',$projectId)->where('id_user',$userAuth)->count();
    $users_total=$users + $users2;
    if ($users_total >0){
        return view('pages.projectTeam', compact('project', 'team_ids'));
    }else{
        return redirect ($userAuth.'/userProjects');
    }
});

/////////////////////////
///// USER CONTACTS /////
/////////////////////////

Route::get('/{userId}/userContacts', function ($userId) {
    try{
    $userAuth = auth()->user()->id;
    }
    catch (\Exception $e){
        return redirect ('/');
    }
    
    $person = DB::table('users')->find($userId);
    $contact_ids = DB::table('contact')->where('id_user',$userId)->pluck('id_contact');
    return view('pages.userContacts', compact('person', 'contact_ids'));
});

////////////////////////
///// PROJECT INFO /////
////////////////////////

Route::get('/{projectId}/projectInfo', function ($projectId) {
    try{
    $userAuth = auth()->user()->id;
    }
    catch (\Exception $e){
        return redirect ('/');
    }
    $project = DB::table('projects')->find($projectId);

    $users=DB::table('projects')->where('id',$projectId)->where('id_coordinator',$userAuth)->count();
    $users2=DB::table('project_team')->where('id_project',$projectId)->where('id_user',$userAuth)->count();
    $users_total=$users + $users2;
    if ($users_total >0){
        return view('pages.projectInfo', compact('project'));
    }else{
        return redirect ($userAuth.'/userProjects');
    }

});

////////////////////////////
///// PROJECT CALENDAR /////
////////////////////////////

Route::get('/{projectId}/projectCalendar', function ($projectId) {
    try{
    $userAuth = auth()->user()->id;
    }
    catch (\Exception $e){
        return redirect ('/');
    }
    
    $project = DB::table('projects')->find($projectId);

    $projects_deadlines = DB::table('projects')->where('id',$projectId)->pluck('end_date');
    $projects_names = DB::table('projects')->where('id',$projectId)->pluck('name');

    $tasks_deadlines = DB::table('task')->join('board','task.id_board','=','board.id')->join('projects','board.id_project','=','projects.id')->where('projects.id',$projectId)->pluck('deadline');
    $tasks_names = DB::table('projects')->join('board','projects.id','=','board.id_project')->join('task','board.id','=','task.id_board')->where('projects.id',$projectId)->pluck('task.name');

    $meetings_dates = DB::table('meeting')->join('board','meeting.id_board','=','board.id')->join('projects','board.id_project','=','projects.id')->where('projects.id',$projectId)->pluck('meeting.date');
    $meetings_names = DB::table('meeting')->join('board','meeting.id_board','=','board.id')->join('projects','board.id_project','=','projects.id')->where('projects.id',$projectId)->pluck('board.name');    
    $meetings_places = DB::table('meeting')->join('board','meeting.id_board','=','board.id')->join('projects','board.id_project','=','projects.id')->where('projects.id',$projectId)->pluck('meeting.place');

    $users=DB::table('projects')->where('id',$projectId)->where('id_coordinator',$userAuth)->count();
    $users2=DB::table('project_team')->where('id_project',$projectId)->where('id_user',$userAuth)->count();
    $users_total=$users + $users2;
    if ($users_total >0){
        return view('pages.projectCalendar', compact('project','projects_deadlines','projects_names','tasks_deadlines','tasks_names','meetings_dates','meetings_names','meetings_places'));
    }else{
        return redirect ($userAuth.'/userProjects');
    }
});

////////////////////////
///// BOARD TASKS /////
////////////////////////

Route::get('/{boardId}/tasks', function ($boardId) {
    try{
    $userAuth = auth()->user()->id;
    }
    catch (\Exception $e){
        return redirect ('/');
    }
    
    $board = DB::table('board')->find($boardId);
    $project=DB::table('board')->where('id',$boardId)->pluck('id_project');
    $tasks_ids = DB::table('task')->where('id_board',$boardId)->pluck('id');

    $users=DB::table('board_team')->where('id_board',$boardId)->where('id_user',$userAuth)->count();
    $users2=DB::table('board')->join('projects','board.id_project','=','projects.id')->where('board.id',$boardId)->where('projects.id_coordinator',$userAuth)->count();
    $users_total=$users + $users2;
    if ($users_total >0){
        return view('pages.tasks', compact('board', 'tasks_ids'));
    }else{
        return redirect ($userAuth.'/userProjects');
    }

});

//////////////////////////
///////// EXPLORE ////////
//////////////////////////

Route::get('/explore', function () {
    return view('pages.explore');
});


Route::post('/project','ProjectsController@store');

Route::post('/loginme','Auth\LoginController@login');

Route::post('/register','Auth\RegisterController@register');

Route::get('/logout','Auth\LogoutController@logout');

Route::post('/changePassword','SettingsController@changePassword');
Route::post('/changeFullName','SettingsController@changeFullName');
Route::post('/changePrivacy','SettingsController@changePrivacy');
Route::post('/deleteAccount','SettingsController@deleteAccount');

Route::post('/addContact', 'ContactsController@add');

Route::post('/addBoard', 'BoardController@store');

Route::post('/addTask', 'TaskController@store');

Route::post('/addTeamTask','TaskController@team');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

