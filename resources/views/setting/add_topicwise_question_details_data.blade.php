@extends('layouts.iframelightbox')
@section('home-title')
Master | Topic Management
@endsection
@section('admin-content')
<link rel="stylesheet" type="text/css" href="{{asset('public/js/plugins/bootstrap-fileinput/fileinput.min.css')}}">
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
                    <form action="{{url('setting/saveTopicWiseQuestionsDetails')}}" method="post" id="entryFrm" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if(isset($viewDataObj->_id) && $viewDataObj->_id != '')
                            <input type="hidden" name="_id"  class="form-control" id="_id"  value="{{$viewDataObj->_id}}" autocomplete="off"/>
                        @else
                            <input type="hidden" name="_id" class="form-control" id="_id" >
                        @endif
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
									<label for="course_name"><span class="formError">*</span> Class Name</label>
									@if(isset($viewDataObj->t_class_details_id) && $viewDataObj->t_class_details_id != '')
									<select class="form-control" id="t_class_details_id" name="TTopicWiseQuestionDetails[t_class_details_id]" onchange="getSubjectNameList(this.value);">
										@foreach($classArr as $menu)
										<option value="{{$menu['id']}}"<?php if(($viewDataObj->t_class_details_id) == $menu['id'])echo'selected="selected"';?>>{{$menu['name']}}</option>
										@endforeach
									</select>
									@else
									<select class="form-control" id="t_class_details_id" name="TTopicWiseQuestionDetails[t_class_details_id]" onchange="getSubjectNameList(this.value);">
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
                                    <select name="TTopicWiseQuestionDetails[t_subject_details_id]" maxlength="25" class="form-control" id="t_subject_details_id" autocomplete="off" onchange="getTopicNameList(this.value);"/></select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Topic Name</label>
                                    <select name="TTopicWiseQuestionDetails[t_topic_details_id]" maxlength="25" class="form-control" id="t_topic_details_id" autocomplete="off"/></select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Description :</label>
                                    @if(isset($viewDataObj->question_details) && $viewDataObj->question_details != '')
                                    <?php $text1 = htmlspecialchars_decode($viewDataObj->question_details)?>
                                    <textarea name="TTopicWiseQuestionDetails[question_details]" class="form-control textareas" id="question_details"><?php echo $text1?></textarea>
                                    <input type="hidden" name="TTopicWiseQuestionDetails[question_details]" class="form-control" id="desc" autocomplete="off"/>
                                    @else
                                    <textarea name="TTopicWiseQuestionDetails[question_details]" class="form-control textareas" id="question_details"></textarea>
                                    <input type="hidden" name="TTopicWiseQuestionDetails[question_details]" class="form-control" id="desc" autocomplete="off"/>
                                    @endif
                                
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Option1</label>
                                    @if(isset($viewDataObj->option1) && $viewDataObj->option1 != '')
                                        <input type="text" name="TTopicWiseQuestionDetails[option1]" class="form-control" id="option1"  value="{{$viewDataObj->option1}}" autocomplete="off"/>
                                    @else
                                        <input type="text" name="TTopicWiseQuestionDetails[option1]" class="form-control" id="option1" autocomplete="off"/>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Option2</label>
                                    @if(isset($viewDataObj->option2) && $viewDataObj->option2 != '')
                                        <input type="text" name="TTopicWiseQuestionDetails[option2]" class="form-control" id="option2"  value="{{$viewDataObj->option2}}" autocomplete="off"/>
                                    @else
                                        <input type="text" name="TTopicWiseQuestionDetails[option2]" class="form-control" id="option2" autocomplete="off"/>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Option3</label>
                                    @if(isset($viewDataObj->option3) && $viewDataObj->option3 != '')
                                        <input type="text" name="TTopicWiseQuestionDetails[option3]" class="form-control" id="option3"  value="{{$viewDataObj->option3}}" autocomplete="off"/>
                                    @else
                                        <input type="text" name="TTopicWiseQuestionDetails[option3]" class="form-control" id="option3" autocomplete="off"/>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group margine10bot">
                                    <label for="course_name"><span class="formError">*</span>Option4</label>
                                    @if(isset($viewDataObj->option4) && $viewDataObj->option4 != '')
                                        <input type="text" name="TTopicWiseQuestionDetails[option4]" class="form-control" id="option4"  value="{{$viewDataObj->option4}}" autocomplete="off"/>
                                    @else
                                        <input type="text" name="TTopicWiseQuestionDetails[option4]" class="form-control" id="option4" autocomplete="off"/>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group margine10bot">
                                    <label for="course_name">Correct Options</label>
                                    <select class="form-control" id="correct_option" name="TTopicWiseQuestionDetails[correct_option]" autocomplete="off"/>
                                        @if(isset($viewDataObj->correct_option) && $viewDataObj->correct_option != '')
                                        <option <?php if($viewDataObj->correct_option=="A"){ ?> selected="selected" <?php } ?> value="A">A</option>   
                                        <option <?php if($viewDataObj->correct_option=="B"){ ?> selected="selected" <?php } ?> value="B">B</option>
                                        <option <?php if($viewDataObj->correct_option=="C"){ ?> selected="selected" <?php } ?> value="C">C</option>   
                                        <option <?php if($viewDataObj->correct_option=="D"){ ?> selected="selected" <?php } ?> value="D">D</option>   
                                        @else
                                        <option value="A">A</option>   
                                        <option value="B">B</option>
                                        <option value="C">C</option>   
                                        <option value="D">D</option> 
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="margine10bot">
                                    <label for="exampleInputEmail1">Upload File(* Maximum File Size 1Mb)</label>
                                    <input name="image" type="file" id="image_name" class="form-control" data-preview-file-type="any" multiple >								
                                    <div id="app_photo_error"></div>
                                    <div id="student_photo_valderror"></div>	
                                    <span><br>
                                        @if(isset($viewDataObj->image_photo) && $viewDataObj->image_photo != '')
                                        <div class="controls" id="filePreviewDv"> 
                                            <img src="{{asset('public/questionimage/orig/'.$viewDataObj->image_photo)}}" height="100">
                                        </div>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group margine10bot">
                                    <label for="course_name">Reference Link</label>
                                    @if(isset($viewDataObj->reference_link) && $viewDataObj->reference_link != '')
                                        <input type="text" name="TTopicWiseQuestionDetails[reference_link]" class="form-control" id="reference_link"  value="{{$viewDataObj->reference_link}}" autocomplete="off"/>
                                    @else
                                        <input type="text" name="TTopicWiseQuestionDetails[reference_link]" class="form-control" id="reference_link" autocomplete="off"/>
                                    @endif
                                </div>
                            </div>
                        </div>						
                        <div class="box-footer">
                            <button type="button" onclick="validateTopicWiseQuestionDetailsData();" class="btn btn-success">Save</button>
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
<script src="{{asset('public/js/plugins/bootstrap-fileinput/fileinput.min.js')}}"></script>
<script> 
    var photo_selected_cnt          =	0;
    var photo_name					=	'';
    var photo_size					=	'';
    var photo_download_name         =	'';
    $(document).ready(function(){
        $("#image_name").fileinput({ 
            dropZoneTitle:'',
            showPreview:true,
            showRemove:false,
            showCancel:false,
            maxFileCount: 1,
            elErrorContainer:'#app_photo_error',
            uploadExtraData: {
                    'X-CSRF-Token': csrfTkn,
                    'upload_folder_name':'questionimage',
                    'input_name_attr':'file_upload'
            }
        });

    });
</script>
<script> 
    CKEDITOR.replace( 'question_details',{ allowedContent:true} );
    $('.textareas').ckeditor();
</script>
@endsection
