@extends('layouts.iframelightbox')
@section('home-title')
Master | Menu Management
@endsection
@section('admin-content')
<link rel="stylesheet" type="text/css" href="{{asset('public/js/plugins/bootstrap-fileinput/fileinput.min.css')}}">
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/plugins/bootstrap-fileinput/fileinput.min.js')}}"></script>
<style>
    .file-preview {

        border-radius: 5px;
        border: 1px solid #ddd;
        padding: 5px;
        width: 100%;
        margin-bottom: 5px;
        height: 266px;

    }
</style>
<?php
$total_photo_selected_cnt = 0;
$total_photo_uploaded_cnt = 0;
$photo_name = '';
$photo_size = '';
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
         @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable" id="sucMsgDiv">
                <i class="fa fa-check"></i>
                <b>Success! {{ Session::get('message') }}</b>
				<script>setTimeout(function(){ $('#sucMsgDiv').fadeOut('slow'); }, 2000);</script>
				<script>setTimeout(function(){window.parent.location.reload(true);}, 3000); </script>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissable" id="failMsgDiv">
                <i class="fa fa-ban"></i>
                <b>Info! {{ Session::get('error') }}</b>
				<script>setTimeout(function(){ $('#failMsgDiv').fadeOut('slow'); }, 8000);</script>
				<script>setTimeout(function(){window.parent.location.reload(true);}, 3000); </script>
			</div>
            @endif	
		</div>			
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body">
                    <form action="{{ url('user/saveMasterUser') }}" method="post" role="form" id="entryFrm" enctype="multipart/form-data">
                        @if(isset($viewDataObj->_id) && $viewDataObj->_id != '')
							<input type="hidden" name="_id" maxlength="25" class="form-control" id="_id"  value="{{$viewDataObj->_id}}" autocomplete="off"/>
						@else
							<input type="hidden" name="_id" class="form-control" id="_id" >
						@endif
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group margine10bot">
                                    <label for="inquiry_name"><span class="formError">*</span>Full Name:</label>
                                    @if(isset($viewDataObj->full_name) && $viewDataObj->full_name != '')
										<input type="text" name="User[full_name]" maxlength="25" class="form-control" id="full_name"  value="{{$viewDataObj->full_name}}" autocomplete="off"/>
									@else
										<input type="text" name="User[full_name]" class="form-control" id="full_name" autocomplete="off">
									@endif
                                </div>
                            </div>
							<div class="col-md-4">
                                <div class="form-group margine10bot">
                                    <label for="inquiry_name"><span class="formError">*</span>Email Address:</label>
                                    @if(isset($viewDataObj->email_id) && $viewDataObj->email_id != '')
										<input type="text" name="User[email_id]" maxlength="25" class="form-control" id="email_id"  value="{{$viewDataObj->email_id}}" autocomplete="off"/>
									@else
										<input type="text" name="User[email_id]" class="form-control" id="email_id" autocomplete="off">
									@endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group margine10bot">
                                    <label for="inquiry_name"><span class="formError">*</span>Mobile Number:</label>
                                    @if(isset($viewDataObj->mobile_number) && $viewDataObj->mobile_number != '')
                                    <input type="text" name="User[mobile_number]" class="form-control" id="mobile_number" value="{{$viewDataObj->mobile_number}}">
                                    @else
                                    <input type="text" name="User[mobile_number]" class="form-control" id="mobile_number" autocomplete="off">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span> Role Name :</label>
									@if(isset($viewDataObj->role_id) && $viewDataObj->role_id != '')
                                    <select class="form-control" id="role_id" name="User[role_id]">
                                        @foreach($roleArr as $role)
                                        <option value="{{$role['id']}}"<?php if(($viewDataObj->role_id) == $role['id'])echo'selected="selected"';?>>{{$role['name']}}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <select class="form-control" id="role_id" name="User[role_id]">
                                        @foreach($roleArr as $role)
                                        <option value="{{$role['id']}}">{{$role['name']}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group margine10bot">
                                    <label for="inquiry_name"><span class="formError">*</span>Password:</label>
									@if(isset($viewDataObj->ogr_password) && $viewDataObj->ogr_password != '')
                                    <input type="text" name="User[ogr_password]" class="form-control" id="ogr_password" value="{{$viewDataObj->ogr_password}}">
                                    @else
                                    <input type="text" name="User[ogr_password]" class="form-control" id="ogr_password" autocomplete="off">
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-md-4">
                                <div class="margine10bot">
                                    <label for="exampleInputEmail1">Profile Photo</label>
                                    <input name="image" type="file" id="profile_photo" class="form-control" data-preview-file-type="any" multiple >								
                                    <div id="app_photo_error"></div>
                                    <div id="student_photo_valderror"></div>	
                                    <span><br>
                                        @if(isset($viewDataObj->profile_photo) && $viewDataObj->profile_photo != '')
                                        <div class="controls" id="filePreviewDv"> 
                                            <img src="{{asset('public/user/orig/'.$viewDataObj->profile_photo)}}" height="100">
                                        </div>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            @if(isset($viewDataObj->_id) && $viewDataObj->_id != '')
                            <button type="button" onclick="userValidates();" class="btn btn-success">Save</button>
                            @else
                            <button type="button" onclick="userValidate();" class="btn btn-success">Save</button>
                            @endif
                            <button class="btn btn-warning" onclick="cancelFrm();" type="button">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>			
    </div>
</section>
<script>
    var photo_selected_cnt = 0;
    var photo_name = '';
    var photo_size = '';
    var photo_download_name = '';
    $(document).ready(function(){
    $("#profile_photo").fileinput({
    uploadUrl: baseUrl + '/master/uploadImage',
            dropZoneTitle:'',
            showPreview:true,
            showRemove:false,
            showCancel:false,
            maxFileCount: 4,
            elErrorContainer:'#app_photo_error',
            uploadExtraData: {
            'X-CSRF-Token': csrfTkn,
                    'upload_folder_name':'user',
                    'input_name_attr':'file_upload'
            }
    });
    });
    function userValidate(){
        $('.registerBtn').prop('disabled',true);
        $('.imgLoader').show();
        $('.error-message').remove();
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': csrfTkn
            }
        });
        $.ajax({
            url:baseUrl+'/user/validateMasterUser',
            type: 'post',
            cache: false,
            data:{
                "formData": $('#entryFrm').serialize(),
            },
            success: function(res){
                $('.imgLoader').hide();
                var resp	=   res.split('****');
                if(resp[1] == 'ERROR'){
                    $('.registerBtn').prop('disabled',false);
                }else{
                    if(resp[1] == 'FAILURE'){
                        $('.btn btn-success').prop('disabled',false);
                       showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        document.forms['entryFrm'].submit();
                    }
                }
            },
            error: function(xhr, textStatus, thrownError) {
                alert('Something went to wrong.Please Try again later...');
            }
        });
    }
    function userValidates(){
        $('.registerBtn').prop('disabled',true);
        $('.imgLoader').show();
        $('.error-message').remove();
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': csrfTkn
            }
        });
        $.ajax({
            url:baseUrl+'/user/validateMasterUsers',
            type: 'post',
            cache: false,
            data:{
                "formData": $('#entryFrm').serialize(),
            },
            success: function(res){
                $('.imgLoader').hide();
                var resp	=   res.split('****');
                if(resp[1] == 'ERROR'){
                    $('.registerBtn').prop('disabled',false);
                }else{
                    if(resp[1] == 'FAILURE'){
                        $('.btn btn-success').prop('disabled',false);
                       showJsonErrors(resp[2]);
                    }else if(resp[1] == 'SUCCESS'){
                        document.forms['entryFrm'].submit();
                    }
                }
            },
            error: function(xhr, textStatus, thrownError) {
                alert('Something went to wrong.Please Try again later...');
            }
        });
    }
</script>
@endsection