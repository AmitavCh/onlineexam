@extends('layouts.home')
@section('home-title')
Home | Home Page
@endsection
@section('home-content')
@php
use App\Http\Controllers\Controller;
@endphp
<style>
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
    .btn-enquiry {
        background: #fcb221;
        border: 0;
        border-radius: 50px;
        padding: 7px 24px;
        color: #fff;
        transition: 0.4s;
        font-size:13px;
        font-weight: bold;
    }
    .contact .error-message {
        /* display: none; */
        color: red;
        /* background: #ed3c0d; */
        text-align: left;
        padding: 0px;
    }
</style>
<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{URL('/')}}">Home</a></li>
                <li>Register</li>
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
                        <br>
                        <div class=" social-buttn"><a class="a1" href="">Facebook</a></div>
                        <br><br>
                        <div class=" social-buttn2"><a class="a1" href="">Twitter</a></div>
                        <br><br>
                        <div class=" social-buttn3"><a class="a1" href="">Linkedin</a></div>
                        <br><br>
                    </div>
                    <div class="info-box mb-4">
                        <div class="row social-buttn4">
                            <i class='bx bxl-facebook'></i> &nbsp;
                            <i class='bx bxl-google'></i> &nbsp;
                            <i class='bx bxl-twitter'></i> &nbsp;
                            <i class='bx bxl-linkedin'></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8  mb-4 contact" style="background-color: #212959; border-radius: 5px;">
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            @if(Session::has('msg'))
                            <div class="alert alert-success alert-dismissable" id="sucMsgDiv">
                                <i class="fa fa-check"></i>
                                <b>{{ Session::get('msg') }}</b>
                                <script>setTimeout(function(){window.reload(true);}, 7000); </script>
                                <script>setTimeout(function(){ window.location.replace(baseUrl + "/home/register"); }, 7000);</script>
                            </div>
                            @endif
                        </div>			
                    </div>
                    <div class="contact-form-text ">
                        <h4 style="color:#fcb221">Login To Your Registered Account</h4>
                    </div>
                    <br/>
                    <form action="{{URL('home/userRegistration')}}" method="post" id="entryFrm" name="entryFrm">
                        {{ csrf_field() }}
                        <input type="hidden" name="_id" class="form-control" id="_id" >
                        <div class="form-group">
                            <input type="text" name="TRegdUserDetails[full_name]" class="form-control" id="full_name" placeholder="Full Name*" onkeypress="javascript : return validateAlpha(event);">
                        </div>
                        <div class="form-group">
                            <input type="text" name="TRegdUserDetails[email_id]" class="form-control" id="email_id" placeholder="Email Id*">
                        </div>
                        <div class="form-group">
                            <input type="text" name="TRegdUserDetails[mobile_number]" class="form-control" id="mobile_number" placeholder="Mobile Number*"  onkeypress="javascript : return isNumberKey(event);">
                        </div>
                        <div class="form-group">
                            <select class="form-control" placeholder="Board Name*" id="t_board_details_id" name="TRegdUserDetails[t_board_details_id]" onchange="getClassNamelist();">
                                @foreach($boardArr as $menu)
                                    <option value="{{$menu['id']}}">{{$menu['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" placeholder="Class Name*" id="t_class_details_id" name="TRegdUserDetails[t_class_details_id]" autocomplete="off"/></select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="TRegdUserDetails[institute_name]" id="institute_name" placeholder="School/College Name*">
                        </div>
                        <div class="text-center"><button onclick="validateUserRegdDetailsData();" class="btn-enquiry" type="button">Sign In</button></div>
                    </form>
                    <div>
                        <h5 style="color:white; float:bottom;">Are you a member?  &nbsp;  &nbsp;<a href="{{URL('home/login')}}"> Login Now</a></h5>
                    </div>

                    <br>
                </div>
            </div>
        </div> 
    </section><!-- End Contact Section -->

</main>

@endsection
<script>
    function showJsonErrors(errors){	
        if(errors != ''){
            resp = $.parseJSON(errors);
            var totErrorLen = resp.length;	
            for(var errCnt =0;errCnt <totErrorLen;errCnt++){
                var modelField         =   resp[errCnt]['modelField'];
                var modelErrorMsg      =   resp[errCnt]['modelErrorMsg'];
                $('[id="'+modelField+'"]').after('<div class="error-message">'+modelErrorMsg+'</div>'); 
            }
        }
    }
    function validateUserRegdDetailsData(){
            $.ajaxSetup({
                headers: {
                        'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/home/validateUserRegdDetailsData',
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