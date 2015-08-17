@extends('layouts.master')

@section('content')
    <header>
        <?php
            $hello = 'Guild : Mio SoL&LunA';
            $admin = false;
            if(Auth::check()){
                $user = Auth::user();
                $hello = 'Hi '.$user->name;
                $admin = (Auth::user()->permission==2)?true:false;
            }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="img/profile.png" alt="">
                    <div class="intro-text">
                        <span class="name">{{ $hello }}</span>
                        <hr class="star-light">
                        <span class="skills">Have Fun !</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section id="Tools">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Tools</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 portfolio-item">
                    <a target='_blank' href="http://www.martin.com.tw/rotools/counter/" class="portfolio-link" >
                        <img src="img/portfolio/game.png" class="img-responsive" alt="">
                    </a>
                    <i class="glyphicon glyphicon-tasks"></i> 素質計算機
                </div>
                <div class="col-sm-4 portfolio-item">
                    <a href="article" class="portfolio-link" >
                        <img src="img/portfolio/cake.png" class="img-responsive" alt="">
                    </a>
                    <i class="glyphicon glyphicon-book"></i> 遊戲筆記
                </div>
                @if($admin)
                <div class="col-sm-4 portfolio-item">
                    <a href="admin" class="portfolio-link" >
                    <img src="img/portfolio/safe.png" class="img-responsive" alt="">
                    </a>
                    <i class="glyphicon glyphicon-book"></i> 會員管理
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p></p>
                </div>
                <div class="col-lg-4">
                    <p></p>
                </div>
            </div>
        </div>
    </section>

@endsection