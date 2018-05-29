<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\BoardTeam;
use Auth;

class BoardController extends Controller
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
        return view('/projectBoard');
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
            'board_name' => 'required',
            'id_project'=>'required'
        ]);

        $projectId=$request->get('id_project');

        $board=Board::create([
            'name' => $request->get('board_name'),
            'description' => $request->get('board_description'),
            'board_state' => 'In_progress',
            'id_creator' => $userId,
            'id_project'=>$projectId,
        ]);

        return redirect($projectId.'/projectBoards')->with('success', 'Board Created!');
    }

    public function team(Request $request){
        
        $this->validate($request,[
            'userID'=>'required',
            'boardID'=>'required'
        ]);

        $team=BoardTeam::create([
            'id_user'=>$request->get('userID'),
            'id_board'=>$request->get('boardID')
        ]);
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
