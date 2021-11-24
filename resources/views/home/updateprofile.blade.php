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
  margin-left: 5px;
}
.info-profile{
  font-size: 14px;
  font-family: "Open Sans", sans-serif;
  color: #fff;
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
    font-size:13px;
    font-weight: bold;
}
.profile-tab{
  background-color: #212959; 
  border-radius: 5px; 
  height: 362px;
}
.edit-profile{
  background-color: #212959;
  border-radius: 5px;
  font-size: 14px;
  font-family: "Open Sans", sans-serif;
  color: #fff;
}
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
.userbtn-dropdown2{
  background-color: #212959;
  color: #fff;
  border-radius: 5px;
  width: 100%;
  font-size: 14px;
  padding-top: 5px;
  padding-bottom: 5px;
 }
.userpanel-dashboard1{
    background-color: #212959;
    color: #fff; 
    border-radius: 5px;
    height: 40px; 
    text-align: left; 
    padding-left: 10px; 
    padding-top: 9px; font-size: 14px; 
    width: 100%;
}
.link{
  color: #fff;
}
.browse-btn{
  margin-left: 40px;
}
.spacing{
  margin-bottom: 15px;
}
.img-upload-brs{
  margin-top: 50px;
}
.active{
        color:#fcb221;
    } 
@media (max-width: 768px){
  .edit-profile{
  margin-top: 30px;
  background-color: #212959;
  border-radius: 5px;
  font-size: 14px;
  font-family: "Open Sans", sans-serif;
  color: #fff;
}
.profile-tab{
  background-color: #212959; 
  border-radius: 5px; 
  height: 600px;
  margin-top: 25px;
}
.student_img{
   display: flex; flex-flow: column-reverse; 
}
.form-height{
  margin-top: 25px;
}
.btn-profile{
  margin-left: 30px;
}
.browse{
  margin-left: 127px;
 
}
.browse-img{
  margin-bottom: 5px; 
  margin-left: 107px;
}
.browse-btn{
  margin-left: 121px;
  margin-bottom: 10px;
  margin-right: 100px;
}

}

.profile-pic {
  color: transparent;
  transition: all .3s ease;
  position: relative;
  transition: all .3s ease;
  input {
    display: none;
  }
  img {
    position: absolute;
    object-fit: cover;
    width: $circleSize;
    height: $circleSize;
    box-shadow: $shadow;
    border-radius: $radius;
    z-index: 0;
  }
  span {
    display: inline-flex;
    padding: .2em;
    height: 2em;
  }
  div .error-message{
        color: red !important;
        text-align: left;
        padding: 0px;
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
                    <div class="userbtn" style="border-top:"><i class="icofont-ui-user"></i> &nbsp;<a class="a1 active" href="{{URL('home/userprofile')}}">Profile</a></div>
                    <br>
                    <div class="userbtn"><i class="icofont-ui-password"></i> &nbsp;<a class="a1" href="{{URL('home/changepassword')}}"> Change Password</a></div>
                </div>
                
                <div class="col-lg-9 mb-4 edit-profile">
                    <div class="contact-form-text ">
                        <h4 style="color:#fcb221; margin-top: 15px">Edit Profile</h4>
                    </div>
                    <form  action="{{URL('home/userUpdateProfile')}}" method="post" id="entryFrm" name="entryFrm" enctype="multipart/form-data">
                    <div class="row student-profile">
                    
                        <div class="col-md-3">
                            <?php if(Auth::user()->profile_photo == ''){ ?>
                            <div>
                                <img src="{{asset('public/frontend/assets/img/student-image.png')}}" id="output" width="175" class="browse-img" />
                                <div class="spacing" style="margin-top: 20px;">
                                    <input name="image" type="file" id="file" onchange="loadFile(event)" class="browse" />
                                </div>
                            </div>
                            <?php }else{?>
                            <div>
                                <img src="{{asset('public/userphoto/orig/'.Auth::user()->profile_photo)}}" id="output" width="175" class="browse-img" />
                                <div class="spacing" style="margin-top: 20px;">
                                    <input name="image" type="file" id="file" onchange="loadFile(event)" class="browse" />
                                </div>
                            </div>    
                            <?php }?>   

                        </div>
                        <div class="col-md-9 form-height">
                           
                                {{ csrf_field() }}
                                <input type="hidden" name="_id" class="form-control" id="_id" >
                                <div class="form-group">
                                    <input type="text" name="TRegdUserDetails[full_name]" class="form-control" id="full_name" placeholder="Full Name*" value="{{Auth::user()->full_name}}" onkeypress="javascript : return validateAlpha(event);">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="TRegdUserDetails[email_id]" class="form-control" id="email_id" placeholder="Email Id*" value="{{Auth::user()->email_id}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="TRegdUserDetails[mobile_number]" class="form-control" id="mobile_number" placeholder="Mobile Number*"  value="{{Auth::user()->mobile_number}}" onkeypress="javascript : return isNumberKey(event);">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="TRegdUserDetails[institute_name]" id="institute_name" value="{{Controller::getInstituteNameByRegdUserId(Auth::user()->t_regd_user_details_id)}}" placeholder="School/College Name*">
                                </div>
                           
                            <div>
                                <button type="button" onclick="validateUserUpdateDetailsData();" class="btn-profile">Submit</button>
                            </div><br>
                        </div>
                    
                    </div>
                    </form>
                </div>
                
            </div> 
        </div>
    </section>
</main>
<script type="text/javascript">
  var loadFile = function (event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);
  };

  function validateUserUpdateDetailsData(){
        $.ajaxSetup({
            headers: {
                    'X-CSRF-Token': csrfTkn
            }
        });
        $.ajax({
            url:baseUrl+'/home/validateUserUpdateDetailsData',
            type: 'post',
            cache: false,                   
            data:{
                "formdata": $('#entryFrm').serialize(),
            },
            success: function(res){     
                var resp        =   res.split('****'); 
                if(resp[1] == 'ERROR'){                                         
                    $('#failMsgDiv').removeClass('text-none');
                    $('.failmsgdiv').html(resp[2]);
                    $('#failMsgDiv').show('slow');
                }else if(resp[1] == 'FAILURE'){
                    showJsonErrors(resp[2]);
                }else if(resp[1] == 'SUCCESS'){
                    submitFrom();
                }      
            },
            error: function(xhr, textStatus, thrownError) {
                //alert('Something went to wrong.Please Try again later...');
            }
        });
    }
    function submitFrom(){
        $('#entryFrm').submit();
    }
</script>
@endsection