@extends('layouts.iframelightbox')
@section('home-title')
Master | Class Management
@endsection
@section('admin-content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
             @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable" id="sucMsgDiv">
                <i class="fa fa-check"></i>
                <b>Success! {{ Session::get('message') }}</b>
                <script> setTimeout(function(){window.parent.location.reload(true);}, 3000);</script>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissable" id="failMsgDiv">
                <i class="fa fa-ban"></i>
                <b>Info! {{ Session::get('error') }}</b>
                <script> setTimeout(function(){window.parent.location.reload(true);}, 3000);</script>
            </div>
            @endif
        </div>			
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body">
                <form action="{{url('setting/saveNoticeDetails')}}" method="post" id="entryFrm" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if(isset($viewDataObj->_id) && $viewDataObj->_id != '')
                            <input type="hidden" name="_id"  class="form-control" id="_id"  value="{{$viewDataObj->_id}}" autocomplete="off"/>
                        @else
                            <input type="hidden" name="_id" class="form-control" id="_id" >
                        @endif
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span> Board Name</label>
                                    @if(isset($viewDataObj->t_board_details_id) && $viewDataObj->t_board_details_id != '')
                                    <select class="form-control" id="t_board_details_id" name="TNoticeDetails[t_board_details_id]" onchange="getClassNameListByBoardId(this.value);">
                                        @foreach($responseArr as $menu)
                                        <option value="{{$menu['id']}}"<?php if(($viewDataObj->t_board_details_id) == $menu['id'])echo'selected="selected"';?>>{{$menu['name']}}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <select class="form-control" id="t_board_details_id" name="TNoticeDetails[t_board_details_id]" onchange="getClassNameListByBoardId(this.value);">
                                        @foreach($responseArr as $menu)
                                            <option value="{{$menu['id']}}">{{$menu['name']}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Class Name</label>
                                    <select name="TNoticeDetails[t_class_details_id]" maxlength="25" class="form-control" id="t_class_details_id" autocomplete="off"></select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Description :</label>
                                    @if(isset($viewDataObj->notice_details) && $viewDataObj->notice_details != '')
                                    <?php $text1 = htmlspecialchars_decode($viewDataObj->notice_details)?>
                                    <textarea name="TNoticeDetails[notice_details]" class="form-control textareas" id="notice_details"><?php echo $text1?></textarea>
                                    <input type="hidden" name="TNoticeDetails[notice_details]" class="form-control" id="desc" autocomplete="off"/>
                                    @else
                                    <textarea name="TNoticeDetails[notice_details]" class="form-control textareas" id="notice_details"></textarea>
                                    <input type="hidden" name="TNoticeDetails[notice_details]" class="form-control" id="desc" autocomplete="off"/>
                                    @endif
                                
                                </div>
                            </div>
                        </div>						
                        <div class="box-footer">
                            <button type="button" onclick="validateNoticeDetailsData();" class="btn btn-success">Save</button>
                            <button class="btn btn-warning" onclick="cancelFrm();" type="button">Refresh</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>			
    </div>
</section>
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script src="http://cdn.ckeditor.com/4.7.3/full-all/ckeditor.js"></script>
<script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
<script> 
    CKEDITOR.replace( 'notice_details',{ allowedContent:true} );
    $('.textareas').ckeditor();
</script>
@endsection