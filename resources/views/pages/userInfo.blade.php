@extends('layouts.user')


@section('content')

<?php

$userAuth=auth()->user()->id;

    $projects_working_names=DB::table('project_team')->join('projects','project_team.id_project','=','projects.id')->where('id_user',$userAuth)->pluck('projects.name');
    $n_projects_working=DB::table('project_team')->join('projects','project_team.id_project','=','projects.id')->where('id_user',$userAuth)->pluck('projects.name')->count();
    $projects_working_ids=DB::table('project_team')->join('projects','project_team.id_project','=','projects.id')->where('id_user',$userAuth)->pluck('projects.id');
    $projects_created_ids=DB::table('projects')->where('id_coordinator',$userAuth)->pluck('projects.id');

    //BOARDS EM CADA PROJETO
    foreach ($projects_working_ids as $project_working_id){
        $n_boards1=DB::table('board')->where('id_project',$project_working_id)->where('board.id_creator',$userAuth)->count() + DB::table('board')->join('board_team','board.id','=','board_team.id_board')->where('board.id_project',$project_working_id)->where('board_team.id_user')->count();
        $n_boards[]=$n_boards1;
    }

    //TASKS EM CADA PROJETO
    foreach($projects_working_ids as $project_working_id){
        $n_tasks1=DB::table('projects')->join('board','projects.id','=','board.id_project')->join('task','task.id_board','=','board.id')->where('task.id_creator',$userAuth)->where('projects.id',$project_working_id)->count();
        $n_tasks[]=$n_tasks1;
    }

    foreach($projects_working_names as $label){
        $labels[]=$label;
    }
    ?>

<title>Info | {{$userAuth=auth()->user()->full_name}}</title>
 <link rel="stylesheet" href="/CSS/userInfo.css">
 <!-- Header -->
    <div class="header container-fluid main-color-bg">
        <ol class="breadcrumb">
        <li>
                <?php  $userAuth=auth()->user()->id  ?>
                <a href={{ url($userAuth.'/personalInfo')}}> {{ $member=DB::table('users')->where('id',$userAuth)->value('full_name') }}</a>
            </li>
            <li class="active">
                Personal Info
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
                        <li class="active">
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
                                <i class="fa fa-address-book" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Contacts</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-11 display-table-cell v-align">
                    <div class="col-md-2 col-sm-3 display-table-cell v-align">
                        <a href="#" class="profile-pic">
                            <div class="profile-pic" style="background-image:url({{$picture}})">
                                <span class="glyphicon glyphicon-camera"></span>
                                <span>Change Image</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-10 col-sm-9 display-table-cell v-align">
                        <h1>{{ $person->full_name}}</h1>
                        <p>
                            <strong>Username: </strong> <br />
                            {{ $person->username}}</p>
                        <p>
                            <strong>Email: </strong> <br />
                            {{ $person->e_mail}}</p>
                    </div>
                </div>
            </div>
            @if ($n_projects_working >=3){
            <div class="row" style="margin-top:20px">
                <div class="col-md-4 col-sm-3 display-table-cell v-align">
                    <h4 align="center">Number of boards of each project</h4>
                    <canvas id="pieChart" style="max-width: 250px; padding: 0px;"></canvas>
                </div>
                <div class="col-md-8 col-sm-9 display-table-cell v-align">
                    <h4 align="center">Number of tasks of each project</h4>
                    <canvas id="myChart" style="max-width: 900px; padding: 0px;"></canvas>
                </div>
            </div>
            @endif
        </div>
    </div>

    
@if($n_projects_working >=3){
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Chart -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.5/js/mdb.min.js"></script>
    <script>
        //pie
        var ctxP = document.getElementById("pieChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
                labels: ["{{$labels[0]}}", "{{$labels[1]}}", "{{$labels[2]}}",],
                datasets: [{
                    data: ["{{$n_boards[0]}}", "{{$n_boards[1]}}", "{{$n_boards[2]}}"],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870"]
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>

    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:  ["{{$labels[0]}}", "{{$labels[1]}}", "{{$labels[2]}}",],
                datasets: [{
                    label: '# of Tasks',
                    data: ["{{$n_tasks[0]}}", "{{$n_tasks[1]}}", "{{$n_tasks[2]}}"],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endif

    <!-- Chart -->

@endsection
