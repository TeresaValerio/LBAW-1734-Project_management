@extends('layouts.projects')


@section('content')
<title>Boards | {{$project->name}}</title>

<style>
.img_title {
    display: table;
    background: #888888;
    position: absolute;
}
.image_container {
    cursor: none;
    display: table;    
}
</style>
<!-- Header -->
<div class="header container-fluid main-color-bg">
        <ol class="breadcrumb ">
            <li>
                <?php  $userAuth=auth()->user()->id  ?>
                <a href={{ url($userAuth.'/personalInfo')}}> {{ $member=DB::table('users')->where('id',$userAuth)->value('full_name') }}</a>
            </li>
            <li class="active">
            {{ $project->name }}
            </li>
        </ol>
    </div>
    <!-- Header -->

    <!-- Main -->
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="navi">
                    <ul>
                        <li class="active">
                            <a href={{ url($project->id.'/projectBoards') }}>
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Boards</span>
                            </a>
                        </li>
                        <li>
                            <a href={{ url($project->id.'/projectInfo') }}>
                                <i class="fa fa-info" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Info</span>
                            </a>
                        </li>
                        <li>
                            <a href={{ url($project->id.'/projectTeam') }}>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Team</span>
                            </a>
                        </li>
                        <li>
                        <a href={{ url($project->id.'/projectCalendar') }}>
                <i class="fa fa-calendar" aria-hidden="true"></i>
                <span class="hidden-xs hidden-sm">Calendar</span>
              </a>
                        </li>
                        <li>
                            <a href="projectForum.html">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Forum</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <div class="user-dashboard">
                    <!-- /input-group -->
                    <div class="input-group" style="padding-bottom:10px">
                        <input type="text" class="form-control" placeholder="Search boards...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search</button>
                        </span>
                    </div>
                    <!-- /input-group -->
                    <div class="row">
                        <div class="well" style="margin:0">
                            <div class="row">
                                <div class="col-sm-10">
                                    <a href="#" data-toggle="modal" data-target="#new-board-modal">
                                        <button type="button" class="btn btn-info btn-circle">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
									        <h4> <font color="#7ABED3">
                                                <strong>Create board</strong> </font>
									        </h4>
                                    </a>
                                </div>
								
                            </div>
                            <div class="row text-center">
                                @foreach ($boards_ids as $id)
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-header">
                                                <h3>
                                                    <strong>{{ $board=DB::table('board')->where('id',$id)->value('name') }}</strong>
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <h4>
                                                    Recent activity:
                                                </h4>
                                                <div>
                                                    <p>
                                                        <strong>Inês Gonçalves</strong> joined the board on 01-03-2018.
                                                    </p>
                                                </div>
                                                <hr />
                                                <p>
                                                    <strong>
                                                        <h4>Board Members</h4>
                                                    </strong>
                                                </p>

                                                <div class="row">
                                                <?php
                                                    $team_ids = DB::table('board_team')->where('id_board',$id)->pluck('id_user');
                                                    $me=auth()->user()->id;
                                                    $coordinator=DB::table('projects')->where('id',$project->id)->value('id_coordinator');
                                                ?>
                                                
                                                @if ($coordinator != $me)
                                                    <?php
                                                        if (DB::table("profile_picture")->where("id_user",$coordinator)->value("path")){
                                                            $picture=DB::table("profile_picture")->where("id_user",$coordinator)->value("path");
                                                        }
                                                        else{
                                                            $picture='https://visit.nemedic.com/storage/default.jpg';
                                                        }
                                                    ?>
                                                    <img src="{{URL::asset($picture)}}" style="height:30px;" title="{{$name=DB::table('users')->where('id',$coordinator)->value('full_name')}}">
                                                @endif
                                                
                                                    <?php
                                                        if (DB::table("profile_picture")->where("id_user",$me)->value("path")){
                                                            $picture=DB::table("profile_picture")->where("id_user",$me)->value("path");
                                                        }
                                                        else{
                                                            $picture='https://visit.nemedic.com/storage/default.jpg';
                                                        }
                                                    ?>
                                                    <img src="{{URL::asset($picture)}}" style="height:30px;" title="{{$name=DB::table('users')->where('id',$me)->value('full_name')}}">
                                                
                                                @foreach ($team_ids as $t_id)
                                                    <?php
                                                         if (DB::table("profile_picture")->where("id_user",$t_id)->value("path")){
                                                            $picture=DB::table("profile_picture")->where("id_user",$t_id)->value("path");
                                                        }
                                                        else{
                                                            $picture='https://visit.nemedic.com/storage/default.jpg';
                                                        }
                                                    ?>
                                                    <img src="{{URL::asset($picture)}}" style="height:30px;" title="{{$name=DB::table('users')->where('id',$t_id)->value('full_name')}}">
                                                @endforeach

                                                </div>
                                                <hr />
                                                <a href={{ url($id.'/tasks') }}>
                                                    <button id="see_more_tasks_btn" type="button" class="btn btn-link">See more</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal New Project -->
    <div class="modal fade" id="new-board-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #7ABED3; color: #fff">
                    <strong>Create new board</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                </div>
                <!-- Begin # DIV Form -->
                <div id="div-forms">
                    <!-- Begin # Login Form -->

                    <form id="login-form" action='/addBoard' method='post'>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id_project" value="{{$project->id}}">
                        
                        <div class="modal-body">
                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Name</span>
                            </div>
                            <input name="board_name" id="board_name" class="form-control" type="name" placeholder="Board name">
                            
                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Description</span>
                            </div>
                            <input name="board_description" id="board_description" class="form-control" type="description" placeholder="Board description"> 
                        
                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Add members</span>
                                <div class="row" style="padding-left:15px" style="padding-left:5px">
                                    
                                    <?php
                                        $team_ids = DB::table('project_team')->where('id_project',$project->id)->pluck('id_user');
                                        $me=auth()->user()->id;
                                        $coordinator=DB::table('projects')->where('id',$project->id)->value('id_coordinator');
                                    ?>
                                                
                                    @if ($coordinator != $me)
                                    <?php
                                        if (DB::table("profile_picture")->where("id_user",$coordinator)->value("path")){
                                            $picture=DB::table("profile_picture")->where("id_user",$coordinator)->value("path");
                                        }
                                        else{
                                            $picture='https://visit.nemedic.com/storage/default.jpg';
                                        }
                                    ?>
                                    <p>
                                        <img src="{{URL::asset($picture)}}" style="height:30px;" title="{{$name=DB::table('users')->where('id',$coordinator)->value('full_name')}}">
                                        {{$name=DB::table('users')->where('id',$coordinator)->value('full_name')}}
                                    </p>
                                    @endif
                                                
                                    <?php
                                        if (DB::table("profile_picture")->where("id_user",$me)->value("path")){
                                            $picture=DB::table("profile_picture")->where("id_user",$me)->value("path");
                                        }
                                        else{
                                            $picture='https://visit.nemedic.com/storage/default.jpg';
                                        }
                                    ?>
                                    <p> 
                                        <img src="{{URL::asset($picture)}}" style="height:30px;" title="{{$name=DB::table('users')->where('id',$me)->value('full_name')}}">
                                        {{$name=DB::table('users')->where('id',$me)->value('full_name')}}
                                    </p>
                                                
                                    @foreach ($team_ids as $t_id)
                                    @if ($t_id != $me)
                                    <?php
                                        if (DB::table("profile_picture")->where("id_user",$t_id)->value("path")){
                                            $picture=DB::table("profile_picture")->where("id_user",$t_id)->value("path");
                                        }
                                        else{
                                            $picture='https://visit.nemedic.com/storage/default.jpg';
                                        }
                                    ?>
                                    <img src="{{URL::asset($picture)}}" style="height:30px;" title="{{$name=DB::table('users')->where('id',$t_id)->value('full_name')}}">
                                    <input type="checkbox" name="member"> {{$name=DB::table('users')->where('id',$t_id)->value('full_name')}}
                                    @endif
                                    @endforeach

                                </div>
                            </div>
                            

                        </div>

                        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-info btn-lg btn-block">Create board</button>
                            </div>
                        </div>

                    </form>

                    <!-- End # Login Form -->
                </div>
                <!-- End # DIV Form -->
            </div>
        </div>
    </div>
    <!-- END # MODAL LOGIN -->

@endsection
