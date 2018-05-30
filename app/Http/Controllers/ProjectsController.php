<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\ProjectTeam;
use Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/userProjects');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = auth()->user()->id;

        $this->validate($request, [
            'project_name' => 'required'
        ]);

        if ($request->get('project_public')==NULL){
            $privacy='true';
        }
        else{
            $privacy='false';
        }

        $project=Project::create([
            'name' => $request->get('project_name'),
            'description' => $request->get('project_description'),
            'start_date' => $request->get('project_date'),
            'end_date' => $request->get('project_deadline'),
            'privacy' => $privacy,
            'id_coordinator' => $userId
        ]);

        return redirect($userId.'/userProjects')->with('success', 'Project Created!');
    }

    public function team(Request $request){

        $projectId=$request->get('project');
        $team=ProjectTeam::create([
            'id_user'=>$request->get('user'),
            'id_project'=>$projectId
        ]);

        return redirect($projectId.'/projectTeam')->with('success', 'Team member added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
