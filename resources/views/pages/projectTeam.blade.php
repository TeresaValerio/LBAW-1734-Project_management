@extends('layouts.projects')


@section('content')

 <title>Team | {{$project->name}}</title>
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
                Team
            </li>
        </ol>
    </div>
    <!-- Header -->


    <!-- Main -->
    <?php $ids = $team_ids; ?>
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
                        <li class="active">
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
                    
                    <!-- Begin # Create project Form -->
                    <?php
                        if( isset($_GET['search_button']) )
                        {
                            //be sure to validate and clean your variables
                            if($_GET['search'] === ""){
                                $ids = $team_ids;
                            }
                            else
                            //then you can use them in a PHP function. 
                            {
                                $val1 = htmlentities($_GET['search']);
                            
                                $ids = DB::table('users')
                                ->whereRaw("to_tsvector(username||' '||full_name||' '||e_mail) @@ to_tsquery('$val1')")
                                ->pluck('id');
                            }
                        }
                    ?>
                    <form method="get">
                        <div class="input-group" style="padding-bottom:10px">
                        
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search to find new workers...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="search_button" >Search</button>
                            </span>
                            
                        </div>
                    </form>
                    <!-- End # Login Form -->

                    <div class="row">
                        <div class="well" style="margin:0">
                            <div class="row ">
                                <?php  $userAuth = auth()->user()->id ?>
                                <div class="col-sm-3">
                                    <div class="card" style="width:250px;">
                                        <div class="card-content" align="center">
                                            <div class="card-header" style="width:250px;">
                                                <h4>
                                                    <strong>{{ $member=DB::table('users')->where('id',$userAuth)->value('full_name') }}</strong>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                            <?php {{$picture=DB::table("profile_picture")->where("id_user",$userAuth)->value("path");}} ?>
                                                <img alt="user picture" src="{{URL::asset($picture)}}" style="height:125px;">
                                                <hr />
                                                <p>
                                                    <strong>Username:</strong>
                                                    <br />{{ $member=DB::table('users')->where('id',$userAuth)->value('username')}}
												</p>
                                                <p>
                                                    <strong>Email:</strong>
                                                    <br /> {{ $member=DB::table('users')->where('id',$userAuth)->value('e_mail') }}
												</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php $coordinator=$project->id_coordinator; ?>
                                @if ($userAuth != $coordinator)
                                <div class="col-sm-3">
                                    <div class="card" style="width:250px;" align="center">
                                        <div class="card-content" style="width:250px;" align="center">
                                            <div class="card-header" style="width:250px;" align="center">
                                                <h4>
                                                    <strong>{{ $member=DB::table('users')->where('id',$coordinator)->value('full_name') }}</strong>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                            <?php
                                                 if (DB::table("profile_picture")->where("id_user",$coordinator)->value("path")){
                                                    $picture=DB::table("profile_picture")->where("id_user",$coordinator)->value("path");
                                                }
                                                else{
                                                    $picture='https://visit.nemedic.com/storage/default.jpg';
                                                }
                                            ?>
                                                <img alt="user picture" src="{{URL::asset($picture)}}" style="height:125px;">
                                                <hr />
                                                <p>
                                                    <strong>Username:</strong>
                                                    <br />{{ $member=DB::table('users')->where('id',$coordinator)->value('username')}}
												</p>
                                                <p>
                                                    <strong>Email:</strong>
                                                    <br /> {{ $member=DB::table('users')->where('id',$coordinator)->value('e_mail') }}
												</p>
                                                @if ($contact=DB::table('contact')->where('id_user',$userAuth)->where('id_contact', $coordinator)->count() > 0)
                                                @else
                                                <form action="/addContact" id="add_contact" method="post">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                    <input type="hidden" name="project" value="{{$project->id}}"/>
                                                    <input type="hidden" name="contact2" id="contact2" value="{{$coordinator}}"/>
                                                    <button type="submit" class="btn btn-info btn-lg btn-block">
                                                    Add Contact
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @foreach ($ids as $id)
                                @if ($id != $userAuth)
                                <div class="col-sm-3">
                                    <div class="card" style="width:250px;" align="center">
                                        <div class="card-content" style="width:250px;" align="center">
                                            <div class="card-header" style="width:250px;" align="center">
                                                <h4>
                                                    <strong>{{ $member=DB::table('users')->where('id',$id)->value('full_name') }}</strong>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                            <?php
                                                 if (DB::table("profile_picture")->where("id_user",$id)->value("path")){
                                                    $picture=DB::table("profile_picture")->where("id_user",$id)->value("path");
                                                }
                                                else{
                                                    $picture='https://visit.nemedic.com/storage/default.jpg';
                                                }
                                            ?>
                                                <img alt="user picture" src="{{URL::asset($picture)}}" style="height:125px;">
                                                <hr />
                                                <p>
                                                    <strong>Username:</strong>
                                                    <br />{{ $member=DB::table('users')->where('id',$id)->value('username')}}
												</p>
                                                <p>
                                                    <strong>Email:</strong>
                                                    <br /> {{ $member=DB::table('users')->where('id',$id)->value('e_mail') }}
												</p>
                                                @if ($contact=DB::table('contact')->where('id_user',$userAuth)->where('id_contact', $id)->count() > 0)
                                                @else
                                                <form action="/addContact" id="add_contact" method="post">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                    <input type="hidden" name="project" value="{{$project->id}}"/>
                                                    <input type="hidden" name="contact2" id="contact2" value="{{$id}}"/>
                                                    <button type="submit" class="btn btn-info btn-lg btn-block">
                                                    Add Contact
                                                    </button>
                                                </form>
                                                @endif

                                                @if ($contact=DB::table('project_team')->where('id_project',$project->id)->where('id_user', $id)->count() > 0)
                                                @else
                                                <form action="/addTeamProject" id="add_contact" method="post">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                                    <input type="hidden" name="project" value="{{$project->id}}"/>
                                                    <input type="hidden" name="user" value="{{$id}}"/>
                                                    <button type="submit" class="btn btn-info btn-lg btn-block">
                                                    Add Team Member
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
