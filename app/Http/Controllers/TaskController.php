<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;

class TaskController extends Controller
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
        return view('/tasks');
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
            'task_name' => 'required',
            'id_board'=>'required',
        ]);
        
        $boardId=$request->get('id_board');

        $task=Task::create([
            'budget'=>$request->get('task_budget'),
            'name' => $request->get('task_name'),
            'description' => $request->get('task_description'),
            'deadline' => $request->get('task_deadline'),
            'progress' => 0,
            'task_state' => 'In_progress',
            'id_creator' => $userId,
            'id_board'=>$boardId
        ]);

        return redirect($boardId.'/tasks')->with('success', 'Task Created!');
    }

    public function team(Request $request){

        $teamMembers=$request->get('teamMember');

        if ($teamMembers != NULL){
            foreach ($teamMembers as $person){
                $team=BoardTeam::create([
                    'id_board'=>$request->get('id_board'),
                    'id_user'=>$request->$person
                ]);
            }
        }

        return redirect($boardId.'/tasks')->with('success', 'Team member added!');

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
