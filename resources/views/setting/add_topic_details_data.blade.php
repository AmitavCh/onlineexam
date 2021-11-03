@extends('layouts.iframelightbox')
@section('home-title')
Master | Topic Management
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
									<label for="course_name"><span class="formError">*</span> Class Name</label>
									@if(isset($viewDataObj->t_class_details_id) && $viewDataObj->t_class_details_id != '')
									<select class="form-control" id="t_class_details_id" name="TTopicDetails[t_class_details_id]" onchange="getSubjectNameList(this.value);">
										@foreach($classArr as $menu)
										<option value="{{$menu['id']}}"<?php if(($viewDataObj->t_class_details_id) == $menu['id'])echo'selected="selected"';?>>{{$menu['name']}}</option>
										@endforeach
									</select>
									@else
									<select class="form-control" id="t_class_details_id" name="TTopicDetails[t_class_details_id]" onchange="getSubjectNameList(this.value);">
										@foreach($classArr as $menu)
											<option value="{{$menu['id']}}">{{$menu['name']}}</option>
										@endforeach
									</select>
									@endif
								</div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Subbject Name</label>
                                    <select name="TTopicDetails[t_subject_details_id]" maxlength="25" class="form-control" id="t_subject_details_id" autocomplete="off"/></select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Topic Name</label>
                                    @if(isset($viewDataObj->topic_name) && $viewDataObj->topic_name != '')
                                        <input type="text" name="TTopicDetails[topic_name]" maxlength="25" class="form-control" id="topic_name"  value="{{$viewDataObj->topic_name}}" autocomplete="off"/>
                                    @else
                                        <input type="text" name="TTopicDetails[topic_name]" maxlength="25" class="form-control" id="topic_name" autocomplete="off"/>
                                    @endif
                                </div>
                            </div>
                        </div>						
                        <div class="box-footer">
                            <button type="button" onclick="validateTopicDetailsData();" class="btn btn-success">Save</button>
                            <button class="btn btn-warning" onclick="cancelFrm();" type="button">Refresh</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>			
    </div>
</section>
@endsection