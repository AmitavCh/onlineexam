@extends('layouts.ajax')
@section('admin-content')
@php
use App\Http\Controllers\Controller;
@endphp
<style>

p{
    display: inline
  }
pre {
    font-family:"Arimo",sans-serif;
    white-space: pre-wrap;       
    white-space: -moz-pre-wrap;  
    white-space: -pre-wrap;      
    white-space: -o-pre-wrap;    
    word-wrap: break-word;       
    text-decoration: none;
    padding: 10.5px;
    margin: 0 0 1px;
    font-size: 14px;
    line-height: 1.8;
    word-break: normal;
    text-overflow: ellipsis;
    display: inline-block;
    overflow: hidden;
    color: #333;
    background-color: transparent !important;
    border: 0px solid #f2f2f2;
    border-radius: 0px;
    text-align: justify;
}

.main-panel{
    background-color: #ebebeb;
    border-radius: 5px;
    
}
.question-number li{
    margin: 5px;
    display: block;
    width: 40px;
    background: #fcaf17;
    float: left;
    height: 38px;
    text-align: center;
    line-height: 40px;
    border-radius: 5px;
    font-weight: bold;
    font-size: 13px;
    color: #21295a;
    margin-left: 0px;
}
.active {
    color: #fcb221;
}
.question-number ul{
    margin-left: -20px;
}

.of-hidden{
    overflow: hidden;
}
.qa-block{
    padding: 15px 0;
}
.qa-block h3{
    margin: 0 0 30px;
    font-weight: bold;
}
.qa-block ul{
    margin: 0;
    padding: 0;
    list-style: none;
    max-width: 500px;
    font-size: 14px;
    font-weight: bold;
}
.qa-block ul li{
    margin: 0;
    padding: 0 0 20px 0;
    display: inline-block;
    width: 45%;
    font-size: 14px;
    font-weight: bold;
    margin-left: 10px;
}
.buttn-margin{
  margin: 7px !important;
}
.question{
  text-align: justify; 
  font-weight: bold; 
  color: #000;
  font-family:  "Open Sans", sans-serif;
  line-height: 31px;
  font-size: 14px;
}
.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: rgb(33 41 89);
    border-bottom: 1px solid rgba(0,0,0,.125);
}
.btn-success{
    background: #007bff !important;
}
.redbg{
    color: #ff0000 !important;
    width: auto; 
    padding:3px;
}
.greenbg{
    color: #46c600 !important;
    width: auto; 
    padding:3px;
}
.redtext{
    color: #ff0000 !important;
}
.greentext{
    color: #46c600 !important;
}
.buttn2{
    display: inline-block;
    height: 40px;
    width: 104px;
    background: #fcb221;
    border: 0;
    border-radius: 50px;
    padding: 7px 24px;
    color: #21295a;
    transition: 0.4s;
    font-size: 13px;
    font-weight: bold;
}
.number-panel .number-list{
    margin: 0;
    list-style: none;
}
.btn-test{
    text-align: center; 
    
}
.qustn{
    background-color: #ebebeb;  
    width: 1140px;
}

