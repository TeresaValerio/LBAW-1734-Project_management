@extends('layouts.projects')


@section('content')
<!-- Header -->
<div class="header container-fluid main-color-bg">
        <ol class="breadcrumb ">
            <li>
                <a href="user.html">Inês Gonçalves</a>
            </li>
            <li>
                <a href="project.html">
                {{ $project->name }}
                </a>
            </li>
            <li class="active">
                Team
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
                        <li>
                            <a href={{ url($project->id.'/projectBoards') }}>
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Boards</span>
                            </a>
                        </li>
                        <li>
                            <a href="projectInfo.html">
                                <i class="fa fa-info" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Info</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href={{ url($project->id.'/projectTeam') }}>
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Team</span>
                            </a>
                        </li>
                        <li>
                            <a href="projectCalendar.html">
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
                        <input type="text" class="form-control" placeholder="Search workers...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search</button>
                        </span>
                    </div>
                    <!-- /input-group -->
                    <div class="row">
                        <div class="well" style="margin:0">
                            <div class="row">
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-info btn-circle">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </button>
                                </div>
								<div>
									<h4> <font color="#7ABED3">
										<strong>Add team member</strong> </font>
									</h4>
								</div>
                            </div>
                            <div class="row ">
                            @foreach ($team_ids as $id)
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-content" align="center">
                                            <div class="card-header">
                                                <h4>
                                                    <strong>{{ $member=DB::table('users')->where('id',$id)->value('full_name') }}</strong>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <img src="/img/profile.jpg" class="img-circle" alt="User Picture" style="padding: px; width:80px;height:80px;">
                                                <hr />
                                                <p>
                                                    <strong>Username:</strong>
                                                    <br />{{ $member=DB::table('users')->where('id',$id)->value('username')}}
												</p>
                                                <p>
                                                    <strong>Email:</strong>
                                                    <br /> {{ $member=DB::table('users')->where('id',$id)->value('e_mail') }}
												</p>
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

@endsection
