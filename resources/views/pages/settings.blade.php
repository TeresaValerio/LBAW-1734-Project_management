@extends('layouts.user')

@section('content')

<link rel="stylesheet" href="CSS/userInfo.css">

<!-- Header -->
    <div class="header container-fluid main-color-bg">
        <ol class="breadcrumb">
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
                            <a href="user.html">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Projects</span>
                            </a>
                        </li>
                        <li>
                            <a href="userInfo.html">
                                <i class="fa fa-info" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Personal Info</span>
                            </a>
                        </li>
                        <li>
                            <a href="userCalendar.html">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Calendar</span>
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
                            <h2> Inês Gonçalves</h2>
                        </p>
                        <p>
                            <strong>Username: </strong> <br />
                        m.ines.ggoncalves</p>
                        <p>
                            <strong>Email: </strong> <br />
                        m.ines.ggoncalves@gmail.com</p>
                    </div>
                    
                    <div class="col-md-5 col-sm-6 display-table-cell v-align" >
                    
                        <form action="/changePassword" method="post" id="fileForm" role="form">
                                <fieldset><legend class="text-left"><h2> Password </h2></legend>
                        <div class="form-group">
                            <label for="password"><span class="req"></span> New password: </label>
                                <input required name="new_password" type="password" class="form-control inputpass" minlength="4" maxlength="16" placeholder="Input new password" id="pass1" /> </p>

                            <label for="password"><span class="req"></span> Confirm new password: </label>
                                <input required name="new_password2" type="password" class="form-control inputpass" minlength="4" maxlength="16" placeholder="Repeat new password"  id="pass2" onkeyup="checkPass(); return false;" />
                                    <span id="confirmMessage" class="confirmMessage"></span>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit_reg" value="Submit"> 
                            <h6>You will receive an email to complete the registration and validation process. 
                                Be sure to check your spam folders.</h6>
                        </div>    
                        
                        <form action="" method="post" id="fileForm" role="form">
                        <fieldset><legend class="text-left"><h2> Full name </h2></legend>
                        <div class="form-group">
                            <label for="password"><span class="req"></span> New name: </label>
                                <input required name="password" type="text" class="form-control inputpass" placeholder="Input new full name" id="pass1" /> </p>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit_reg" value="Submit"> 
                            <h6>You will receive an email to complete the registration and validation process. 
                                Be sure to check your spam folders.</h6>
                        </div>
                        
                        <form action="" method="post" id="fileForm" role="form">
                        <fieldset><legend class="text-left"><h2> E-mail </h2></legend>
                        <div class="form-group">
                            <b>Change privacy: </b><input type="checkbox" name="email" value="email">Public <br>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit_reg" value="Submit"> 
                            <h6>You will receive an email to complete the registration and validation process. 
                                Be sure to check your spam folders.</h6>
                        </div>


                            
                          
                    </div>
                </div>
                

            </div>


            
        </div>
    </div>
@endsection
