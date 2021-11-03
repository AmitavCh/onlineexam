@extends('layouts.iframelightbox')
@section('home-title')
Master | Sub Menu Management
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
                            <div class="col-md-2">
                                <div class="form-group margine10bot">
									<label for="course_name"><span class="formError">*</span> Menu Name</label>
									@if(isset($viewDataObj->t_menu_id) && $viewDataObj->t_menu_id != '')
									<select class="form-control" id="t_menu_id" name="TSubMenu[t_menu_id]">
										@foreach($menuArr as $menu)
										<option value="{{$menu['id']}}"<?php if(($viewDataObj->t_menu_id) == $menu['id'])echo'selected="selected"';?>>{{$menu['name']}}</option>
										@endforeach
									</select>
									@else
									<select class="form-control" id="t_menu_id" name="TSubMenu[t_menu_id]">
										@foreach($menuArr as $menu)
											<option value="{{$menu['id']}}">{{$menu['name']}}</option>
										@endforeach
									</select>
									@endif
								</div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Sub Menu Name</label>
									@if(isset($viewDataObj->sub_menu_name) && $viewDataObj->sub_menu_name != '')
										<input type="text" name="TSubMenu[sub_menu_name]" class="form-control" id="sub_menu_name" value="{{$viewDataObj->sub_menu_name}}"autocomplete="off"/>
									@else
										<input type="text" name="TSubMenu[sub_menu_name]" class="form-control" id="sub_menu_name" autocomplete="off"/>
									@endif	
                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Sub Menu Order</label>
									@if(isset($viewDataObj->sub_menu_order) && $viewDataObj->sub_menu_order != '')
										<input type="text" name="TSubMenu[sub_menu_order]" maxlength="25" class="form-control" id="sub_menu_order" onkeypress="javascript: return isNumberKey(this)" value="{{$viewDataObj->sub_menu_order}}"autocomplete="off"/>
									@else
										<input type="text" name="TSubMenu[sub_menu_order]" maxlength="55" class="form-control" id="sub_menu_order" onkeypress="javascript: return isNumberKey(this)"autocomplete="off"/>
									@endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Sub Menu Url</label>
									@if(isset($viewDataObj->sub_menu_url) && $viewDataObj->sub_menu_url != '')
										<input type="text" name="TSubMenu[sub_menu_url]" class="form-control" id="sub_menu_url" value="{{$viewDataObj->sub_menu_url}}"autocomplete="off"/>
									@else
										<input type="text" name="TSubMenu[sub_menu_url]" class="form-control" id="sub_menu_url" autocomplete="off"/>
									@endif
                                </div>
                            </div>
							<div class="col-md-2">
                                <div class="form-group margine10bot">
                                    <label for="course_name">Method :</label>
									@if(isset($viewDataObj->action) && $viewDataObj->action != '')
										<input type="text" name="TSubMenu[action]" class="form-control" id="action" value="{{$viewDataObj->action}}"autocomplete="off"/>
									@else
										<input type="text" name="TSubMenu[action]" class="form-control" id="action" autocomplete="off"/>
									@endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group margine10bot">
                                    <label for="course_name">Sub Menu Icon :</label>
									@if(isset($viewDataObj->sub_menu_icon) && $viewDataObj->sub_menu_icon != '')
										<input type="text" name="TSubMenu[sub_menu_icon]" maxlength="25" class="form-control" id="sub_menu_icon" value="{{$viewDataObj->sub_menu_icon}}"autocomplete="off"/>
									@else
										<input type="text" name="TSubMenu[sub_menu_icon]" maxlength="55" class="form-control" id="sub_menu_icon" autocomplete="off"/>
									@endif
                                </div>
                            </div>
                        </div>						
                        <div class="box-footer">
                            <button type="button" onclick="validateSubMenuData();" class="btn btn-success">Save</button>
                            <button class="btn btn-warning" onclick="cancelFrm();" type="button">Refresh</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>			
    </div>
</section>
@endsection