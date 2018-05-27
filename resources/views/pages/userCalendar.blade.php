@extends('layouts.user')


@section('content')
 <link rel="stylesheet" href="/CSS/userCalendar.css">

    <!-- Header -->
    <div class="header container-fluid main-color-bg">
        <ol class="breadcrumb">
            <li>
            <a href={{ url($person->id.'/personalInfo') }}>  {{ $person->full_name }} </a>
            </li>
            <li class="active">
                Calendar
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
                        <li class="active">
                            <a href={{ url($person->id.'/userCalendar') }}>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                <span class="hidden-xs hidden-sm">My Calendar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class: "row">
                <div class="col-md-10 col-sm-11 display-table-cell v-align">
                    <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                    <div class="user-dashboard">
                        <table>
                            <summary>
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <strong>February 2014</strong>
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </summary>
                            <thead>
                                <tr>
                                    <th>Mon</th>
                                    <th>Tue</th>
                                    <th>Wed</th>
                                    <th>Thu</th>
                                    <th>Fri</th>
                                    <th>Sat</th>
                                    <th>Sun</th>
                                </tr>
                            </thead>
                            <tr>
                                <td class="meeting">
                                    <span class="date">
                                        27
                                        <ul>
                                            <li>
                                                <span class="event">ACORN meeting</span>
                                                <span class="time">4 pm</span>
                                            </li>
                                        </ul>
                                    </span>
                                </td>
                                <td class="not-month">
                                    <span class="date">28</span>
                                </td>
                                <td class="not-month">
                                    <span class="date">29</span>
                                </td>
                                <td class="not-month">
                                    <span class="date">30</span>
                                </td>
                                <td class="not-month">
                                    <span class="date">31</span>
                                </td>
                                <td class="weekend">
                                    <span class="date">February 1</span>
                                </td>
                                <td class="deadline">
                                    <span class="date">
                                        2
                                        <ul>
                                            <li>
                                                <span class="event">Code deadline</span>
                                                <span class="time">6:30 pm</span>
                                            </li>
                                        </ul>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="date">3</span>
                                </td>
                                <td>
                                    <span class="date">4</span>
                                </td>
                                <td class="meeting">
                                    <span class="date">5
                                        <ul>
                                            <li>
                                                <span class="event">Code Review Meeting </span>
                                                <span class="time">12 pm</span>
                                            </li>
                                        </ul>
                                    </span>
                                </td>
                                <td>
                                    <span class="date">6</span>
                                </td>
                                <td>
                                    <span class="date">7</span>
                                </td>
                                <td class="weekend">
                                    <span class="date">8</span>
                                </td>
                                <td class="weekend">
                                    <span class="date">9</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="date">10</span>
                                </td>
                                <td>
                                    <span class="date">11</span>
                                </td>
                                <td>
                                    <span class="date">12</span>
                                </td>
                                <td>
                                    <span class="date">13</span>
                                </td>
                                <td>
                                    <span class="date">
                                        14
                                        <ul>
                                            <li class="different-calendar">
                                                <span class="event">Valentines Day</span>
                                            </li>
                                        </ul>
                                    </span>
                                </td>
                                <td class="weekend">
                                    <span class="date">15</span>
                                </td>
                                <td class="weekend">
                                    <span class="date">16</span>
                                </td>
                            </tr>
                            <tr class="current-week">
                                <td>
                                    <span class="date">17</span>
                                </td>
                                <td>
                                    <span class="date">18</span>
                                </td>
                                <td class="current-day">
                                    <span class="date">19</span>
                                </td>
                                <td>
                                    <span class="date">20</span>
                                </td>
                                <td>
                                    <span class="date">21</span>
                                </td>
                                <td class="weekend">
                                    <span class="date">22</span>
                                </td>
                                <td class="weekend">
                                    <span class="date">23</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="date">24</span>
                                </td>
                                <td class="meeting">
                                    <span class="date">
                                        25
                                        <ul>
                                            <li class="different-calendar">
                                                <span class="event">HR Meeting</span>
                                                <span class="time">10 am</span>
                                            </li>
                                        </ul>
                                    </span>
                                </td>
                                <td>
                                    <span class="date">26</span>
                                </td>
                                <td>
                                    <span class="date">27</span>
                                </td>
                                <td>
                                    <span class="date">28</span>
                                </td>
                                <td class="not-month">
                                    <span class="date">March 1</span>
                                </td>
                                <td class="not-month">
                                    <span class="date">2</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
</body>

</html>