<?php

namespace App\Http\Controllers;

use App\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;


class ProjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator()
    {
        return Validator::make($data, [
            'description',
            'start_date',
            'end_date',
            'name'=>'required'
        ]);
        
    }
    

    /**
     * Create a new project instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Project
     */

    protected function create (array $data)
    {
	return Project::create([
        'description' => $data['create_description'],
        'start_date' => $data['create_date'],
        'end_date' => $data['create_deadline'],
        'name' => $data['create_name'],
        'id_coordinator'=>1      
	]);
	
	
    }
    
    /**
     * Where to redirect users after creating
     *
     * @var string
     */
    protected $redirectTo = '/{userId}/userProjects';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