@media (max-width: 768px){
  .buttn2{
    display: inline-block;
    border-radius: 5px;
    background-color: #fcaf17;
    height: 100%;
    width: 100%;
    font-size: 14px;
    font-weight: bold;
    color: #21295a; 
  }
  .main-panel{
      margin-top: 25px;
  }
  .question-number ul li{
      margin-top: 50px;
  }
  .btn-test{
      margin-top: 64px;
      margin-right: 111px;
      margin-left: -17px;
  }
  .btn-group{
      margin-top: 10px;
  }
  .qustn{ 
        width: 340px;
}
}
</style>
<div class="tab-content text-center qustn">
    <div class="tab-pane active" id="Chapt1" role="tabpanel">
        <div class="row">
            <div class="col-md-3" style="text-align:justify;" id="questionNo">
                <div class="main-panel">
                    <ul class="question-number" style="margin-top: 10px;">
                        @foreach($questionListObj as $resKey=>$resVal)
                        <li id="span_q_no<?php echo $resKey?>"><a href="javascript:qnoClicked('{{$resKey}}');check();"><span style="padding-buttom: 2px;color:#000"><?php echo $resKey+1 ?></span></a></li>
                         @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
            <form action="#" method="post" id="entryFrm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="id" class="form-control" id="id">
                <input type="hidden" name="TUserSelectedTopicQuestionsForExam[user_id]" class="form-control" id="user_id" >
                <input type="hidden" name="TUserSelectedTopicQuestionsForExam[t_exam_id]" class="form-control" id="t_exam_id" >
                <input type="hidden" name="TUserSelectedTopicQuestionsForExam[t_subject_details_id]" class="form-control" id="t_subject_details_id" >
                <input type="hidden" name="TUserSelectedTopicQuestionsForExam[t_topic_details_id]" class="form-control" id="t_topic_details_id" >
                <input type="hidden" name="TUserSelectedTopicQuestionsForExam[t_topic_wise_question_details_id]" class="form-control" id="t_topic_wise_question_details_id" >
                <input type="hidden" name="TUserSelectedTopicQuestionsForExam[t_user_selected_topic_for_exam_id]" class="form-control" id="t_user_selected_topic_for_exam_id" >
                
                <div id="Chapt1" class="tabcontent">
                    <div class="of-hidden">
                        <div class="qa-block" style="text-align: left;">
                            <p style="color:#000"><pre><b id="question_number"></b>.&nbsp; <b id="question_details"></b></pre></p>
                            <br>
                            <ul>
                              <li id="col1">1.&nbsp;<label><input type="radio" class="genderCls" id="1" name="TUserSelectedTopicQuestionsForExam[user_options]" value="A"> <span class="option1"></span></label></li>
                              <li id="col2">2.&nbsp;<label><input type="radio" class="genderCls" id="2" name="TUserSelectedTopicQuestionsForExam[user_options]" value="B"> <span class="option2"></span></label></li>
                              <li id="col3">3.&nbsp;<label><input type="radio" class="genderCls" id="3" name="TUserSelectedTopicQuestionsForExam[user_options]" value="C"> <span class="option3"></span></label></li>
                              <li id="col4">4.&nbsp;<label><input type="radio" class="genderCls" id="4" name="TUserSelectedTopicQuestionsForExam[user_options]" value="D"> <span class="option4"></span></label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="btn-group">
                            <div class="col-md-3">
                                <button type="button" id="prev" class="buttn2" onclick="previousClicked();">Previous</button>
                            </div>
                            <div class="col-md-3">
                                <button type="button" id="check" class="buttn2" onclick="saveSelectedTopicAnswer();">Check</button>
                                <button type="button" id="next" class="buttn2" onclick="nextClicked();">Next</button>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <button type="button"  class="buttn2" onclick="saveSubmitTopicTest();">Submit</button>
                            </div>
                        </div>
                    </div>
                    <br/><br/>
                </div>
                <div id="ans" class="tabcontent" style="display:none;">
                    <table>
                        <tbody>
                            <tr>
                                <td id="cor_opt" style="text-align:justify;line-height: 31px;font-size:16px">Correct Option: <b id="correct_option"></b></td> 
                            </tr>
                            <tr>
                                <td id="cor_cont" style="text-align:justify;font-size:14px;font-style: italic;font-weight: bold;">Reference: <span id="referral_content_link"></span></td> 
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script>
        var currentQno = 0;
        var textCon = '';
        qnoClicked(0);
        quesColorChange();
        var attempted = {};
		function quesColorChange(){
            var arrayFromPHP = <?php echo json_encode($questionListObjs); ?>;
            $.each(arrayFromPHP, function(k,v){
                var user_options = v.user_options;
                if(user_options == undefined && user_options == null){
                    $('#span_q_no'+k).removeClass("btn-primary");
                    $('#span_q_no'+k).removeClass("btn-warning");
                    $('#span_q_no'+k).addClass("btn-primary");
                }else if(user_options == ''){
                    $('#span_q_no'+k).removeClass("btn-success");
                    $('#span_q_no'+k).removeClass("btn-warning");
                    $('#span_q_no'+k).addClass("btn-warning");
                }else{
                    $('#span_q_no'+k).removeClass("btn-primary");
                    $('#span_q_no'+k).removeClass("btn-success");
                    $('#span_q_no'+k).removeClass("btn-warning");
                    $('#span_q_no'+k).addClass("btn-success");
                }
            });
        }
		function saveCurrentQuestion(){
            if($('input[name="TUserSelectedTopicQuestionsForExam[user_options]"]:checked').attr('id') != undefined){
                var obj = {};
                obj["question_number"] = currentQno;
                obj["user_selected"] = $('input[name="TUserSelectedTopicQuestionsForExam[user_options]"]:checked').attr('id') ;
                attempted[currentQno]= obj;
                $('#span_q_no'+currentQno).removeClass("btn-primary");
                $('#span_q_no'+currentQno).removeClass("btn-warning");
                $('#span_q_no'+currentQno).addClass("btn-success");
			}else{
                $('#span_q_no'+currentQno).removeClass("btn-primary");
                $('#span_q_no'+currentQno).removeClass("btn-warning");
                $('#span_q_no'+currentQno).addClass("btn-warning");
            }
        }
		function check(){
			var qno1 = currentQno;
            $.each(attempted,function(k,v){
                var question_number = v.question_number;
                if(question_number == qno1){
					$('#'+(v.user_selected)).prop('checked',true);
				}
			});
		}
        function nextClicked() {
            var second = 1;
            var question_number = parseInt(currentQno)+parseInt(second);
            qnoClicked(question_number);
            $('#check').show();
            $('#next').hide();
            $('#ans').hide();
            $('#cor_opt').removeClass('greentext');
            $('#cor_opt').removeClass('redtext');
            $('#cor_cont').removeClass('redtext');
            $('#cor_cont').removeClass('greentext');
            $('#cor_cont a').css('color', '');
            $('#cor_cont1 a').css('color', '');
            $('#col1').removeClass('greenbg');
            $('#col2').removeClass('greenbg');
            $('#col3').removeClass('greenbg');
            $('#col4').removeClass('greenbg');
            $('#col1').removeClass('redbg');
            $('#col2').removeClass('redbg');
            $('#col3').removeClass('redbg');
            $('#col4').removeClass('redbg');
			var qno1 = currentQno;
            $.each(attempted,function(k,v){
                var question_number = v.question_number;
                if(question_number == qno1){
					$('#'+(v.user_selected)).prop('checked',true);
				}
			});
        }
        function previousClicked() { 
            var second = 1;
            var question_number = parseInt(currentQno)-parseInt(second);
            qnoClicked(question_number);
            var qno1 = currentQno;
            $.each(attempted,function(k,v){
                var question_number = v.question_number;
                if(question_number == qno1){
					$('#'+(v.user_selected)).prop('checked',true);
				}
			});
        }
		function checkClicked() {
            $('#ans').show();
            var arrayFromPHP = <?php echo json_encode($questionListObjs); ?>;
            var data = arrayFromPHP[currentQno];
            var selected_radio_id = $('input[name="TUserSelectedTopicQuestionsForExam[user_options]"]:checked').attr('id');
			var selected_radioValue = $('input[name="TUserSelectedTopicQuestionsForExam[user_options]"]:checked').val();
                //var user_options = data.user_options;
                var correct_option = data.correct_option;
                if(selected_radioValue === correct_option){
                    $('#cor_opt').addClass('greentext');
                    $('#cor_cont').css('color', '#63ab63');
                    if(correct_option == 'A')
                        $('#col1').addClass('greenbg');
                    else if(correct_option == 'B')
                        $('#col2').addClass('greenbg');
                    else if(correct_option == 'C')
                        $('#col3').addClass('greenbg');
                    else if(correct_option == 'D')
                        $('#col4').addClass('greenbg');
                    
                }else{
                    $('#cor_opt').addClass('redtext');
                    $('#cor_cont').addClass('redtext');
                    $('#cor_cont').css('color', '#da3e3e');
                    if(correct_option == 'A')
                        $('#col1').addClass('greenbg');
                    else if(correct_option == 'B')
                        $('#col2').addClass('greenbg');
                    else if(correct_option == 'C')
                        $('#col3').addClass('greenbg');
                    else if(correct_option == 'D')
                        $('#col4').addClass('greenbg');
                    
                    if(selected_radio_id == 1)
                        $('#col1').addClass('redbg');
                    else if(selected_radio_id == 2)
                        $('#col2').addClass('redbg');
                    else if(selected_radio_id == 3)
                        $('#col3').addClass('redbg');
                    else if(selected_radio_id == 4)
                        $('#col4').addClass('redbg');
                    
                }
            $('#check').hide();
            $('#next').show();
        }
        
        function qnoClicked(qno) {
            $('#ans').hide();
            saveCurrentQuestion();
            currentQno = qno;
            var arrayFromPHP = <?php echo json_encode($questionListObjs); ?>;
            $('#questionNo').show();
            var data2 = arrayFromPHP[qno];
            var textCon = <?php echo nl2br(strip_tags('data2.question_details'));?>;
            $('#question_details').html(textCon);
            var t_topic_wise_question_details_id = data2.t_topic_wise_question_details_id;
            $('#t_topic_wise_question_details_id').val(t_topic_wise_question_details_id);
            var second = 1;
            var question_number = parseInt(qno)+parseInt(second);
            $('#question_number').html(question_number);
            var t_user_selected_topic_for_exam_id = data2.t_user_selected_topic_for_exam_id;
            $('#t_user_selected_topic_for_exam_id').val(t_user_selected_topic_for_exam_id);
            var t_exam_id = data2.t_exam_id;
            $('#t_exam_id').val(t_exam_id);
            var user_id = data2.user_id;
            $('#user_id').val(user_id);
            var t_topic_details_id = data2.t_topic_details_id;
            $('#t_topic_details_id').val(t_topic_details_id);
            var t_subject_details_id = data2.t_subject_details_id;
            $('#t_subject_details_id').val(t_subject_details_id);
            var id = data2._id;
            $('#id').val(id);

            $('#col1').show();
            $('#col2').show();
            $('#col3').show();
            $('#col4').show();

        
            var content_link = data2.referral_link;
            if(content_link == null || content_link == ''){
                $('#referral_content_link').html('');
            }else{
                $('#referral_content_link').html(content_link);
            }
            var correct_option = data2.correct_option;
            $('#correct_option').html(correct_option);

            var option1 = data2.option1;
            $('.option1').html(option1);
            var option2 = data2.option2;
            $('.option2').html(option2);
            var option3 = data2.option3;
            $('.option3').html(option3);
            var option4 = data2.option4;
            $('.option4').html(option4);
            
            var user_options = data2.user_options;
            if(user_options != '' && user_options != null){
                if(user_options == 'A')
                    $('#col1').prop('checked',true);
                else if(user_options == 'B')
                    $('#col2').prop('checked',true);
                else if(user_options == 'C')
                    $('#col3').prop('checked',true);
                else if(user_options == 'D')
                    $('#col4').prop('checked',true);
            }else{
                $('.genderCls').prop('checked',false);
            }
            if(qno == 0){
                $('#prev').addClass("disabled");
            }else{
                $('#prev').removeClass("disabled");
            }
            $('#col1').removeClass('greenbg');
            $('#col2').removeClass('greenbg');
            $('#col3').removeClass('greenbg');
            $('#col4').removeClass('greenbg');
            $('#col1').removeClass('redbg');
            $('#col2').removeClass('redbg');
            $('#col3').removeClass('redbg');
            $('#col4').removeClass('redbg');
            $('#check').show();
            $('#next').hide();
        }

        function saveSelectedTopicAnswer(){
            var selected_chk_arr = $('input[name="TUserSelectedTopicQuestionsForExam[user_options]"]:checked');
            if(selected_chk_arr.length < 1){
                alert('Please Select One Option');
            }else{
			$('.frmbtngroup').prop('disabled',true);			
            $('.error-message').remove();
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/home/saveselectedtopicanswer',
                type: 'post',
                cache: false,					
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){
                    $('.frmbtngroup').prop('disabled',false);					
                    var resp		=   res.split('****');
                    if(resp[1] == 'SUCCESS'){
                    $('.sucmsgdiv').html(resp[2]);
                    $('#sucMsgDiv').show('slow');
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);																		
                    }else if(resp[1] == 'ERROR'){						
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }
                    checkClicked();
                },
                error: function(xhr, textStatus, thrownError) {
                    $('.frmbtngroup').prop('disabled',false);
                    $('.failmsgdiv').html('Something went to wrong.Please Try again later...');
                    $('#failMsgDiv').show('slow');
                }
            });
        }}
        
        function saveSubmitTopicTest(){
            if (confirm('Do You Want To Submit The Test?')) {
            $('.frmbtngroup').prop('disabled',true);			
            $('.error-message').remove();
            $('#sucMsgDiv').hide('slow');
            $('#failMsgDiv').hide('slow');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': csrfTkn
                }
            });
            $.ajax({
                url:baseUrl+'/home/savesubmittopictest',
                type: 'post',
                cache: false,					
                data:{
                    "formdata": $('#entryFrm').serialize(),
                },
                success: function(res){
                    $('.frmbtngroup').prop('disabled',false);					
                    var resp		=   res.split('****');
                    if(resp[1] == 'SUCCESS'){
                    resetFormVal('entryFrm',0);
                    var t_exam_id = resp[2];
                    setTimeout(function(){ $('#sucMsgDiv').fadeOut('slow'); }, 5000);
                    window.location.replace(baseUrl+"/home/resultlistbyselectedtopicbyuser/"+t_exam_id);
                    }else if(resp[1] == 'FAILURE'){
                        showJsonErrors(resp[2]);																		
                    }else if(resp[1] == 'ERROR'){						
                        $('.failmsgdiv').html(resp[2]);
                        $('#failMsgDiv').show('slow');
                    }
                },
                error: function(xhr, textStatus, thrownError) {
                    $('.frmbtngroup').prop('disabled',false);
                    $('.failmsgdiv').html('Something went to wrong.Please Try again later...');
                    $('#failMsgDiv').show('slow');
                }
            });
        }}
	</script>    
@endsection