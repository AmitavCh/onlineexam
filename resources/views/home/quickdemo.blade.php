@extends('layouts.home')
@section('home-title')
Home | Quick Demo Page
@endsection
@section('home-content')
@php
use App\Http\Controllers\Controller;
@endphp
<style>
    .breadcrumbs_quikDemo {
  padding: 20px 0 0px 0;
  background: #f7f7f7;
  border-bottom: 1px solid #ededed;
  margin-bottom: 40px;
}

.breadcrumbs_quikDemo ol {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding: 3px 0 5px 0;
  margin: 0;
  font-size: 14px;
}

.breadcrumbs_quikDemo h2 {
  font-size: 28px;
  font-weight: 700;
  color: #545454;
}

.breadcrumbs_quikDemo ol li + li {
  padding-left: 10px;
}

.breadcrumbs_quikDemo ol li + li::before {
  display: inline-block;
  padding-right: 10px;
  color: #6e6e6e;
  content: "/";
}



.breadcrumbs {
  padding: 20px 0 6px 0;
  background: #f7f7f7;
  border-bottom: 1px solid #ededed;
  margin-bottom: 40px;
}

.breadcrumbs h2 {
  font-size: 28px;
  font-weight: 700;
  color: #545454;
}

.breadcrumbs ol {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  padding: 0px 0 5px 0;
  margin: 0;
  font-size: 14px;
}

.breadcrumbs ol li + li {
  padding-left: 10px;
}

.breadcrumbs ol li + li::before {
  display: inline-block;
  padding-right: 10px;
  color: #6e6e6e;
  content: "/";
}

.right-panel{
 
    border-radius: 5px
}



.right-panel ._marks li{
    display: inline-block;
    vertical-align: middle;
}

.right-panel ._marks li span{
    display: inline-block;
    vertical-align: middle;
    height: 26px;
    width: 26px;
    border-radius: 5px;
    background: #AAA;
}

.right-panel ._marks li span._green{
    background: #46c600;
}

.right-panel ._marks li span._red{
    background: #ff0000;
}

.right-panel ._marks li label{
    display: inline-block;
    font-size: 13px;
    margin-right: 5px;
    font-weight: bold;
    color: #21295a;
}

.right-panel .status-list{
    margin: 0;
    list-style: none;
}

.right-panel .status-list li{
    margin: 5px;
    padding: 0;
    display: block;
    width: 42px;
    background: #fcaf17;
    float: left;
    height: 40px;
    text-align: center;
    line-height: 40px;
    border-radius: 5px;
    font-weight: bold;
    color: #21295a;
}
@media (max-width: 768px){
.right-panel .status-list li{
    margin: 1%;
    padding: 0;
    display: block;
    width: 18%;
    background: #fcaf17;
    float: left;
    height: 42px;
    text-align: center;
    line-height: 42px;
    border-radius: 10px;
    font-weight: bold;
    color: #21295a;
}
.right-panel ._marks {
    padding: 0;
    background: transparent;
    vertical-align: middle;
    border-radius: 10px;
    margin-left: 1px;
    padding-top: 10px;
}
p{
  display: inline
}
.table-responsive {
    width: 100%;
    margin-bottom: 15px;
    overflow-y: hidden;
    -ms-overflow-style: -ms-autohiding-scrollbar;
    border: 0px solid #ddd;
}
.table>tbody>tr>td{
    border-top: 0px solid #ddd;
  }
 .right-panel .status-list{
    margin: 0;
    padding: 20px;
    list-style: none;
}
}

.of-hidden{
    overflow: hidden;
}

.qa-block{
    padding: 30px 0;
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
}

.buttn-margin{
  margin: 7px !important;
}

.question{
    text-align: justify;
    font-weight: normal;
    color: #000;
    font-family: "Open Sans", sans-serif;
    line-height: 1.5;
    font-size: 14px;
}

