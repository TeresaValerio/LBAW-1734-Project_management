@extends('layouts.user')


@section('content')
 <link rel="stylesheet" href="/CSS/userInfo.css">
 <!-- Header -->
    <div class="header container-fluid main-color-bg">
        <ol class="breadcrumb">
            <li>
                <a href="#"> {{ $person->full_name }} </a>
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
                            <a href="{{ url('/userProjects') }}">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Projects</span>
                            </a>
                        </li>
                        <li class="active">
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
            <div class="row">
                <div class="col-md-10 col-sm-11 display-table-cell v-align">
                    <div class="col-md-2 col-sm-3 display-table-cell v-align">
                        <a href="#" class="profile-pic">
                            <div class="profile-pic" style="background-image: url(/img/profile.jpg)">
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
