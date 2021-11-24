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
.table>tbody>tr>td{
    border-top: 1px solid transparent;
}
.qustn{
    background-color: #ebebeb;  
    width: 1140px;
}

@media (max-width: 768px) {  
    .qustn{ 
        width: 340px;
}
}



</style>
<main id="main"  class="qustn">
<div style="text-align:justify" id="questionNo">
    <div id="bs-example">
        <table class="table" cellspacing="0" cellpadding="4" style="font-size:14px; border:2px solid #ddf8c2; background-color:#fafafa;" width="95%">
            <tbody><tr><td align="center" bgcolor="#ddf8c2" colspan="3"><b>Result</b></td></tr>
                <tr>
                    <td align="left">Total Number Of Questions</td>
                    <td width="1%">:</td>
                    <td width="10%" nowrap="nowrap" align="left" style="padding-right:40px"><b><?php echo "$total_number_of_questions" ?></b></td>
                </tr>
                <tr>
                    <td align="left">Total Number Of Correct Answers</td>
                    <td width="1%">:</td>
                    <td width="right"  nowrap="nowrap" align="left" style="padding-right:40px"><b><?php echo "$correctAnsObj" ?></b></td>
                </tr>
                <tr>
                    <td align="left">Number Of Answered Questions</td>
                    <?php $total_number_of_answer_qus = $correctAnsObj + $wrongAnsObj ?>
                    <td width="1%">:</td>
                    <td align="left" style="padding-right:40px"><b><?php echo "$total_number_of_answer_qus" ?></b></td>
                </tr>
                <tr>
                    <td align="left">Number Of Unanswered Questions</td>
                    <?php $total_number_of_unanswer_qus = $total_number_of_questions - $total_number_of_answer_qus ?>
                    <td width="1%">:</td>
                    <td align="left" style="padding-right:40px"><b><?php echo "$total_number_of_unanswer_qus" ?></b></td>
                </tr>
            </tbody></table>
        <br><p><b style="color:#5eac1a">Test Review : View answers and explanation for this test.</b></p>
    </div>
</div>
<div class="bs-example" style="text-align:justify" id="questionDiv">
    <?php $trCnt = 0; ?> 
    <?php $qusCnt = 1; ?>
    @foreach($questionListObj as $resKey=>$resVal)
    <?php
    $referal_link = nl2br(strip_tags($resVal->referral_link));
    if ($resVal->user_options == '') {
        $your_options = "Not Answered";
    } else {
        $your_options = $resVal->user_options;
    }
    $textCon = nl2br(strip_tags($resVal->question_details));
    ?>
    <?php $eleCnt = 1; ?>
    <table class="table">
            <tbody>
                <tr>
                    <td style="text-align:justify;line-height: 31px;font-size:14px"><pre style="line-height:10px !important;"><b>{{$qusCnt}}&nbsp;.&nbsp;<?php echo $textCon?></b></pre></td> 
                </tr>
                <tr id="div<?php echo $trCnt . '' . $eleCnt ?>">
                    <td style="text-align:left;font-size:14px">
                        1&nbsp;.&nbsp;&nbsp;&nbsp;{{$resVal->option1}}
                        <?php $eleCnt++; ?>
                     </td>
                </tr>
                <tr id="div<?php echo $trCnt . '' . $eleCnt ?>">
                    <td style="text-align:left;font-size:14px">
                        2&nbsp;.&nbsp;&nbsp;&nbsp;{{$resVal->option2}}
                        <?php $eleCnt++; ?>
                     </td>
                </tr>
                <tr id="div<?php echo $trCnt . '' . $eleCnt ?>">
                    <td style="text-align:left;font-size:14px">
                        3&nbsp;.&nbsp;&nbsp;&nbsp;{{$resVal->option3}}
                        <?php $eleCnt++; ?>
                     </td>
                </tr>
                <tr id="div<?php echo $trCnt . '' . $eleCnt ?>">
                    <td style="text-align:left;font-size:14px">
                        4&nbsp;.&nbsp;&nbsp;&nbsp;{{$resVal->option4}}
                        <?php $eleCnt++; ?>
                     </td>
                </tr>
                <tr>
                    <td style="text-align:left;font-size:14px;color:">
                        <span style="color:#5eac1a;font-weight:bold;">Your Answer&nbsp;</span>:&nbsp;Option&nbsp;<b><?php echo $your_options ?></b></span><br/>
                        <span style="color:#5eac1a;font-weight:bold">Correct Answer&nbsp;</span>:&nbsp;Option&nbsp;<b>{{$resVal->correct_option}}</b></span><br/><br/>
                        <?php if ($resVal->referral_link != '') { ?>
                            <b><span style="text-align:justify;font-size: 14px;"><span style="color:#333;font-style: italic !important;font-size: 14px;" id="b<?php echo $trCnt;?>">Referral Link: </span><a href='<% $resVal->referral_link %>' target="blank"><span id="c<?php echo $trCnt;?>"><?php echo $referal_con; ?><span></a></span></b>
                        <?php } ?>
                     </td>
                </tr>
            </tbody>
        </table>
        <?php $trCnt++; ?>
        <?php $qusCnt++; ?>
        @endforeach
    
</div>   
</main>
<script>
    $(document).ready(function () {
        quesColorChange();
    });
    function quesColorChange() {
        var arrayFromPHP = <?php echo json_encode($questionListObj); ?>;
        var total_correctanswers = 0;
        var des = 0;
        $.each(arrayFromPHP, function (k, v) {
            //alert(JSON.stringify(arrayFromPHP));
            var user_options = v.user_options;
            var correct_option = v.correct_option;
            //var des = v.descrptions;
            //alert(user_options);
            var corr = 0;
            if (correct_option == 'A')
                corr = 1;
            else if (correct_option == 'B')
                corr = 2;
            else if (correct_option == 'C')
                corr = 3;
            else if (correct_option == 'D')
                corr = 4;
            //alert(user_options+'   '+correct_option);
            if (user_options == correct_option){
                $('#b'+des).css('color','#46c600');
                $('#cor_cont1 a'+des).css('color','#46c600');
                $('#div' + total_correctanswers + '' + corr).css({"color": "#46c600","width": "auto", "padding": "3px"});
            }else if (user_options == 0 || user_options == '' || user_options == null){
                $('#div' + total_correctanswers + '' + corr).css({"color": " ", "color": " ", "width": "auto", "padding": "3px"});
            }else if (user_options != correct_option){
                if (user_options == "A")
                    var opt = 1;
                if (user_options == "B")
                    var opt = 2;
                if (user_options == "C")
                    var opt = 3;
                if (user_options == "D")
                    var opt = 4;
                
            $('#div' + total_correctanswers + '' + opt).css({"color": "#ff0000","width": "auto", "padding": "3px"});
            $('#div' + total_correctanswers + '' + corr).css({"color": "#46c600","width": "auto", "padding": "3px"});
            $('#b'+des).css('color','#ff0000');
            }
            total_correctanswers++;
            des++;
        });
    }
</script>
@endsection