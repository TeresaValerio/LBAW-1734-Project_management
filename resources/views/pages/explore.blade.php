@extends('layouts.user')

@section('content')

<link rel="stylesheet" href="/CSS/explore.css">
<title>Explore Projects</title>

     <!-- Header -->
     <div class="header container-fluid main-color-bg">
        <div class="row">
            <h2>Search Projects</h2>
            <input class="flipkart-navbar-input col-xs-11" type="" placeholder="Search for Projects" name="">
            <button class="flipkart-navbar-button col-xs-1">
                <svg width="15px" height="15px">
                    <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                </svg>
            </button>
        </div>
    </div>
    <!-- Header -->


    <div class="container">
        <header>
            <h3>
                <strong>3</strong> results found</h3>
        </header>
        <section class="col-xs-12 col-sm-6 col-md-12">
            <article class="search-result row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <a href="#" title="Lorem ipsum" class="thumbnail">
                        <img src="https://cdn2.f-cdn.com/contestentries/951618/21545865/58a20f1ed47c4_thumb900.jpg" alt="Lorem ipsum"
                        />
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <ul class="meta-search">
                        <li>
                            <i class="glyphicon glyphicon-calendar"></i>
                            <span>29/05/2017</span>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-time"></i>
                            <span>10 months</span>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-tags"></i>
                            <span>Nature</span>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                    <h3>
                        <a href="#" title="">Tuna for the world</a>
                    </h3>
                    <p>Inês Gonçalves started this project in the hopes of saving the life of tunas all over the world. Today,
                        she owns a multimillion dollar empire and tunas everywhere have her to thank for their lifes!</p>
                </div>
                <span class="clearfix borda"></span>
            </article>

            <article class="search-result row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <a href="#" title="Lorem ipsum" class="thumbnail">
                        <img src="https://i.pinimg.com/originals/61/08/5b/61085bf8f325fe5e0a99b4259564e44a.jpg" alt="Lorem ipsum"
                        />
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <ul class="meta-search">
                        <li>
                            <i class="glyphicon glyphicon-calendar"></i>
                            <span>11/11/2016</span>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-time"></i>
                            <span>1 year and 3 months</span>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-tags"></i>
                            <span>Resource management</span>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7">
                    <h3>
                        <a href="#" title="">ACORN</a>
                    </h3>
                    <p>Preparing for winter can be hard, with limited budget and many frenetic workers. With Vici, Sara can
                        manage her stock without going nuts!</p>
                </div>
                <span class="clearfix borda"></span>
            </article>

            <article class="search-result row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <a href="#" title="Lorem ipsum" class="thumbnail">
                        <img src="https://thumbs.dreamstime.com/b/best-bee-hive-logo-design-84149860.jpg" alt="Lorem ipsum" />
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <ul class="meta-search">
                        <li>
                            <i class="glyphicon glyphicon-calendar"></i>
                            <span>20/09/2017</span>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-time"></i>
                            <span>5 months</span>
                        </li>
                        <li>
                            <i class="glyphicon glyphicon-tags"></i>
                            <span>Food industry</span>
                        </li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7">
                    <h3>
                        <a href="#" title="">Hive</a>
                    </h3>
                    <p>Teresa Valério uses Vici to manage her honey factory. When she started using our app, she truly became
                        the Queen of the Hive!</p>
                </div>
                <span class="clearfix border"></span>
            </article>

        </section>
    </div>

@endsection
