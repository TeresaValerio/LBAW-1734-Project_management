@extends('layouts.user')

@section('content')
<title>Projects | {{$userAuth=auth()->user()->full_name}}</title>
<!-- Header -->
    <div class="header container-fluid main-color-bg">
        <ol class="breadcrumb">
        <li>
                <?php  $userAuth=auth()->user()->id  ?>
                <a href={{ url($userAuth.'/personalInfo')}}> {{ $member=DB::table('users')->where('id',$userAuth)->value('full_name') }}</a>
            </li>
            <li class="active">
                Projects
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
                            <a href={{ url($person->id.'/userProjects') }}>
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Projects</span>
                            </a>
                        </li>
                        <li>
                            <a href={{ url($person->id.'/personalInfo') }}>
                                <i class="fa fa-info" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Personal Info</span>
                            </a>
                        </li>
                        <li>
                            <a href={{ url($person->id.'/userCalendar') }}>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Calendar</span>
                            </a>
                        </li>
                        <li>
                            <a href={{ url($person->id.'/userContacts') }}>
                                <i class="fa fa-info" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Contacts</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <div class="user-dashboard">
                    <!-- /input-group -->
                    <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search projects...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search</button>
                        </span>
                    </div>
                    <table class="table table-striped table-bordered">
                        
                    </table>

                    <!-- /input-group -->
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12 gutter">
                            <div class="created">
                                <h2>Created ({{count($created_ids)}})</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="well">
                            <div class="row">
                                <div class="col-sm-3">
                                    <a href="#" data-toggle="modal" data-target="#new-project-modal">
                                        <button type="button" class="btn btn-info btn-circle">
                                            <i class="glyphicon glyphicon-plus"></i> 
                                        </button>
                                        Create project
                                    </a>
                                </div>
                            </div>
                            <div class="row text-center">
                            @foreach ($created_ids as $id)
                                <div class="col-sm-3">
                                    <div class="card" style="width:250px;">
                                        <div class="card-content" align="center">
                                            <div class="card-header" style="width:250px;">
                                                <h4>
                                                    <strong>{{ $project=DB::table('projects')->where('id',$id)->value('name') }} </strong>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                if (DB::table("project_picture")->where("id_project",$id)->value("path")){
                                                    $picture=DB::table("project_picture")->where("id_project",$id)->value("path");
                                                }
                                                else{
                                                    $picture='https://cdn2.iconfinder.com/data/icons/medicine-3-1/512/checklist-512.png';
                                                }
                                                ?>
                                                <img src="{{URL::asset($picture)}}" style="height:125px;">
                                                <hr />
                                                <a href={{ url($id.'/projectInfo') }}>
                                                    <p>See more</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12 gutter">
                            <div class="working on">
                                <h2>Working on ({{count($working_ids)}}) </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="well">
                            <div class="row text-center">
                            @foreach($working_ids as $id)
                                <div class="col-sm-3">
                                    <div class="card" style="width:250px;">
                                        <div class="card-content" align="center">
                                            <div class="card-header" style="width:250px;">
                                                <h4>
                                                    <strong> {{ $project=DB::table('projects')->where('id',$id)->value('name') }}</strong>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <?php
                                                    if (DB::table("project_picture")->where("id_project",$id)->value("path")){
                                                        $picture=DB::table("project_picture")->where("id_project",$id)->value("path");
                                                    }
                                                    else{
                                                        $picture='https://cdn2.iconfinder.com/data/icons/medicine-3-1/512/checklist-512.png';
                                                    }    
                                                ?>
                                                <img src="{{URL::asset($picture)}}" style="height:125px;">
                                                <hr />
                                                <a href={{ url($id.'/projectInfo') }}>
                                                    <p>See more </p>
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
    </div>

    <!-- Modal New Project -->
    <div class="modal fade" id="new-project-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #7ABED3; color: #fff">
                    <strong>Create new project</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                </div>
                <!-- Begin # DIV Form -->
                <div id="div-forms">
                    
                    <!-- Begin # Create project Form -->
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <ul>
                            @foreach($errors->all() as $error)
                                <li> {{$error}} </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(\Session::has('success'))
                        <div class="alert alert-success">
                            <p> {{\Session::get('success') }} </p>
                        </div>
                    @endif
                    <form id="login-form" action= "/project" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="modal-body">
                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Name</span>
                            </div>
                            <input name="project_name" id="project_name" class="form-control" type="text" placeholder="Project name" required>
                            
                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Description</span>
                            </div>
                            <input name="project_description" id="project_name" class="form-control" type="text" placeholder="Project description">

                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Start date</span>
                            </div>
                            <input name="project_date" type="date" value="start_date" > 

                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Deadline</span>
                            </div>
                            <input name="project_deadline" type="date" value="start_date" > 
                            
                            <input type="checkbox" name="project_public" value="true" default="false"> Public project

                        </div>

                        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-info btn-lg btn-block">Create project</button>
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

<script>
$(document).ready(function(){

    fetch_project_data();

    function fetch_project_data(query=''){
        $.ajax({
            url:"{{route('userProjects.search')}}",
            method:'GET',
            data:{query:query},
            dataType:'json',
            success:function(data){
                $('table').html(data.table_data);
                $('#total_records').text(data.total_data);
            }
        })
    }

    $(document).on('keyup','#search',function(){
        var query=$(this).val();
        fetch_customer_data(query);
    })

})
</script>