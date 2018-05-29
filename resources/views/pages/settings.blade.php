@extends('layouts.user')

@section('content')


 <title>Settings | {{$userAuth=auth()->user()->full_name}}</title>
<link rel="stylesheet" href="CSS/userInfo.css">

<!-- Header -->
    <div class="header container-fluid main-color-bg">
        <ol class="breadcrumb">
        <li>
                <?php  $userAuth=auth()->user()->id  ?>
                <a href={{ url($userAuth.'/personalInfo')}}> {{ $member=DB::table('users')->where('id',$userAuth)->value('full_name') }}</a>
            </li>
            <li>
                Settings
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
                                <span class="hidden-xs hidden-sm">My Calendar</span>
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

            <div class="row" >
                <div class="col-md-3 col-sm-4 display-table-cell v-align">
                    <div class="col-md-2 col-sm-3 display-table-cell v-align">
                        <a href="#" class="profile-pic">
                            <div class="profile-pic" style="background-image: url(img/profile.jpg)">
                                <span class="glyphicon glyphicon-camera"></span>
                                <span>Change Image</span>
                            </div>
                        </a>
                        <p>
                            <h2> {{ $person->full_name}}</h2>
                        </p>
                        <p>
                            <strong>Username: </strong> <br />
                            {{ $person->username}}</p>
                        <p>
                            <strong>Email: </strong> <br />
                            {{ $person->e_mail}}</p>
                    </div>
                    
                    <div class="col-md-5 col-sm-6 display-table-cell v-align" >

                    

                    <form action= "/changePassword" method="post" id="password-form">
			        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <fieldset><legend class="text-left"><h2> Password </h2></legend>

                        <div class="form-group">
                            <label for="password"><span class="req"></span> New password: </label>
                            <input required id="password" name="password" class="form-control" type="password" placeholder="New password">
                        </div>
                        <div class="form-group">    
                            <label for="password_confirmation"><span class="req"></span> Confirm new password: </label>
                            <input required id="password_confirmation" name="password_confirmation" class="form-control" type="password" placeholder="Repeat new password">
                        </div>
                        <div class= "form-group">
                            @include ('layouts.errors')
                        </div>
                        <div class="form-group">
                            <div>
                                <input class="btn btn-primary" type="submit" value="Submit">
                            </div> 
                        </div>

                            

                    </form>    

                    <form action= "/changeFullName" method="post" id="name-form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <fieldset><legend class="text-left"><h2> Full name </h2></legend>
                        <div class="form-group">
                            <label for="full_name"><span class="req"></span> New name: </label>
                                <input required name="full_name" type="text" class="form-control inputpass" placeholder="Input new full name" id="pass1" /> </p>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Submit"> 
                            <h6>You will receive an email to complete the registration and validation process. 
                                Be sure to check your spam folders.</h6>
                        </div>
                    </form>
                        
                    <form action="/changePrivacy" method="post" id="privacy-form" role="form">
                        <fieldset><legend class="text-left"><h2> E-mail </h2></legend>
                        <div class="form-group">
                            <b>Change privacy: </b><input type="checkbox" name="email" value="email">Public <br>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit_reg" value="Submit"> 
                            <h6>You will receive an email to complete the registration and validation process. 
                                Be sure to check your spam folders.</h6>
                        </div>
                    </form>


                            
                          
                    </div>
                </div>
                

            </div>


            
        </div>
    </div>
@endsection
