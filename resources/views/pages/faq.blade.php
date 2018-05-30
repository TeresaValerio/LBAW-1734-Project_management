@extends('layouts.user')

@section('content')


 <title>Settings | {{$userAuth=auth()->user()->full_name}}</title>
<link rel="stylesheet" href="/CSS/userInfo.css">

<!-- Header -->
    <div class="header container-fluid main-color-bg">
        <ol class="breadcrumb">
        <li>
                <?php  $userAuth=auth()->user()->id  ?>
                <a href={{ url($userAuth.'/personalInfo')}}> {{ $member=DB::table('users')->where('id',$userAuth)->value('full_name') }}</a>
            </li>
            <li>
                FAQ
            </li>
        </ol>
    </div>
    <!-- Header -->


    <!-- Main -->
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <ul>
                <li>
                    <h3> How do I change my password? </h3>
                    <p> It's easy! Just click on the upper right corner of your page, where it says Account. Here, select Settings and it has all you need to change your password, name or username. </p>
                </li>
                <li>
                    <h3> How can I add people to my contacts? </h3>
                    <p> Your contacts are your coleagues. In each project you are involved, there is a team page, in which you can see the information of all the people that worked with you. There, you can just click the buttpn and add any of them to your contacts.</p>
                </li>
                <li>
                    <h3> What happens when I delete my account? </h3>
                    <p> Don't do it! If you delete ypur account all the projects, boards and tasks you created are automatically deleted too, so your coleagues might loose a lot of information.</p>
                </li>
            </ul>
        </div>
    </div>

@endsection
