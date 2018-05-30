@extends('layouts.user')

@section('content')

<link rel="stylesheet" href="/CSS/explore.css">
<title>Explore Projects</title>

     <!-- Header -->
     <?php $project_ids = DB::table('projects')->pluck('id'); ?>
     <div class="header container-fluid main-color-bg">
        <div class="row">
           <!-- /input-group -->
            <?php
                if( isset($_GET['search_button']) )
                {
                    //be sure to validate and clean your variables
                    if($_GET['search'] === ""){

                        $project_ids = DB::table('projects')->pluck('id');
                    }
                    else
                    //then you can use them in a PHP function. 
                    {
                        $val1 = htmlentities($_GET['search']);
                            
                        $project_ids = DB::table('projects')
                            ->whereRaw("to_tsvector(name||' '||description) @@ to_tsquery('$val1')")
                            ->pluck('id');
                    }
                }
            ?>
            <form action="" method="get">
                <div class="input-group" style="padding-bottom:10px">
                        
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search projects...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit" name="search_button" >Search</button>
                    </span>
                            
                </div>
            </form> 
        </div>
    </div>
    <!-- Header -->


    <div class="container">
        <div class="row">
            <?php  $userAuth = auth()->user()->id ?>
            @foreach ($project_ids as $id)
                <div class="col-sm-3">
                    <div class="card" style="width:250px;">
                        <div class="card-content" style="width:250px;" align="center">
                            <div class="card-header" style="width:250px;">
                                <h4>
                                    <strong>{{ $project=DB::table('projects')->where('id',$id)->value('name') }}</strong>
                                </h4>
                            </div>
                            <div class="card-body">
                            <?php
                                if (DB::table("project_picture")->where("id_project",$id)->value("path")){
                                    $picture=DB::table("project_picture")->where("id_project",$id)->value("path");
                                }
                                else{
                                    $picture='https://visit.nemedic.com/storage/default.jpg';
                                }
                            ?>
                                <img alt="project picture" src="{{URL::asset($picture)}}" style="height:125px;">
                                    <p>
                                        <strong></strong>
                                        <br />{{ $project=DB::table('projects')->where('id',$id)->value('description')}}
									</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
