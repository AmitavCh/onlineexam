@extends('layouts.login')
@section('home-title')
User | Login
@endsection
@section('user-content')
<h1 style="width:100%;font-weight:500;padding-top:40px;text-align:center;font-family:sans-serif;"><b></b> </h1> 
<div class="login-logo">
    <b style="color:#ffffff;">Sign In</b><br/>
</div>
<style>
    html{
        background-image: url(../public/img/bg.jpg); background-size:1500px 750px;
        background-size: auto;
    }
    .login-page{
        background: transparent;
    }
    .login-box-body{

        background: #fff;
        padding: 20px;
        color: #444;
        border-top: 0;
        color: #666;
        border-radius: 10px;

    }
</style>
<div class="login-box-body">
    <p class="login-box-msg">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissable" id="sucMsgDiv" style="display: none;">
                <span class="sucmsgdiv"></span>					
            </div>
            <div class="alert alert-danger alert-dismissable" id="failMsgDiv" style="display: none;">
                <span class="failmsgdiv"></span>
            </div>
            @if(Session::has('error'))
            <div role="alert" class="alert alert-danger alert-dismissable">
                <strong>Info !</strong>
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
    </div>
</p>
<form action="user/signup" method="post" method="post">
    {{ csrf_field() }}
    <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-8">    
        <div class="checkbox icheck">
            <label class="">
                <div class="icheckbox_square-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> Remember Me
            </label>
        </div>                        
    </div>
    <div class="col-xs-4"></div>
    <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
    </div>
    <div class="col-xs-4"></div>
</div>
</form>
<div class="social-auth-links text-center"><a href="{{URL::to('user/resetpassword')}}">I forgot my password</a><br></div>
</div>
@endsection