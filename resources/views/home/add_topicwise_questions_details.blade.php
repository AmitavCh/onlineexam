@extends('layouts.home')
@section('home-title')
Home | Dashboard
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
  padding: 20px 0 20px 0;
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
    border-radius: 10px;
    background: transparent;
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
.right-panel ._marks {
    padding: 0px;
    background: transparent; 
    vertical-align: middle;
    border-radius: 10px;
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
    padding: 20px;
    list-style: none;
    padding-bottom: 70px;
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
    border-radius: 10px;
    font-weight: bold;
    color: #21295a;
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
  .right-panel .status-list{
      margin: 0;
      padding: 20px;
      list-style: none;
      padding-bottom: 205px;
  }
}
</style>
  <main id="main">
    <section id="breadcrumbs" class="breadcrumbs_quikDemo">
      <div class="container">
        <div class="row">
          <div class=" col-md-4">
            <ol>
              <li><a href="{{URL('home/dashboard')}}">Dashboard</a></li>
              <li>Topic Wise Exam Session</li>
            </ol>
          </div>
          <div class="col-md-4"></div>
          <div class=" col-md-4 right-panel">
            <ul class="_marks row ">
              <li><span class="_green "></span> <label> Correct Answered</label></li>
                &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
              <li><span class="_red"></span> <label>In-Correct Answered</label></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section class="container-fluid">
      <div class="container clear-fx">
        <div class="row">
          
          <div class="of-hidden" style="float: center;">
            <div class="card">
              <div class="card-header tabDesign">
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    $tnt = 0;
                    $temp_topic_id = '';
                    foreach($topicListArr as $key => $val){
                        $t_exam_id = $val->t_exam_id;
                        $t_topic_details_id = $val->t_topic_details_id;
                        if($tnt == 0){
                          $temp_topic_id = $val->t_topic_details_id;
                        }
                        $tnt++;
                    ?>
                    <li class="nav-item">
                      <a onclick="getQuestionByTopicWise('{{$t_topic_details_id}}','{{$t_exam_id}}')" class="nav-link active" data-toggle="tab" href="#Chapt1" role="tab">{{Controller::getTopicName($t_topic_details_id)}}</a>
                    </li>
                    <?php } ?>  
                </ul>
              </div>
              <div id="listingTable"></div>
          </div>
        
      </div>
    </section>
  </main>
<script>
    $( window ).on( "load", function() {
        var t_id = '{{$temp_topic_id}}';
        var t_ex_id ='{{ $t_exam_id }}';
        getQuestionByTopicWise(t_id,t_ex_id);
    });
    function getQuestionByTopicWise(t_topic_details_id,t_exam_id){
      $('#questionDiv').empty();
      $('#questionNo').empty();
      $('.bs-example').hide();
      $('#img12').show();	
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
				url:baseUrl+'/home/question_details_by_topic_selection',
				type: 'get',
				data:{
          t_topic_details_id: t_topic_details_id,
						t_exam_id: t_exam_id,
					},
				cache: false,					
				success: function(res){
          $('#listingTable').html(res);
        },
				error: function(xhr, textStatus, thrownError) {
				$('.frmbtngroup').prop('disabled',false);
				$('.failmsgdiv').html('Something went to wrong.Please Try again later...');
				$('#failMsgDiv').show('slow');
				}
			});
		}
</script>
@endsection