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

Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/{userId}/personalInfo', function ($userId) {

    $person = DB::table('users')->find($userId);
    $picture=DB::table('profile_picture')->where('id_user',$userId)->pluck('path');

    return view('pages.userInfo', compact('person','picture'));
});

Route::get('/{userId}/userProjects', function ($userId) {
    
    $person=DB::table('users')->find($userId);
    $created_ids=DB::table('projects')->where('id_coordinator',$userId)->pluck('id');
    $working_ids=DB::table('project_team')->where('id_user',$userId)->pluck('id_project');

    return view('pages.userProjects', compact ('person', 'created_ids', 'working_ids'));
});

Route::get('/{userId}/settings', function ($userId) {
    $person = DB::table('users')->find($userId);
    return view('pages.settings', compact('person'));
});

Route::post('/project','ProjectsController@store');

Route::post('/loginme','Auth\LoginController@login');

Route::post('/register','Auth\RegisterController@register');

Route::post('/changePassword','SettingsController@change');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

