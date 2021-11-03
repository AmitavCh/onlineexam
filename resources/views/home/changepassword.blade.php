@extends('layouts.home')
@section('home-title')
Home | Dashboard
@endsection
@section('home-content')
@php
use App\Http\Controllers\Controller;
@endphp
<style>
    .label1{
        font-size: 14px;
        color: #fff;
        font-weight: normal;
    }
    .input1{
        width: 60%;
        height: 34px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
    }
    .form-control {
         width: 30%;
    }
    .buttnSubmit_password{
        background: #fcb221;
        border: 0;
        border-radius: 50px;
        padding: 7px 24px;
        color: #fff;
        transition: 0.4s;
        font-size: 13px;
        font-weight: bold;
    }
    .buttnSubmit_password:hover{
        background-color: #fcb221; 
        color: #212959; 
        border-radius: 50px; 
        font-size: 13px; 
        padding: 7px 24px;
        font-weight: bold;
    }
    .form1{
       
        padding-left: 20px;
        
    }
    .changePassword{
        background-color: #212959; 
        border-radius: 10px; 
        padding-top: 15px;
        padding-left: 10px;
    }
    .active{
        color:#fcb221;
    } 
    .error-message{
        color: red;
    }
@media (max-width: 768px){
    .input1{
        width: 100%;
        height: 34px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
    } 
    .form1{
        margin-left: -4px;  
    } 
    .changePassword{
        margin-top: 30px;
        background-color: #212959; 
        border-radius: 10px; 
        padding-top: 15px;
        padding-left: 10px;
    }
    .form-control {
         width: 100%;
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
                    <div class="userbtn"><i class="icofont-ui-password"></i> &nbsp;<a class="a1 active" href="{{URL('home/changepassword')}}"> Change Password</a></div>
                </div>
                
                <div class="col-lg-9 mb-4 changePassword" style="background-color: #212959;; border-radius: 5px; height: 325px;">
                        
                    <form action="" class="form1" method="post" role="form" id="entryFrm" enctype="multipart/form-data">
                        <input type="hidden" name="id" class="form-control" id="id" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="label1" for="fname">Old Password:</label>
                            <input class="form-control" type="text" id="ogr_password" name="formdata[ogr_password]" readonly value="{{Auth::user()->ogr_password}}">
                        </div>
                        <div class="form-group">    
                            <label class="label1" for="lname">New Password:</label>
                            <input class="form-control" type="text" id="password" name="formdata[password]">
                        </div>
                        <div class="form-group">     
                            <label class="label1" for="lname">Re-enter Password:</label>
                            <input class="form-control" type="text" id="re_password" name="formdata[re_password]" value="">
                        </div> 
                     
                        <button class="buttnSubmit_password" onclick="saveUpdatePwd();" type="button">Update</button>
                    
                    </form> 
                </div>

            </div>

          </div> 
   </section>
  </main>
@endsection