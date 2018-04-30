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

Route::get('/personalInfo', function () {
    return view('pages.userInfo');
});

Route::get('/userInfo', function () {
    return view('pages.userInfo');
});

Route::get('/userProjects', function () {
    return view('pages.userProjects');
});

Route::get('/settings', function () {
    return view('pages.settings');
});

Route::post('/loginme','Auth\LoginController@login');


Route::post('/register','Auth\RegisterController@register');

Route::post('/changePassword','SettingsController@change');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

