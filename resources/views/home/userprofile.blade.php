@extends('layouts.home')
@section('home-title')
Home | Dashboard
@endsection
@section('home-content')
@php
use App\Http\Controllers\Controller;
@endphp
<style>
    .profile-img{
        height: 150px;
        width: 150px;
    }

    .info-profile{
        font-size: 14px;
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif ;
        color: #fff;
        line-height:1.8;

    }

    .table-row {
        margin-top: 25px;
    }

    .student-profile{
        margin-top: 17px;

    }

    .btn-profile{
        background: #fcb221;
        border: 0;
        border-radius: 50px;
        padding: 7px 24px;
        color: #fff;
        transition: 0.4s;
        font-size: 13px;
        font-weight: bold;
        margin-top: 20px;
        margin-left: 17px;

    }
    .btn-profile:hover{
        background-color: #fcb221; 
        color: #212959; 
        border-radius: 50px; 
        font-size: 13px; 
        padding: 7px 24px;
        font-weight: bold;
    }
    button#defaultOpen {
        padding: 7px;

    }
    button.tablinks {
        /* background-color:#fcb221; */
        padding: 7px;
        margin-right:-6px;
    }

    .profile-tab{
        background-color: #212959; 
        border-radius: 5px; 
        height: 362px;
    }
    .tab-content>.active {
        display: block;
        color: white;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
        color: #f89a2f;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }
    @media (max-width: 768px){
        .profile-tab{
            background-color: #212959; 
            border-radius: 5px; 
            height: 600px;
            margin-top: 25px;
        }

        button.btn-profile {
            margin-left: -133px;
        }
        .btn-profile{
            background: #fcb221;
            border: 0;
            border-radius: 50px;
            padding: 7px 24px;
            color: #fff;
            transition: 0.4s;
            font-size: 13px;
            font-weight: bold;
            margin-top: 22px;
            margin-left: 22px;
        }

        .profile-img {
            height: 150px;
            width: 150px;
            margin-bottom: 247px;
            margin-left: 85px;
        }

        .info-profile {
            font-size: 14px;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            color: #fff;
            margin-top: -39%;
            line-height: 1.8;
        }

    }


</style>
<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{URL('/')}}">Home</a></li>
                <li>User Dashboard</li>
            </ol>
        </div>
    </section>
    <br>
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissable" id="sucMsgDiv" style="display: none;">
                        <i class="fa fa-check"></i>
                        <b>Success!</b>
                        <span class="sucmsgdiv"></span>					
                    </div>
                    <div class="alert alert-danger alert-dismissable" id="failMsgDiv" style="display: none;">
                        <i class="fa fa-ban"></i>					
                        <b>Info!</b>
                        <span class="failmsgdiv"></span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="userbtn"><i class="fa fa-dashboard"></i> &nbsp;<a class="a1" href="{{URL('home/dashboard')}}"> Dashboard</a></div>
                    <br>
                    <div class="userbtn"><i class="fa fa-bandcamp"></i> &nbsp;<a class="a1" href="{{URL('home/topiclist')}}"> Topic wise Test</a></div>
                    <br>
                    <div class="userbtn"><i class="fa fa-bandcamp"></i> &nbsp;<a class="a1" href="{{URL('home/setlist')}}"> Set wise Test</a></div>
                    <br>
                    <p class="userbtn" style="margin-bottom: 25px;">
                        <a class="a1"  data-toggle="collapse" href="#collapseExample" role="button"  aria-expanded="false" aria-controls="collapseExample" style="text-decoration:none"><i class="fa fa-file"></i>&nbsp; Performance Report &nbsp;&nbsp;&nbsp;&nbsp;<i class="icofont-caret-down"></i></a>
                    </p>
                    <div class="collapse" id="collapseExample" style="margin-top: -15px; margin-bottom: 10px">
                        <div class="card1">
                            <a href="{{URL('home/topicwiseperfomance')}}" class="userbtn-dropdown2 a1" style="color: #fcb221"><i class="fa fa-bar-chart" style="margin-left:30px; color: #fff"></i> &nbsp;Topic Wise</a>
                            <br>
                            <a href="{{URL('home/setwiseperfomance')}}" class="userbtn-dropdown2 a1" style="margin-top: -15px; color: #fcb221"><i class="fa fa-bar-chart" style="margin-left:30px; color: #fff"></i> &nbsp;Set Wise</a>
                        </div>
                    </div>
                    <div class="userbtn" style="border-top:"><i class="icofont-ui-user"></i> &nbsp;<a class="a1" href="{{URL('home/userprofile')}}">Profile</a></div>
                    <br>
                    <div class="userbtn"><i class="icofont-ui-password"></i> &nbsp;<a class="a1" href="{{URL('home/changepassword')}}"> Change Password</a></div>
                </div>

                <div class="col-lg-9 mb-4 content1 profile-tab">
                    <div class="row student-profile">
                        <div class="col-md-3">
                            <?php if(Auth::user()->profile_photo == ''){ ?>
                            <img class="profile-img" src="{{asset('public/frontend/assets/img/student-image.png')}}">
                            <?php }else{?>
                            <img class="profile-img" src="{{asset('public/userphoto/'.Auth::user()->profile_photo)}}">
                            <?php }?>       
                            <button class="btn-profile">Edit Profile</button>
                        </div>

                        <div class="col-md-9 info-profile">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a class="tab" href="#tab_1" data-toggle="tab" aria-expanded="true">Personal Details</a></li>
                                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Subscription Details</a></li>


                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">

                                        <div class="container multiple">
                                            <div class="table-row">
                                                <div class="table-cell1">

                                                    <p><b>Name :</b> {{Auth::user()->full_name}}</p>
                                                    <p><b>E-Mail :</b> {{Auth::user()->email_id}}</p>
                                                    <p><b>Mobile :</b> {{Auth::user()->mobile_number}}</p>
                                                    <p><b>Board :</b> {{Controller::getClassNameByRegdUserId(Auth::user()->t_regd_user_details_id)}}</p>
                                                    <p><b>Class :</b> {{Controller::getBoardNameByRegdUserId(Auth::user()->t_regd_user_details_id)}}</p>
                                                    <p><b>Shool/Collage Name :</b> {{Controller::getInstituteNameByRegdUserId(Auth::user()->t_regd_user_details_id)}}</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">

                                        <div class="container multiple">
                                            <div class="table-row">
                                                <div class="table-cell1">
                                                    <p><b>Type Of Transaction :</b> Lorem Epsum</p>
                                                    <p><b>Date Of Transaction :</b> 12/06/2021</p>
                                                    <p><b>Time Transaction :</b>10 : 32 AM</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.tab-pane -->
                                    
                                </div><!-- /.tab-content -->
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>

        </div> 
    </section>
</main>

@endsection