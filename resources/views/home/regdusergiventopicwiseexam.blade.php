@extends('layouts.home')
@section('home-title')
Home | Dashboard
@endsection
@section('home-content')
@php
use App\Http\Controllers\Controller;
@endphp
<style>
.userbtn{
    background-color: #212959;
    color: #fff;
    border-radius: 5px;
    height: 40px;
    text-align: left;
    padding-left: 10px;
    padding-top: 9px;
    font-size: 14px;
    width: 100%;
 }

 .a1{
    color: #fff;
}

.a1:hover{
    color: #fcb221;
}

.card1{
    position: relative;
    display: flex;    
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border-radius: .25rem;
}

.userbtn-dropdown2{
    background-color: #212959;
    color: #fff;
    border-radius: 5px;
    width: 100%;
    font-size: 14px;
    padding-top: 8px;
    padding-bottom: 8px;
}


.form-group {
    margin-bottom: 15px;
    width: 32%;
}
.topic-wise2{
    background-color:#212959; 
    color: #fff; 
    border-radius: 20px; 
    padding: 20px 20px 20px 20px;
    font-size: 14px;
    font-weight: lighter;
    font-family: "Open sans", sans-serif;
}

.blog .blog-comments .reply-form .form-group {
    margin-bottom: 25px;
}

.form-control1 {
    font-family: "Open sans", sans-serif;
    font-size: 14px ;
    font-weight: bold;
    display: block;
    width: 126%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 7px;
    margin-bottom: 4px;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.btn-enquiry3{
    background-color: #fcb221; 
    color: #fff; 
    border-radius: 50px; 
    font-size: 13px; 
    padding: 7px 24px;
    font-weight: bold;
}
.btn-enquiry3:hover{
    background-color: #fcb221; 
    color: #212959; 
    border-radius: 50px; 
    font-size: 13px; 
    padding: 7px 24px;
    font-weight: bold;
}

.topic-wise2{
    background-color:#212959; 
    color: #fff; 
    border-radius: 5px; 
    padding: 20px 20px 20px 20px;
}
.active{
    color:#fcb221;
}  
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
hr {
    border: 0;
    border-top: 1px solid #eee;
    margin: 0;
}    
@media (max-width: 768px){
  
    .form-group {
        margin-bottom: 15px;
        width: 92%;
    }
    .profile-tab {
    background-color: #212959;
    border-radius: 5px;
    height: 600px;
    margin-top: 25px;
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
                <div class="col-lg-3">
                    <div class="userbtn"><i class="fa fa-dashboard"></i> &nbsp;<a class="a1" href="{{URL('home/dashboard')}}"> Dashboard</a></div>
                    <br>
                    <div class="userbtn"><i class="fa fa-bandcamp"></i> &nbsp;<a class="a1 active" href="{{URL('home/topiclist')}}"> Topic wise Test</a></div>
                    <br>
                    <!-- <div class="userbtn"><i class="fa fa-bandcamp"></i> &nbsp;<a class="a1" href="{{URL('home/setlist')}}"> Set wise Test</a></div>
                    <br> -->
                    <p class="userbtn" style="margin-bottom: 25px;">
                        <a class="a1"  data-toggle="collapse" href="#collapseExample" role="button"  aria-expanded="false" aria-controls="collapseExample" style="text-decoration:none"><i class="fa fa-file"></i>&nbsp; Performance Report &nbsp;&nbsp;&nbsp;&nbsp;<i class="icofont-caret-down"></i></a>
                    </p>
                    <div class="collapse" id="collapseExample" style="margin-top: -15px; margin-bottom: 10px">
                        <div class="card1">
                            <a href="{{URL('home/topicwiseperfomance')}}" class="userbtn-dropdown2 a1" style="color: #fcb221"><i class="fa fa-bar-chart" style="margin-left:30px; color: #fff"></i> &nbsp;Topic Wise</a>
                            <br>
                            <!-- <a href="{{URL('home/setwiseperfomance')}}" class="userbtn-dropdown2 a1" style="margin-top: -15px; color: #fcb221"><i class="fa fa-bar-chart" style="margin-left:30px; color: #fff"></i> &nbsp;Set Wise</a> -->
                        </div>
                    </div>
                    <div class="userbtn" style="border-top:"><i class="icofont-ui-user"></i> &nbsp;<a class="a1" href="{{URL('home/userprofile')}}">Profile</a></div>
                    <br>
                    <div class="userbtn"><i class="icofont-ui-password"></i> &nbsp;<a class="a1" href="{{URL('home/changepassword')}}"> Change Password</a></div>
                </div>
                <div class="col-lg-9 mb-4 profile-tab" style="background-color: #212959; border-radius: 5px;">
                <h3 class="title" style="color: #fff;">INSTRUCTION</h3><hr/>
                <form class="topic-wise2" >
                    <p>Total Selected Topic : <b><?php echo $topicCnt; ?></b></p>
                    <p>Total Number Of Questions : <b>{{$qusCnt}}</b></p>
                    <p>Each question carry 1 mark, no negative marks</p>
                    <p><b>DO NOT</b> refresh the page</p>
                    <p style="color:#FF0000;">All the best !!!!!</p>
                    <div class="row" style="padding-left: 17px;">
                        <div class="form-group">
                            <div><a  href="{{URL('home/topic_by_question_selected_by_user/'.($TopicIds))}}" class="btn-enquiry">Start Exam</a></div>
                        </div>
                    </div>
                </form>
                    
            </div>
    </div> 
   </section>
  </main>
@endsection