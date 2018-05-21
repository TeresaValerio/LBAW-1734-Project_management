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

    $userId = auth()->user()->id;
    $person = DB::table('users')->find($userId);
    return view('pages.userInfo', compact('person'));
});

Route::get('/{userId}/userProjects', function ($userId) {
    
    return view('pages.userProjects');
});

Route::get('/{userId}/settings', function ($userId) {
    $person = DB::table('users')->find($userId);
    return view('pages.settings', compact('person'));
});

Route::post('/loginme','Auth\LoginController@login');

Route::post('/create','ProjectController@create');

Route::post('/register','Auth\RegisterController@register');

Route::post('/changePassword','SettingsController@change');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

