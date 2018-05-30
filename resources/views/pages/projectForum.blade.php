@extends('layouts.projects')


@section('content')

<title>Forum | {{$project->name}}</title>
<link rel="stylesheet" href="/CSS/forum.css">

<!-- Header -->
<div class="header container-fluid main-color-bg">
        <ol class="breadcrumb ">
        <li>
                <?php  $userAuth=auth()->user()->id  ?>
                <a href={{ url($userAuth.'/personalInfo')}}> {{ $member=DB::table('users')->where('id',$userAuth)->value('full_name') }}</a>
            </li>
            <li>
            <a href="{{ url($project->id.'/projectBoards') }}">
                {{ $project->name }}
                </a>
            </li>
            <li class="active">
                Forum
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
                        <li class="active">
                        <a href={{ url($project->id.'/projectForum') }}>
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Forum</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <div class="user-dashboard">
                    <div class="panel-body">
                        <ul class="chat">
                            @foreach ($messages_ids as $id)
                            <?php
                                $user=DB::table('message')->where("id",$id)->value("id_user");
                            ?>
                            @if ($user != $userAuth=auth()->user()->id)
                            <li class="left clearfix">
                                <span class="chat-img pull-left">
                                <?php
                                if (DB::table("profile_picture")->where("id_user",$user)->value("path")){
                                    $picture=DB::table("profile_picture")->where("id_user",$user)->value("path");
                                }
                                else{
                                    $picture='https://visit.nemedic.com/storage/default.jpg';
                                }
                                ?>
                                <img src="{{URL::asset($picture)}}" alt="User Avatar" class="img-circle" width="50" height="50" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">{{$name=DB::table('users')->where("id",$user)->value('full_name')}}</strong>
                                        <small class="pull-right text-muted">
                                            <span class="glyphicon glyphicon-time"></span>{{$date=DB::table('message')->where("id",$id)->value('date')}}</small>
                                    </div>
                                    <p>
                                    {{$message=DB::table('message')->where("id",$id)->value('message')}}
                                    </p>
                                </div>
                            </li>
                            @else
                            <li class="right clearfix">
                                <span class="chat-img pull-right">
                                <?php
                                if (DB::table("profile_picture")->where("id_user",$user)->value("path")){
                                    $picture=DB::table("profile_picture")->where("id_user",$user)->value("path");
                                }
                                else{
                                    $picture='https://visit.nemedic.com/storage/default.jpg';
                                }
                                ?>
                                <img src="{{URL::asset($picture)}}" alt="User Avatar" class="img-circle" width="50" height="50" />
                                </span>
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="pull-right primary-font">{{$name=DB::table('users')->where("id",$user)->value('full_name')}}</strong>
                                        <small class="text-muted">
                                            <span class="glyphicon glyphicon-time"></span>{{$date=DB::table('message')->where("id",$id)->value('date')}}</small>
                                    </div>
                                    <p align="right">
                                    {{$message=DB::table('message')->where("id",$id)->value('message')}}
                                    </p>
                                </div>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer"> 
                        <form id="login-form" action= "/sendMessage" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id_project" value="{{$project->id}}">

                        <div>
                            <span class="input-group-btn">
                                <input name="message_text" id="message_text" class="form-control" type="text" placeholder="Write your message here..." required>
                                <button class="btn btn-warning btn-sm" id="btn-chat">
                                    Send</button>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
