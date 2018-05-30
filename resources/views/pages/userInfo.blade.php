@extends('layouts.user')


@section('content')
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
                                <i class="fa fa-info" aria-hidden="true"></i>
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
            <div class="row" style="margin-top:20px">
                <div class="col-md-4 col-sm-3 display-table-cell v-align">
                    <h4 align="center">Time spent on boards</h4>
                    <canvas id="pieChart" style="max-width: 250px; padding: 0px;"></canvas>
                </div>
                <div class="col-md-8 col-sm-9 display-table-cell v-align">
                    <h4 align="center">Tasks created in each board</h4>
                    <canvas id="myChart" style="max-width: 900px; padding: 0px;"></canvas>
                </div>
            </div>
        </div>
    </div>

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

                
                {{ $projects_working_names=DB::table('project_team')->join('projects','project_team.id_project','=','project.id')->where('id_user',$userAuth)->pluck('projects.name') }}
                {{ $projects_created_names=DB::table('projects')->where('id_coordinator',$userAuth)->pluck('projects.name') }}
                {{ $projects_working_ids=DB::table('project_team')->join('projects','project_team.id_project','=','project.id')->where('id_user',$userAuth)->pluck('projects.id') }}
                {{ $projects_created_ids=DB::table('projects')->where('id_coordinator',$userAuth)->pluck('projects.id') }}

                //BOARDS EM CADA PROJETO
                @foreach ($projects_working_ids as $project_working_id){
                    n_boards1=DB::table('board')->where('id_project',$project_working_id)->where('board.id_creator',$userAuth)->count() + DB::table('board')->join('board_team','board.id','=','board_team.id_board')->where('board.id_project',$projectId)->where('board_team.id_user')->count();
                }
                @foreach ($projects_created_ids as $project_created_id){
                    n_boards1=DB::table('board')->where('id_project',$project_working_id)->where('board.id_creator',$userAuth)->count() + DB::table('board')->join('board_team','board.id','=','board_team.id_board')->where('board.id_project',$projectId)->where('board_team.id_user')->count();
                }

                //TASKS EM CADA PROJETO
                @foreach($projects_working_ids as $project_working_id){
                    n_tasks1=DB::table('projects')->join('board','projects.id','=','board.id_project')->join('task','task.id_board','=','board.id')->where('task.id_creator',$userAuth)->count();
                }
                @foreach($projects_created_ids as $project_working_id){
                    n_tasks2=DB::table('projects')->join('board','projects.id','=','board.id_project')->join('task','task.id_board','=','board.id')->where('task.id_creator',$userAuth)->count();
                }

                // USERS POR BOARD
                {{ $boards_ids=DB::table('board')->where('id_project',$projectId)->pluck('id') }}

                @foreach($boards_ids as $board_id){
                    n_users=DB::table('board_team')->where('id_board',$board_id)->count()+1;
                }
                @foreach($boards_ids as $board_id){
                    n_tasks=DB::table('task')->where('id_board',$board_id)->count();
                }

                labels: ["ACORN", "Tuna FTW","Hive"],
                datasets: [{
                    data: [300, 50, 100],
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
                labels:  ["ACORN", "Tuna FTW","Hive"],
                datasets: [{
                    label: '# of Tasks',
                    data: [12, 19, 3,],
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


    <!-- Chart -->

@endsection
