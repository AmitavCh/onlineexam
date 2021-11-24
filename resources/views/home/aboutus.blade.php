@extends('layouts.home')
@section('home-title')
Home | About Us Page
@endsection
@section('home-content')
@php
use App\Http\Controllers\Controller;
@endphp
<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                
                <li><a href="{{URL('/')}}">Home</a></li>
                <li>About Us</li>
            </ol>
        </div>
    </section>
    <section>
        <div class="card text-white">
            <img src="{{asset('public/frontend/assets/img/banner-1.png')}}" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h1 class="card-title">ABOUT US</h1>
            </div>
        </div>
    </section>
    <div class="container about-text">
        <h1 style="text-align: center;color: #636363;font-size: 31px;font-weight: bolder;">Welcome To The Best Online Education Source Of EDUZEM</h1>
        <br>
        <p  style="font-size: 14px;line-height: 30px;">Discourse assurance estimable applauded to so. Him everything melancholy uncommonly but solicitude inhabiting projection off. Connection stimulated estimating excellence an to impression.</p>
        <p  style="font-size: 14px;line-height: 30px;">Tolerably behaviour may admitting daughters offending her ask own. Praise effect wishes change way and any wanted. Lively use looked latter regard had. Do he it part more last in. Merits ye if mr narrow points. Melancholy particular devonshire alteration it favourable appearance</p>
        <br>
        <div class="card text-white">
            <img src="{{asset('public/frontend/assets/img/banner-2.png')}}" class="card-img" alt="...">
        </div> 
    </div>
    <br>
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="{{asset('public/frontend/assets/img/about.jpg')}}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content solution-about">
                    <h4 style="color:#fbaf17">Solution for Education</h4>
                    <p class="font-italic">
                        Zemusi Tech Solutions Pvt. Ltd. is a global Information Technology company, who is backed with a dedicated
                    </p>
                    <h4 style="color:#fbaf17">Online Evaluation System</h4>
                    <p class="font-italic">
                        Zemusi Tech Solutions Pvt. Ltd. is a global Information Technology company, who is backed with a dedicated
                    </p>
                    <h4 style="color:#fbaf17">Solutions for Schools</h4>
                    <p class="font-italic">
                        Zemusi Tech Solutions Pvt. Ltd. is a global Information Technology company, who is backed with a dedicated
                    </p>
                    <h4 style="color:#fbaf17">Solution for Corporates</h4>
                    <p class="font-italic">
                        Zemusi Tech Solutions Pvt. Ltd. is a global Information Technology company, who is backed with a dedicated
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="container" >
        <div class="section-title">
            <h1 style="text-align: center;color: #636363;font-size: 31px;font-weight: bolder;">Choose Your Package</h1>
            <p style="font-size: 14px;line-height: 30px;">Duis mi ipsum, vestibulum eget nulla nec, maximus rhoncus turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
        </div>
        <br>
        <div class="top-content">
            <div class="container-fluid">
                <div id="carousel-example" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner row w-100 mx-auto" role="listbox">
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                            <div class="container-fluid">
                                <img src="{{asset('public/frontend/assets/img/facl-1.png')}}" alt="" class="image" style="width:100%">
                                <div class="middle">
                                    <div class="text">Keshab Das <br>Project Manager </div>
                                </div>
                            </div>  
                        </div>

                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="container-fluid">
                                <img src="{{asset('public/frontend/assets/img/facl-2.png')}}" alt="Avatar" class="image" style="width:100%">
                                <div class="middle">
                                    <div class="text">Keshab Das <br>Project Manager </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="container-fluid">
                                <img src="{{asset('public/frontend/assets/img/facl-1.png')}}" alt="Avatar" class="image" style="width:100%">
                                <div class="middle">
                                    <div class="text">Keshab Das <br>Project Manager </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="container-fluid">
                                <img src="{{asset('public/frontend/assets/img/facl-2.png')}}" alt="Avatar" class="image" style="width:100%">
                                <div class="middle">
                                    <div class="text">Keshab Das <br>Project Manager </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="container-fluid">
                                <img src="{{asset('public/frontend/assets/img/facl-1.png')}}" alt="Avatar" class="image" style="width:100%">
                                <div class="middle">
                                    <div class="text">Keshab Das <br>Project Manager </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="container-fluid">
                                <img src="{{asset('public/frontend/assets/img/facl-2.png')}}" alt="Avatar" class="image" style="width:100%">
                                <div class="middle">
                                    <div class="text">Keshab Das <br>Project Manager </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="container-fluid">
                                <img src="{{asset('public/frontend/assets/img/facl-1.png')}}" alt="Avatar" class="image" style="width:100%">
                                <div class="middle">
                                    <div class="text">Keshab Das <br>Project Manager </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="container-fluid">
                                <img src="{{asset('public/frontend/assets/img/facl-2.png')}}" alt="Avatar" class="image" style="width:100%">
                                <div class="middle">
                                    <div class="text">Keshab Das <br>Project Manager </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section> 
    <div>
        <video width="100%" height="100%" controls poster= "{{asset('public/frontend/assets/img/thumnail2.jpg')}}">
            <source src="{{asset('public/frontend/assets/img/videos/seed.mp4')}}" type="video/mp4">
        </video>
    </div>
</main>
@endsection