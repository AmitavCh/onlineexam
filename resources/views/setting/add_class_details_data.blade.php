@extends('layouts.iframelightbox')
@section('home-title')
Master | Class Management
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
                        <div class="col-md-3">
                                <div class="form-group margine10bot">
									<label for="course_name"><span class="formError">*</span> Board Name</label>
									@if(isset($viewDataObj->t_board_details_id) && $viewDataObj->t_board_details_id != '')
									<select class="form-control" id="t_board_details_id" name="TClassDetails[t_board_details_id]">
										@foreach($boardArr as $menu)
										<option value="{{$menu['id']}}"<?php if(($viewDataObj->t_board_details_id) == $menu['id'])echo'selected="selected"';?>>{{$menu['name']}}</option>
										@endforeach
									</select>
									@else
									<select class="form-control" id="t_board_details_id" name="TClassDetails[t_board_details_id]">
										@foreach($boardArr as $menu)
											<option value="{{$menu['id']}}">{{$menu['name']}}</option>
										@endforeach
									</select>
									@endif
								</div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Class Name</label>
                                    @if(isset($viewDataObj->class_name) && $viewDataObj->class_name != '')
                                        <input type="text" name="TClassDetails[class_name]" maxlength="25" class="form-control" id="class_name"  value="{{$viewDataObj->class_name}}" autocomplete="off"/>
                                    @else
                                        <input type="text" name="TClassDetails[class_name]" maxlength="25" class="form-control" id="class_name" autocomplete="off"/>
                                    @endif
                                </div>
                            </div>
                        </div>						
                        <div class="box-footer">
                            <button type="button" onclick="validateClassDetailsData();" class="btn btn-success">Save</button>
                            <button class="btn btn-warning" onclick="cancelFrm();" type="button">Refresh</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>			
    </div>
</section>
@endsection