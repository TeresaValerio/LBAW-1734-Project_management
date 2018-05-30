@extends('layouts.user')


@section('content')

<title>Contacts | {{$userAuth=auth()->user()->full_name}}</title>
<!-- Header -->
    <div class="header container-fluid main-color-bg">
        <ol class="breadcrumb">
        <li>
                <?php  $userAuth=auth()->user()->id  ?>
                <a href={{ url($userAuth.'/personalInfo')}}> {{ $member=DB::table('users')->where('id',$userAuth)->value('full_name') }}</a>
            </li>
            <li class="active">
                Contacts
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
                        <li class="active">
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
                    <?php  $contact_ids = DB::table('contact')->where('id_user',$userAuth)->pluck('id_contact')?>
                    <?php
                        if( isset($_GET['search_button']) )
                        {
                            //be sure to validate and clean your variables
                            if($_GET['search'] === ""){

                                $contact_ids = DB::table('users')
                                    ->join('contact','users.id','=','contact.id_contact')
                                    ->where('contact.id_user',$userAuth)
                                    ->pluck('id_contact');
                            }
                            else
                            //then you can use them in a PHP function. 
                            {
                                $val1 = htmlentities($_GET['search']);
                            
                            $contact_ids = DB::table('users')
                            ->join('contact','users.id','=','contact.id_contact')
                            ->where('contact.id_user',$userAuth)
                            ->whereRaw("to_tsvector(username||' '||full_name||' '||e_mail) @@ to_tsquery('$val1')")
                            
                            ->pluck('id_contact');}
                        }
                    ?>
                    <form action="" method="get">
                        <div class="input-group" style="padding-bottom:10px">
                        
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search workers...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="search_button" >Search</button>
                            </span>
                            
                        </div>
                    </form>
                    <!-- /input-group -->
                    <div class="row">
                        <?php  $userAuth = auth()->user()->id ?>
                        @foreach ($contact_ids as $id)
                        <div class="col-sm-3">
                            <div class="card" style="width:250px;">
                                <div class="card-content" style="width:250px;" align="center">
                                    <div class="card-header" style="width:250px;">
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
                                        <p style="font-size: 11px">
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

@endsection