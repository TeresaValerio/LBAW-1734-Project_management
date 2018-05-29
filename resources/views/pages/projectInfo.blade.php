@extends('layouts.projects')


@section('content')

<link rel="stylesheet" href="/CSS/userInfo.css">

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
                Info
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
                        <li class="active">
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
                        <li>
                            <a href="projectForum.html">
                                <i class="fa fa-comments" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">Forum</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-11 display-table-cell v-align">
                    <div class="col-md-2 col-sm-3 display-table-cell v-align">
                        <a href="#" class="profile-pic">
                        <?php {{$picture=DB::table("project_picture")->where("id_project",$project->id)->value("path");}} ?>
                            <div class="profile-pic" style="background-image: url({{URL::asset($picture)}})">
                                <span class="glyphicon glyphicon-camera"></span>
                                <span>Change Image</span>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-9 display-table-cell v-align">
                        <h1>{{ $project->name }}</h1>
                        <h4>
                            <strong>Description:</strong>
                        </h4>
                        <p>{{ $project->description }}</p>
                        <h4>
                            <strong>Creator</strong>
                        </h4>
                        <?php $creator_id = $project->id_coordinator; ?>
                        <p>{{ $creator=DB::table("users")->where("id",$creator_id)->value("full_name") }}</p>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:20px">
                <div class="col-md-4 col-sm-3 display-table-cell v-align">
                    <h4 align="center">Time spent on boards</h4>
                    <canvas id="pieChart" style="max-width: 250px; padding: 0px;"></canvas>
                </div>
                <div class="col-md-8 col-sm-9 display-table-cell v-align">
                    <h4 align="center">Workers involved in each board</h4>
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
                labels: ["Collect nuts", "Field recognition", "Nuts storage", "Others"],
                datasets: [{
                    data: [30, 70, 60, 100],
                    backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
                    hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
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
                labels: ["Collect nuts", "Field recognition", "Nuts storage", "Others"],
                datasets: [{
                    label: 'Number of Workers',
                    data: [12, 19, 3, 5, 2, 3],
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

@endsection