.buttn2{
  background: #fcb221;
  border: 0;
  border-radius: 50px;
  padding: 7px 24px;
  color: #fff;
  transition: 0.4s;
  font-size:13px;
  font-weight: bold; 
}
.buttn2:hover{
    background-color: #fcb221; 
    color: #212959; 
    border-radius: 50px; 
    font-size: 13px; 
    padding: 7px 24px;
    font-weight: bold;
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
    line-height: 1.2;
    word-break: normal;
    text-overflow: ellipsis;
    overflow: hidden;
    color: #333;
    background-color: #f2f2f2 !important;
    border: 0px solid #f2f2f2;
    border-radius: 0px;
    margin-left: -12px;
    text-align: justify;
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
  p{
    display: inline
  }
  .table>tbody>tr>td{
    border-top: 0px solid #ddd;
  }
  .right-panel ._marks {
    padding: 0;
    background: transparent;
    vertical-align: middle;
    border-radius: 10px;
}
.right-panel {
    background: transparent;
    min-height: 0px;
    border-radius: 0px;
}
</style>
<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        
        <div class="container">
          <div class="row">
            <div class=" col-md-4">
              <ol>
                <li><a href="{{URL('/')}}">Home</a></li>
                <li>Quick Demo</li>
              </ol>
            </div>
            <div class="col-md-4"></div>
            <div class=" col-md-4 right-panel">
              <ul class="_marks row">
                <li><span class="_green"></span> <label>Correct Answered</label></li>
                  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                <li><span class="_red"></span> <label>In-Correct Answered</label></li>
              </ul>
            </div>
          </div>
        </div>
    </section>
    <section class="container-fluid" id="questionDiv">
      <div class="container clear-fx">
        <!-- <div class="container right-panel"  style="background-color: #ebebeb">
            <ul class="status-list clear-fx">
                @foreach($dbObj as $key=>$val)
                <li>{{$key+1}}</li>
                @endforeach
            </ul>
        </div>
        <br><br> -->
        <div class="container" style="background-color: #ebebeb; border-radius: 5px; padding:20px;">
        <div class="bs-example">
                    <div class="table-responsive">
                    <table class="table">
                        <div id="div_q_nos_details"></div>
                    </table><br/>
                    <table class="table">
                        <div id="div_answer_nos_details"></div>
                    </table>
                </div>
        </div>
      </div>
    </section>
    <section class="container-fluid" id="ansDiv" style="display:none;">
      <div class="container clear-fx" style="background-color: #ebebeb; border-radius: 5px; padding:20px;">
        <div class="table-responsive">
          <table class="table">
            <?php $trCnt = 0; ?>  
            <?php $qusCnt = 1; ?>
            <?php $qusNoCnt = 1; ?>  
                @foreach($dbObj as $resKey=>$resVal)

                  <?php $eleCnt = 1; $textCon = nl2br(strip_tags($resVal->question_details));?>
                    <b><p style="text-align: justify;font-weight: bold;padding-top:5px;line-height: 31px;font-size:14px; line-height:10px !important;">{{$qusNoCnt}}.  <?php echo $textCon?></p></b>
                    <div class="size" style="padding: 10px 10px 5px;font-size:14px;" id="div<?php echo $trCnt . '' . $eleCnt ?>">
                        A&nbsp;.&nbsp;&nbsp;&nbsp;{{$resVal->option1}}
                        <?php $eleCnt++; ?>
                    </div>
                    <div class="size" style="padding: 5px 10px 5px;font-size:14px;" id="div<?php echo $trCnt . '' . $eleCnt ?>">
                        B&nbsp;.&nbsp;&nbsp;&nbsp;{{$resVal->option2}}
                        <?php $eleCnt++; ?>
                    </div>
                    <div class="size" style="padding: 5px 10px 5px;font-size:14px;" id="div<?php echo $trCnt . '' . $eleCnt ?>">
                        C&nbsp;.&nbsp;&nbsp;&nbsp;{{$resVal->option3}}
                        <?php $eleCnt++; ?>
                    </div>
                    <div class="size" style="padding: 5px 10px 5px;font-size:14px;" id="div<?php echo $trCnt . '' . $eleCnt ?>">
                        D&nbsp;.&nbsp;&nbsp;&nbsp;{{$resVal->option4}}
                        
                    </div> 
                    <div class="uline">
                        <span style="color:#5eac1a;font-weight:bold;font-size: 14px;line-height: 31px;">Your Answer&nbsp;</span>:&nbsp;Option&nbsp;<b style="font-size: 14px;"id="your_ans<?php echo $trCnt . '' . $eleCnt ?>"> Not Answered </b></span><br/>
                        <span style="color:#5eac1a;font-weight:bold;font-size: 14px;line-height: 31px;">Correct Answer&nbsp;</span>:&nbsp;Option&nbsp;<b style="font-size: 14px;">{{$resVal->correct_option}}</b></span><br/>
                    </div><br/>
                  <?php $trCnt++; ?>
                  <?php $qusCnt++; ?>
                  <?php $qusNoCnt++; ?>
                @endforeach
          </table>
        </div>
      </div>
    </section>
</main>
<script>
    var currentQno = 0;
    var textCon = '';
    qnoClicked(0);
    var attempted = {};
    function submitExam() {
			saveCurrentQuestion();
			if (confirm('Do you want to submit?')) {		
				$('#questionDiv').hide();
				$('#ansDiv').show();
				var arrayFromPHP = <?php echo json_encode($dbObj); ?>;
        //alert(JSON.stringify(arrayFromPHP));
				var total_questions = arrayFromPHP.length;
				var total_attempted = Object.keys(attempted).length;
				var total_unattempted = total_questions - total_attempted;
				var total_correctanswers = 0;
				var des = 0;
				//alert(JSON.stringify(attempted));
				$.each(attempted, function(k, v){
					//alert(JSON.stringify(v));
					var question_number = v.question_number;
					var corr = 0;
					if(arrayFromPHP[v.question_number].correct_option == 'A') corr = 1;
					else if(arrayFromPHP[v.question_number].correct_option == 'B') corr = 2;
					else if(arrayFromPHP[v.question_number].correct_option == 'C') corr = 3;
					else if(arrayFromPHP[v.question_number].correct_option == 'D') corr = 4;
					//alert(v.user_selected+'   '+corr);
					
					if(v.user_selected == corr){							
						total_correctanswers++;		
						$('#div' + question_number + '' + corr).css({"color": "#46c600", "width": "auto"});
					} else {
						$('#div' + question_number + '' + v.user_selected).css({"color": "#ff0000", "width": "auto"});
						$('#div' + question_number + '' + corr).css({"color": "#46c600", "width": "auto"});
					}
					des++;
					var optn = '';
          
					if(v.user_selected == 1) optn = 'A';
					else if(v.user_selected == 2) optn = 'B';
					else if(v.user_selected == 3) optn = 'C';
					else if(v.user_selected == 4) optn = 'D';
          $('#your_ans'+(v.question_number)+'1').html(optn);
          $('#your_ans'+(v.question_number)+'2').html(optn);
          $('#your_ans'+(v.question_number)+'3').html(optn);
          $('#your_ans'+(v.question_number)+'4').html(optn);
        });
				$('#correct_answer').html('').html(total_correctanswers);
				$('#given_ans').html('').html(total_attempted);
				$('#un_answer').html('').html(total_unattempted);
			}
		}
    function saveCurrentQuestion(){
			if($('input[name=opt]:checked').attr('id') != undefined){
        var obj = {};
        obj["question_number"] = currentQno;
        obj["user_selected"] = $('input[name=opt]:checked').attr('id') ;
				attempted[currentQno]= obj;
			}
		}
    function checkClicked() {
			var selected_chk_arr = $('input[name=opt]:checked');
      var selected_radioValue = $('input[name=opt]:checked').val();
      var selected_radio_id = $('input[name=opt]:checked').closest('tr').attr('id');
      if(selected_chk_arr.length < 1){
          alert('Please Select One Option');
      }else{
        var arrayFromPHP = <?php echo json_encode($dbObj); ?>;
        var data = arrayFromPHP[currentQno];
        //alert(JSON.stringify('id: '+selected_radio_id+'    User selected: '+selected_radioValue+'    Correct option: '+data.correct_option));
        //alert(JSON.stringify(data));
        if(selected_radioValue === data.correct_option){
          $('#col').removeClass('redtext');
          $('#col').addClass('greentext');
          $('p a').css('color', '#63ab63');
          $('#'+selected_radio_id).removeClass('redbg');
          $('#'+selected_radio_id).addClass('greenbg');
        }else{
          $('#col').removeClass('greentext');
          $('#col').addClass('redtext');
          $('p a').css('color', '#da3e3e');
          $('#'+selected_radio_id).addClass('redbg');
          if(data.correct_option == 'A'){
              $('#rad1').addClass('greenbg');
          }else if(data.correct_option == 'B'){
              $('#rad2').addClass('greenbg');
          }else if(data.correct_option == 'C'){
              $('#rad3').addClass('greenbg');
          }else if(data.correct_option == 'D'){
              $('#rad4').addClass('greenbg');
          }
        }
        jQuery("input:radio").attr('disabled',true);
        $('#next').show();
        $('#checkopt').show();
        $('#check').hide();
         
      }
    }
    function checkClickedLast(){
			checkClicked();
			var data = currentQno;
			if(data == 19){
				$('#finish').show();
				$('.prev').hide();
			}
		}
		function nextClicked() {						
			qnoClicked(currentQno+1);			
		}
		function previousClicked() {
      $('#ansDiv').hide();
			qnoClicked(currentQno-1);			
		}
    function qnoClicked(qno) {
      saveCurrentQuestion();
			currentQno = qno;
			qno1 = qno+1;
			var arrayFromPHP = <?php echo json_encode($dbObj); ?>;
      var data = arrayFromPHP[qno];
      //alert(data.question_details);exit;
			var textCon = <?php echo nl2br(strip_tags('data.question_details'));?>; 
      var html = 
						'<div class="col-lg-12">'+
						'<table class="table">'+
							'<tbody>'+
								  '<tr>'+
									  '<td style="text-align:justify;line-height: 31px;font-size:14px"><b class="qsn" style="margin:0px;padding:0px;line-height:10px !important;"">'+qno1+". "+textCon+'</b></td>'+
								  '</tr>'+
								  '<tr id="rad1">'+
									  '<td class="qsn" style="text-align:left;font-size:14px">'+'<input type="radio" name="opt" id="1" value="A">'+'&nbsp;&nbsp;'+'&nbsp;&nbsp;&nbsp;&nbsp;'+data.option1+'</td>'+
								  '</tr>'+
								  '<tr id="rad2">'+
									  '<td class="qsn" style="text-align:left;font-size:14px">'+'<input type="radio" name="opt" id="2" value="B">'+'&nbsp;&nbsp;'+'&nbsp;&nbsp;&nbsp;&nbsp;'+data.option2+'</td>'+
								  '</tr>'+
								  '<tr id="rad3">'+	
									  '<td class="qsn" style="text-align:left;font-size:14px">'+'<input type="radio" name="opt" id="3" value="C">'+'&nbsp;&nbsp;'+'&nbsp;&nbsp;&nbsp;&nbsp;'+data.option3+'</td>'+
								  '</tr>'+
								  '<tr id="rad4">'+	
									  '<td class="qsn" style="text-align:left;font-size:14px">'+'<input type="radio" name="opt" id="4" value="D">'+'&nbsp;&nbsp;'+'&nbsp;&nbsp;&nbsp;&nbsp;'+data.option4+'</td>'+
								  '</tr>'+
                  '</tbody></table></div><br>';
                      if(qno == 0){
                          html += '<span class="prev" style="margin-left:11px;margin-top:20px; float:left;"><button type="button" disabled="disabled" class="buttn2" onclick="javascript:previousClicked();" ondblclick ="javascript:void(0);">PREVIOUS</button></span>';
                      }else{
                          html += '<span class="prev" style="margin-left:11px;margin-top:20px; float:left;"><button type="button" class="buttn2" onclick="javascript:previousClicked();" ondblclick ="javascript:void(0);">PREVIOUS</button></span>'; 
                      }
                     // if(qno == arrayFromPHP.length-1){
                      if(qno == arrayFromPHP.length-1){
                          html += '<span class="nxt1" id="check" style="margin-left:11px;margin-top:20px; float:left;"><button type="button" class="buttn2" onclick="javascript:checkClickedLast();" ondblclick ="javascript:void(0);">CHECK</button></span>';
                          html += '<span id="finish" style="margin-left:10px;margin-top:11px;float:left;display:none"><button type="button" class="buttn2" onclick="javascript:submitExam();" ondblclick ="javascript:void(0);">FINISH</button></span>';
                      }else{
                          html += '<span class="nxt1" id="check" style="margin-left:11px;margin-top:20px; float:left;"><button type="button" class="buttn2" onclick="javascript:checkClicked();" ondblclick ="javascript:void(0);">CHECK</button></span>';
                          html += '<span class="nxt1" id="next" style="margin-left:11px;margin-top:20px; float:left;display:none;"><button type="button" class="buttn2" onclick="javascript:nextClicked();" ondblclick ="javascript:void(0);">NEXT</button></span>';
                      }
                $('#div_q_nos_details').html("");
                $('#div_q_nos_details').html(html);
			              var html1 = ' <div class="col-lg-12" id="checkopt" style="display:none;"> '+
                    '<table class="table">'+
							        '<tbody>'+
								      '<tr>'+
									      '<td class="qsn" id="col" style="text-align:justify;line-height: 31px">'+"Correct Option: "+data.correct_option+'</td> '+
								      '</tr>'+
                    '</tbody></table></div><br>';
                $('#div_answer_nos_details').html("");
                $('#div_answer_nos_details').html(html1);
      $.each(attempted, function(k, v){
        if(qno == k){
          //alert(JSON.stringify(v));
          $('#'+(v.user_selected)).attr('checked',true);
        }
      });
		}
    
    
    
</script>
@endsection
