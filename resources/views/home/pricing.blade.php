@extends('layouts.home')
@section('home-title')
Home | Pricing Page
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
                <li>Pricing</li>
            </ol>
        </div>
    </section>
    <section>
        <div class="card text-white">
            <img src="{{asset('public/frontend/assets/img/banner-1.png')}}" class="card-img" alt="...">
            <div class="card-img-overlay">
                <h1 class="card-title">PACKAGES</h1>
            </div>
        </div>
    </section>
    <section id="pricing" class="pricing">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4 box">
                    <h3>Free</h3>
                    <h4>&#x20b9;1000<span>per month</span></h4>
                    <ul>
                        <li><i class="bx bx-check"></i> One day trial</li>
                        <li><i class="bx bx-check"></i> Limited Courses</li>
                        <li><i class="bx bx-check"></i> Free 10 Day</li>
                        <li><i class="bx bx-check"></i> One day trial</li>
                        <li><i class="bx bx-check"></i> Limited Courses</li>
                        <li><i class="bx bx-check"></i> Free 10 Day</li>
                        <li><i class="bx bx-check"></i> One day trial</li>
                        <li><i class="bx bx-check"></i> Limited Courses</li>
                    </ul>
                    <a href="#" class="buy-btn">Buy This Plan</a>
                </div>
                <div class="col-lg-4 box featured">
                    <h3>Free</h3>
                    <h4>&#x20b9;1000<span>per month</span></h4>
                    <ul>
                        <li><i class="bx bx-check"></i> One day trial</li>
                        <li><i class="bx bx-check"></i> Limited Courses</li>
                        <li><i class="bx bx-check"></i> Free 10 Day</li>
                        <li><i class="bx bx-check"></i> One day trial</li>
                        <li><i class="bx bx-check"></i> Limited Courses</li>
                        <li><i class="bx bx-check"></i> Free 10 Day</li>
                        <li><i class="bx bx-check"></i> One day trial</li>
                        <li><i class="bx bx-check"></i> Limited Courses</li>
                    </ul>
                    <a href="#" class="buy-btn">Buy This Plan</a>
                </div>
                <div class="col-lg-4 box">
                    <h3>Free</h3>
                    <h4>&#x20b9;1000<span>per month</span></h4>
                    <ul>
                        <li><i class="bx bx-check"></i> One day trial</li>
                        <li><i class="bx bx-check"></i> Limited Courses</li>
                        <li><i class="bx bx-check"></i> Free 10 Day</li>
                        <li><i class="bx bx-check"></i> One day trial</li>
                        <li><i class="bx bx-check"></i> Limited Courses</li>
                        <li><i class="bx bx-check"></i> Free 10 Day</li>
                        <li><i class="bx bx-check"></i> One day trial</li>
                        <li><i class="bx bx-check"></i> Limited Courses</li>
                    </ul>
                    <a href="#" class="buy-btn">Buy This Plan</a>
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
