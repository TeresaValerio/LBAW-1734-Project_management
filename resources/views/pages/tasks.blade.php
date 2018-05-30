@extends('layouts.projects')


@section('content')

<title>Tasks | {{$board->name}}</title>
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
            <li>
            <?php  $project=DB::table('board')->where('id',$board->id)->value('id_project') ?>
            <a href="{{ url($project.'/projectBoards') }}"> {{ $member=DB::table('projects')->where('id',$project)->value('name') }}</a>
            </li>
            <li class="active">
                {{ $board->name }}
            </li>
        </ol>
    </div>
    <!-- Header -->

    <!-- Main -->
    <div class="container-fluid display-table" style="padding: 10px">
        <div class="row display-table-row">
            <!-- /input-group -->
            <div class="input-group" style="padding-bottom:10px">
                <input type="text" class="form-control" placeholder="Search tasks...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Search</button>
                </span>
            </div>
            <!-- /input-group -->

            <div class="row">
                <div class="well">
                    <div class="row">
                        <div class="col-sm-3">
                            <a href="#" data-toggle="modal" data-target="#new-task-modal">
                                <button align="center" type="button" class="btn btn-info btn-circle">
                                    <i class="glyphicon glyphicon-plus"></i> 
                                </button>
                                <h4> <font color="#7ABED3">
                                                <strong>Create Task</strong> </font>
									        </h4>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="#" data-toggle="modal" data-target="#new-member-modal">
                                <button type="button" class="btn btn-info btn-circle">
                                    <i class="glyphicon glyphicon-plus"></i> 
                                </button>
                                <h4> <font color="#7ABED3">
                                                <strong>Add Member</strong> </font>
									        </h4>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="#" data-toggle="modal" data-target="#new-meeting-modal">
                                <button type="button" class="btn btn-info btn-circle">
                                    <i class="glyphicon glyphicon-plus"></i> 
                                </button>
                                <h4> <font color="#7ABED3">
                                                <strong>Schedule Meeting</strong> </font>
									        </h4>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="well">
                    <div class="row text-center">
                        @foreach ($tasks_ids as $id)
                        <div class="col-sm-4">
                            <div class="card" style="width:400px;">
                                <div class="card-content">
                                    <div class="card-header" style="width:400px;">
                                        <p>
                                            <strong>
                                                <h3>{{ $task=DB::table('task')->where('id',$id)->value('name') }}</h3>
                                            </strong>
                                        </p>
                                    </div>
                                    <div class="card-body" >
                                        <div class="row">
                                        <?php $creator_ids=DB::table('task')->where('id',$id)->value('id_creator') ?>
                                        <?php $picture=DB::table("profile_picture")->where("id_user",$creator_ids)->value("path") ?>
                                                <img alt="user picture" src="{{URL::asset($picture)}}" style="height:50px;">
                                            <h4>
                                                <strong>
                                                    Task created by:
                                                </strong>
                                            </h4>
                                            <p>
                                            {{ $creator_ids=DB::table('users')->where('id',$creator_ids)->value('full_name') }}
                                            </p>
                                        </div>
                                        <div class="row">
                                            <hr />
                                            <p>
                                                <strong>
                                                    <h4>Description:</h4>
                                                </strong>
                                                {{ $creator_ids=DB::table('task')->where('id',$id)->value('description') }}
                                            </p>
                                            <hr />
                                        <h4>
                                            <strong>Deadline:</strong> {{ $creator_ids=DB::table('task')->where('id',$id)->value('deadline') }}
                                        </h4>
                                        <?php // Set your timezone!!
                                        date_default_timezone_set('Europe/Lisbon');
 
                                        // Get prev & next month
                                        if (isset($_GET['ym'])) {
                                            $ym = $_GET['ym'];
                                        } else {
                                         // This month
                                        $ym = date('Y-m');
                                        }
 
                                        // Check format
                                        $timestamp = strtotime($ym . '-01');
                                        if ($timestamp === false) {
                                            $timestamp = time();
                                        }
 
                                        // Today
                                        $today = date('Y-m-j', time());
                                        ?>
                                        <p>
                                            <strong>Progress:</strong>
                                        </p>
                                        <div class="progress">
                                            @if ($creator_ids=DB::table('task')->where('id',$id)->value('progress') < 100 && $today < $deadline_date=DB::table('task')->where('id',$id)->value('deadline'))
                                            <div class="progress-bar progress-bar-info" role="progressbar" style="width: {{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}%" aria-valuenow="{{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}" aria-valuemin="0" aria-valuemax="100">{{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}%</div>
                                            @elseif ($creator_ids=DB::table('task')->where('id',$id)->value('progress') < 100 && $today > $deadline_date=DB::table('task')->where('id',$id)->value('deadline'))
                                            <div class="progress-bar progress-bar-danger" role="progressbar" style="width: {{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}%" aria-valuenow="{{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}" aria-valuemin="0" aria-valuemax="100">{{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}%</div>
                                            @elseif ($creator_ids=DB::table('task')->where('id',$id)->value('progress') === 100)
                                            <div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}%" aria-valuenow="{{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}" aria-valuemin="0" aria-valuemax="100">{{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}%</div>
                                            @endif
                                        </div>

                                        @if ($creator_ids=DB::table('task')->where('id',$id)->value('progress') < 100 && $today < $deadline_date=DB::table('task')->where('id',$id)->value('deadline'))
                                        <a href="#" data-upid="{{ $id }}" data-toggle="modal" data-target="#update-task-modal">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            <strong>Update</strong>
                                        </a>
                                        @elseif ($creator_ids=DB::table('task')->where('id',$id)->value('progress') < 100 && $today > $deadline_date=DB::table('task')->where('id',$id)->value('deadline'))
                                        <p>
                                            <i class="fa fa-exclamation-triangle"></i>
                                            <strong>Deadlined Surpassed!</strong>
                                        </p>
                                        <a href="#" data-upid="{{ $id }}" data-toggle="modal" data-target="#update-task-modal">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            <strong>Update</strong>
                                        </a>
                                        @else
                                        <p>
                                            <i class="fa fa-check-circle" style="font-size: 15px"></i>
                                            <strong>Task Completed!</strong>
                                        </p>
                                        @endif

                                        <a id="see-more-button" href="#" dir="{{ $id }}" data-toggle="modal" data-target="#see-more-task-modal">
                                            <button id="see_more_task_details_btn" type="button" class="btn btn-link">See more</button>
                                        </a>
                                    </div>
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
    <script>
$(document).ready(function() {
$('#see-more-button').click(function(){
var record_id = $(this).attr('dir');
$('.record_id').val(record_id);
});
});
</script>

    <!-- Modal New Task -->
    <div class="modal fade" id="new-task-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #7ABED3; color: #fff">
                        <strong>Create new task</strong>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </div>
                    <!-- Begin # DIV Form -->
                    <div id="div-forms">
                        <!-- Begin # Login Form -->
    
                        <form id="login-form" action="/addTask" method='post'>
                            <div class="modal-body">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_board" value="{{$board->id}}">

                                <div id="div-register-msg">
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">Name <strong style="font-size: 12px">(Required!)</strong></span>
                                </div>
                                <input id="task_name" name="task_name" class="form-control" type="name" placeholder="Task name" required>
                                
                                <div id="div-register-msg">
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">Description</span>
                                </div>
                                <input id="task_description" name="task_description" class="form-control" type="description" placeholder="Task description"> 

                                <div id="div-register-msg">
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">Budget</span>
                                </div>
                                <input id="task_budget" name="task_budget" class="form-control" type="number" placeholder="Task Budget"> 

                                <div id="div-register-msg">
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">Deadline <strong style="font-size: 12px">(Required!)</strong></span>
                                </div>
                                <input type="date" name="task_deadline" value="task_deadline" required> 
    
                            </div>
    
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-info btn-lg btn-block">Create task</button>
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



    <!-- Modal Update Task -->
    <div class="modal fade" id="update-task-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <p>
                    <input type="hidden" name="identification" />
                        <strong>Update
                            <i>{{ $task=DB::table('task')->where('id',$id)->value('name') }}</i>
                        </strong>
                    </p>
                </div>
                <!-- Begin # DIV Form -->
                <div id="div-forms">
                    <!-- Begin # Login Form -->
                    <form id="login-form">
                        <div class="modal-body">

                            <div id="div-register-msg">
                                <p>
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">
                                        <strong>Comment</strong>
                                    </span>
                                </p>
                            </div>
                            <input id="task_update_commentaries" class="form-control" type="text" placeholder="Commentaries" required>

                            <div id="div-register-msg">
                                <p>
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">
                                        <strong>Update Progress</strong>
                                    </span>
                                </p>
                            </div>
                            <select>
                                <option value="0">0 %</option>
                                <option value="10">10 %</option>
                                <option value="20">20 %</option>
                                <option value="30">30 %</option>
                                <option value="40">40 %</option>
                                <option value="50">50 %</option>
                                <option value="60">60 %</option>
                                <option value="70">70 %</option>
                                <option value="80">80 %</option>
                                <option value="90">90 %</option>
                                <option value="100">100 %</option>
                            </select>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Close task
                                </label>
                                <p>(A message will be sent to the task's coordinator for approval)</p>
                            </div>

                            <p><strong>NOTE:</strong> You must fill at least one of the fields</p>
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-info btn-lg btn-block">Update</button>
                                </div>
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



    <!-- Modal See more Task -->
    <div class="modal fade" id="see-more-task-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" align="center">
                <input type="hidden" class="record_id" value="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <p>
                        <strong><input type="hidden" class="record_id" value="">{{ $task=DB::table('task')->where('id',$id)->value('name') }}</strong>
                    </p>
                </div>
                <?php 
                    $progress_ids=DB::table('progress_update')->where('id_task',$id)->pluck('id');
                    $comments_ids=DB::table('comment')->where('id_task',$id)->pluck('id');
                ?>
                @foreach ($progress_ids as $p_ids)
                <div class="thumbnail">
                    <p>
                        <?php $id_user=DB::table('progress_update')->where('id',$p_ids)->value('id_user')?>
                        <div id="icon-register-msg" class="glyphicon glyphicon-pushpin"></div>
                        <strong>Updated on </strong>
                        <i>{{$date=DB::table('progress_update')->where('id',$p_ids)->value('date')}}</i> by
                        <i>{{$user=DB::table('users')->where('id',$id_user)->value('full_name')}}</i>
                    </p>
                    <p><strong>Progress: </strong><i>{{$progress=DB::table('progress_update')->where('id',$p_ids)->value('new_value')}}</i>%</p>
                </div>
                @endforeach
                
                <div class="thumbnail">
                @foreach ($comments_ids as $c_ids)
                    <p>
                        <?php $id_user=DB::table('comment')->where('id',$c_ids)->value('id_user')?>
                        <i>{{$date=DB::table('comment')->where('id',$c_ids)->value('date')}}</i> by
                        <i>{{$user=DB::table('users')->where('id',$id_user)->value('full_name')}}</i>
                    </p>
                    <p><strong>Comment: </strong><i>{{$comment=DB::table('comment')->where('id',$c_ids)->value('comment')}}</i></p>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
    <!-- END # MODAL LOGIN -->


    <!-- Modal New team member -->
    <div class="modal fade" id="new-member-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #7ABED3; color: #fff">
                        <strong>Add new team member</strong>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </div>
                    <!-- Begin # DIV Form -->
                    <div id="div-forms">
                        <!-- Begin # Login Form -->
    
                        <form id="login-form" action="/addTeamBoard" method='post'>
                            <div class="modal-body">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_board" value="{{$board->id}}">
                            <?php
                                
                                $team_project=DB::table('project_team')->where('id_project',$project)->pluck('id_user');
                            ?>
                            @foreach($team_project as $person)
                                <?php $team_board=DB::table('board_team')->where('id_user',$person)->value('id_user'); ?>
                                @if ($team_board == NULL )
                                <div class=row>
                                <?php
                                    if (DB::table("profile_picture")->where("id_user",$person)->value("path")){
                                        $picture=DB::table("profile_picture")->where("id_user",$person)->value("path");
                                    }
                                    else{
                                        $picture='https://visit.nemedic.com/storage/default.jpg';
                                    }
                                ?>
                                <img alt="user picture" src="{{URL::asset($picture)}}" style="height:30px;" title="{{$name=DB::table('users')->where('id',$person)->value('full_name')}}">
                                <input type="checkbox" name="teamMember[{{$person}}]" value="{{$person}}"> {{$user=DB::table('users')->where('id',$person)->value('full_name')}}
                                </div>
                                @endif
                            @endforeach
                            </div>
    
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-info btn-lg btn-block">Add</button>
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

    <!-- Modal New meeting -->
    <div class="modal fade" id="new-meeting-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #7ABED3; color: #fff">
                        <strong>Schedule new meeting</strong>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </div>
                    <!-- Begin # DIV Form -->
                    <div id="div-forms">
                        <!-- Begin # Login Form -->
    
                        <form id="login-form" action="/addMeeting" method='post'>
                            <div class="modal-body">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id_board" value="{{$board->id}}">
                            
                                <div id="div-register-msg">
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">Date <strong style="font-size: 12px">(Required!)</strong></span>
                                </div>
                                <input name="meeting_date" type="date" value="date" required >

                                <div id="div-register-msg">
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">Place</span>
                                </div>
                                <input name="meeting_place" id="meeting_place" class="form-control" type="text" placeholder="Meeting place">

                                <div id="div-register-msg">
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">Name</span>
                                </div>
                                <input name="meeting_name" id="meeting_name" class="form-control" type="text" placeholder="Meeting name">
                            
                            </div>
    
                            <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-info btn-lg btn-block">Schedule</button>
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
