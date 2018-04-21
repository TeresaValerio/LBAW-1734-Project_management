@extends('layouts.user')

@section('content')

<!-- Header -->
    <div class="header container-fluid main-color-bg">
        <ol class="breadcrumb">
            <li>
                Inês Gonçalves
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
                            <a href={{ url('/projects') }}>
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Projects</span>
                            </a>
                        </li>
                        <li>
                            <a href={{ url('/personsalInfo') }}>
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
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <div class="user-dashboard">
                    <!-- /input-group -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search projects...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Search</button>
                        </span>
                    </div>
                    <!-- /input-group -->
                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12 gutter">
                            <div class="created">
                                <h2>Created</h2>
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
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-content" align="center">
                                            <div class="card-header">
                                                <h4>
                                                    <strong>Tuna FTW</strong>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <img src="https://cdn2.f-cdn.com/contestentries/951618/21545865/58a20f1ed47c4_thumb900.jpg" alt="User Picture" style="height:110px;">
                                                <hr />
                                                <a href="project.html">
                                                    <p>See more</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12 gutter">
                            <div class="working on">
                                <h2>Working on</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="well">
                            <div class="row text-center">
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-content" align="center">
                                            <div class="card-header">
                                                <h4>
                                                    <strong>Hive</strong>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <img src="https://thumbs.dreamstime.com/b/best-bee-hive-logo-design-84149860.jpg" alt="User Picture" style="height:125px;">
                                                <hr />
                                                <a href="project.html">
                                                    <p>See more</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-content" align="center">
                                            <div class="card-header">
                                                <h4>
                                                    <strong>Hive</strong>
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <img src="https://i.pinimg.com/originals/61/08/5b/61085bf8f325fe5e0a99b4259564e44a.jpg" alt="User Picture" style="height:142px;">
                                                <hr />
                                                <a href="project.html">
                                                    <p>See more</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                    <!-- Begin # Login Form -->

                    <form id="login-form">
                        <div class="modal-body">
                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Name</span>
                            </div>
                            <input id="project_name" class="form-control" type="name" placeholder="Project name">
                            
                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Description</span>
                            </div>
                            <input id="project_name" class="form-control" type="description" placeholder="Project description">

                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Start date</span>
                            </div>
                            <input type="date" name="date" value="start_date" > 

                            <div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Deadline</span>
                            </div>
                            <input type="date" name="date" value="start_date" > 
                            
                            <input type="checkbox" name="public" value="public" > Public project
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
