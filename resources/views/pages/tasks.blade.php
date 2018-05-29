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
                                <button type="button" class="btn btn-info btn-circle">
                                    <i class="glyphicon glyphicon-plus"></i> 
                                </button>
                                Create task
                            </a>
                        </div>
                    </div>
                    <div class="row text-center">
                        @foreach ($tasks_ids as $id)
                        <div class="col-sm-3">
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
                                                <img src="{{URL::asset($picture)}}" style="height:50px;">
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

                                        <p>
                                            <strong>Progress:</strong>
                                        </p>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-info" role="progressbar" style="width: {{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}%" aria-valuenow="{{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}" aria-valuemin="0" aria-valuemax="100">{{ $creator_ids=DB::table('task')->where('id',$id)->value('progress') }}%</div>
                                        </div>


                                        <a href="#" data-toggle="modal" data-target="#update-task-modal">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                            <strong>Update</strong>
                                        </a>

                                        <a href="#" data-toggle="modal" data-target="#see-more-task-modal">
                                            <button id="see_more_task_details_btn" type="button" class="btn btn-link">See more</button>
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
                                    <span id="text-register-msg">Name</span>
                                </div>
                                <input id="task_name" name="task_name" class="form-control" type="name" placeholder="Task name">
                                
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
                                    <span id="text-register-msg">Deadline</span>
                                </div>
                                <input type="date" name="task_deadline" value="task_deadline" > 
    
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
                        <strong>Update
                            <i>*Task name*</i>
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
                                        <strong>Update's commentaries *</strong>
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

                            <div>
                                <p>
                                    <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                    <span id="text-register-msg">
                                        <strong>Upload file </strong>
                                    </span>
                                    <div id="icon-register-msg" class="glyphicon glyphicon-paperclip"></div>
                                </p>
                            </div>
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="fileToUpload" id="fileToUpload">
                            </form>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Close task
                                </label>
                                <p>(A message will be sent to the task's coordinator for approval)</p>
                            </div>

                            <div>
                                <p>
                                    <strong>NOTE: Sections marked with * are of mandatory filling.</strong>
                                </p>
                            </div>

                            <div class="modal-footer">
                                <div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <p>
                        <strong>Task Name</strong>
                    </p>
                </div>

                <div class="thumbnail">
                    <p>
                        <div id="icon-register-msg" class="glyphicon glyphicon-pushpin"></div>
                        <strong>Updated on </strong>
                        <i>*dd-mm-yyyy*</i> by
                        <i>*Username*</i>
                    </p>
                    <p>
                        <strong>Changes made:</strong>
                    </p>
                    <p>Progress from xx % to yy %</p>
                    <p>
                        <u>Description: </u>Proident enim sint amet exercitation est aliquip ullamco elit proident ea commodo
                        et pariatur dolore. Laborum eiusmod nostrud esse elit non occaecat duis est. Quis nisi proident nisi
                        exercitation ut fugiat labore. Do dolore officia officia cillum irure laborum qui quis nostrud laborum.
                        Aliqua sit aute labore aliqua nostrud incididunt sunt sunt consequat cillum dolor sint id. In in
                        consequat adipisicing excepteur incididunt. Nulla esse aliquip mollit est anim duis reprehenderit
                        qui ut labore.</p>
                </div>

                <div class="thumbnail">
                    <p>
                        <div id="icon-register-msg" class="glyphicon glyphicon-pushpin"></div>
                        <strong>Updated on </strong>
                        <i>*dd-mm-yyyy*</i> by
                        <i>*Username*</i>
                    </p>
                    <p>
                        <strong>Changes made:</strong>
                    </p>
                    <p>Progress from xx % to yy %</p>
                    <p>
                        <u>Description: </u>Aliqua sit aute labore aliqua nostrud incididunt sunt sunt consequat cillum dolor
                        sint id. In in consequat adipisicing excepteur incididunt. Nulla esse aliquip mollit est anim duis
                        reprehenderit qui ut labore.</p>
                </div>

                <div class="thumbnail">
                    <p>
                        <div id="icon-register-msg" class="glyphicon glyphicon-pushpin"></div>
                        <strong>Updated on </strong>
                        <i>*dd-mm-yyyy*</i> by
                        <i>*Username*</i>
                    </p>
                    <p>
                        <strong>Changes made:</strong>
                    </p>
                    <p>Progress from xx % to yy %</p>
                    <p>
                        <u>Description: </u>Proident enim sint amet exercitation est aliquip ullamco elit proident ea commodo
                        et pariatur dolore. Laborum eiusmod nostrud esse elit non occaecat duis est. </p>
                </div>

            </div>
        </div>
    </div>
    <!-- END # MODAL LOGIN -->

@endsection
