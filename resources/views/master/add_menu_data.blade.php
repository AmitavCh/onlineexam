@extends('layouts.iframelightbox')
@section('home-title')
Master | Menu Management
@endsection
@section('admin-content')
<section class="content">
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
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body">
                    <form method="post" id="entryFrm" name="entryFrm">
                        {{ csrf_field() }}
                        @if(isset($viewDataObj->_id) && $viewDataObj->_id != '')
							<input type="hidden" name="_id" maxlength="25" class="form-control" id="_id"  value="{{$viewDataObj->_id}}" autocomplete="off"/>
						@else
							<input type="hidden" name="_id" class="form-control" id="_id" >
						@endif
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Menu Name</label>
									@if(isset($viewDataObj->menu_name) && $viewDataObj->menu_name != '')
										<input type="text" name="TMenu[menu_name]" maxlength="25" class="form-control" id="menu_name" value="{{$viewDataObj->menu_name}}"autocomplete="off"/>
									@else
										<input type="text" name="TMenu[menu_name]" maxlength="25" class="form-control" id="menu_name" autocomplete="off"/>
									@endif										 
                                 </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Menu Order</label>
									@if(isset($viewDataObj->menu_order) && $viewDataObj->menu_order != '')
										<input type="text" name="TMenu[menu_order]" maxlength="25" class="form-control" id="menu_order" value="{{$viewDataObj->menu_order}}" onkeypress="javascript: return isNumberKey(this)" autocomplete="off"/>
									@else
										<input type="text" name="TMenu[menu_order]" maxlength="25" class="form-control" id="menu_order" onkeypress="javascript: return isNumberKey(this)" autocomplete="off"/>
									@endif
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group margine10bot">
                                    <label for="course_name">Menu Icon</label>
									@if(isset($viewDataObj->menu_icon) && $viewDataObj->menu_icon != '')
										<input type="text" name="TMenu[menu_icon]" maxlength="25" class="form-control" id="menu_icon" value="{{$viewDataObj->menu_icon}}" autocomplete="off"/>
									@else
										<input type="text" name="TMenu[menu_icon]" maxlength="25" class="form-control" id="menu_icon" autocomplete="off"/>
									@endif
                                </div>
                            </div>
							<div class="col-md-4">
                                <div class="form-group margine10bot">
                                    <label for="course_name">Menu URL</label>
                                    @if(isset($viewDataObj->menu_url) && $viewDataObj->menu_url != '')
										<input type="text" name="TMenu[menu_url]" maxlength="25" class="form-control" id="menu_url"  value="{{$viewDataObj->menu_url}}" autocomplete="off"/>
									@else
										<input type="text" name="TMenu[menu_url]" maxlength="25" class="form-control" id="menu_url" autocomplete="off"/>
									@endif
                                </div>
                            </div>
							<div class="col-md-4">
                                <div class="form-group margine10bot">
                                    <label for="course_name">Controller</label>
									@if(isset($viewDataObj->controller) && $viewDataObj->controller != '')
										<input type="text" name="TMenu[controller]" maxlength="25" class="form-control" id="controller"  value="{{$viewDataObj->controller}}" autocomplete="off"/>
									@else
										<input type="text" name="TMenu[controller]" maxlength="25" class="form-control" id="controller" autocomplete="off"/>
                                    @endif
                                </div>
                            </div>
                        </div>						
                        <div class="box-footer">
                            <button type="button" onclick="validateMenuData();" class="btn btn-success">Save</button>
                            <button class="btn btn-warning" onclick="cancelFrm();" type="button">Refresh</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>			
    </div>
</section>
@endsection