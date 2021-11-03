@extends('layouts.home')
@section('home-title')
Home | Home Page
@endsection
@section('home-content')
@php
use App\Http\Controllers\Controller;
@endphp
<style>
    .btn-enquiry{
        background: #fcb221;
        border: 0;
        border-radius: 50px;
        padding: 7px 24px;
        color: #fff;
        transition: 0.4s;
        font-size:13px;
        font-weight: bold;
    }
    .form-control {
        display: block;
        width: 100%;
        height: 35px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 5px;
        -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
        -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    }
</style>
<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{URL('/')}}">Home</a></li>
                <li>Login</li>
            </ol>
        </div>
    </section>
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="info-box mb-4">
                        <i class="bx bx-user-circle"></i>
                        <h3>Login with Social Media</h3>
                        <br/><br/>
                        <div class=" social-buttn"><a class="a1" href="">Facebook</a></div>
                        <br/><br/>
                        <div class=" social-buttn2"><a class="a1" href="">Twitter</a></div>
                        <br/><br/>
                        <div class=" social-buttn3"><a class="a1" href="">Linkedin</a></div>
                        <br/>
                    </div>
                </div>
                <!-- <div class="col-lg-6 ">
                <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                </div> -->
                <div class="col-lg-8" style="background-color: #212959; border-radius: 5px;">
                    <br>
                    <div class="contact-form-text">
                        <h4 style="color:#fcb221">Login To Your Registered Account</h4>
                    </div>
                    <br/>
                    <div class="span12">
                        <div class="alert alert-success alert-dismissable" id="sucMsgDiv" style="display: none;">
                            <span class="sucmsgdiv"></span>					
                        </div>
                        <div class="alert alert-danger alert-dismissable" id="failMsgDiv" style="display: none;">
                            <span class="failmsgdiv"></span>
                        </div>
                        @if(Session::has('error'))
                        <div role="alert" class="alert alert-warning alert-dismissable">
                            <strong>Error !</strong>
                            {{Session::get('error')}}
                        </div>
                        @endif
                        @if(Session::has('message'))	
                        <div role="alert" class="alert alert-success alert-dismissable">
                            <strong></strong>									
                            {{Session::get('message') }}
                        </div>
                        @endif
                    </div>
                    <form action="signup" method="post" role="form">
                       {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile Number*" data-rule="minlen:4"/>
                            <div class="validate"></div>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" data-rule="minlen:4"/>
                            <div class="validate"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="text-center">
                                    <div>
                                        <button type="submit" class="btn-enquiry">Sign In</button>
                                    </div>
                                    <br>
                                    <div>
                                        <button type="button" class="btn-enquiry">Resend OTP</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"></div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6"><h6 style="color: #fff;font-size:14px;">Not a member yet. <a href="{{URL('home/register')}}" class="a1">Register Now.</a></h6></div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3"><h6 style="color: #fff;font-size:14px;"><a href="{{URL('home/forgotpassword')}}" class="a1"> Forgot Password ?</a></h6></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection