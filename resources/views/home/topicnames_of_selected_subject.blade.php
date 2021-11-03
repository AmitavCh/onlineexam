@extends('layouts.ajax')
@section('admin-content')
@php
use App\Http\Controllers\Controller;
@endphp
<style>
.userbtn{
    background-color: #212959;
    color: #fff;
    border-radius: 5px;
    height: 40px;
    text-align: left;
    padding-left: 10px;
    padding-top: 9px;
    font-size: 14px;
    width: 100%;
 }

 .a1{
    color: #fff;
}

.a1:hover{
    color: #fcb221;
}

.card1{
    position: relative;
    display: flex;    
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border-radius: .25rem;
}

.userbtn-dropdown2{
    background-color: #212959;
    color: #fff;
    border-radius: 5px;
    width: 100%;
    font-size: 14px;
    padding-top: 8px;
    padding-bottom: 8px;
}

.topic-wise{
    background-color: #212959; 
    border-radius: 10px; 
    padding-top: 15px;
    padding-left: 10px;
}
.form-group {
    margin-bottom: 15px;
    width: 32%;
}
.topic-wise2{
    background-color:#212959; 
    color: #fff; 
    border-radius: 20px; 
    padding: 20px 20px 20px 20px;
    font-size: 14px;
    font-weight: lighter;
    font-family: "Open sans", sans-serif;
}

.blog .blog-comments .reply-form .form-group {
    margin-bottom: 25px;
}

.form-control1 {
    font-family: "Open sans", sans-serif;
    font-size: 14px ;
    font-weight: bold;
    display: block;
    width: 126%;
    height: calc(1.5em + .75rem + 2px);
    padding: .375rem .75rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 7px;
    margin-bottom: 4px;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.btn-enquiry3{
    background-color: #fcb221; 
    color: #fff; 
    border-radius: 50px; 
    font-size: 13px; 
    padding: 7px 24px;
    font-weight: bold;
}
.btn-enquiry3:hover{
    background-color: #fcb221; 
    color: #212959; 
    border-radius: 50px; 
    font-size: 13px; 
    padding: 7px 24px;
    font-weight: bold;
}

.topic-wise2{
    background-color:#212959; 
    color: #fff; 
    border-radius: 5px; 
    padding: 20px 20px 20px 20px;
}
.active{
    color:#fcb221;
}    
@media (max-width: 768px){
  .topic-wise{
        margin-top: 30px;
        background-color: #212959; 
        border-radius: 10px; 
        padding-top: 15px;
        padding-left: 10px;
    }
    .form-group {
        margin-bottom: 15px;
        width: 92%;
    }
}

</style>
<main id="main">
    <form class="topic-wise2" style="background-color: #212959; border-radius: 5px; padding-top: 15px; padding-left: 10px;">
        <div class="row" style="padding-left: 17px;">
            <div class="form-group">
                @foreach($responseObjArr as $key=>$val)
                    <input type="checkbox"  id="t_topic_details_id" name="TTopicWiseExamDetails[t_topic_details_id]" value="{{$val->_id}}">
                    <label>{{$val->topic_name}}</label><br/>
                @endforeach
                <br/>
                <div><a class="btn-enquiry3" type="submit">Next</a></div>
            </div>
            
        </div>
    </form>
</main>

@endsection