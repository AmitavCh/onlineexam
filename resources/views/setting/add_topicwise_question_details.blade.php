@extends('layouts.admin-master')
@section('home-title')
Setting | Topic Details
@endsection
@section('admin-content')
@php
use App\Http\Controllers\Controller;
@endphp
<section class="content">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable" id="sucMsgDiv">
                <i class="fa fa-check"></i>
                <b>Success! {{ Session::get('message') }}</b>
                <script> setTimeout(function(){window.parent.location.reload(true);}, 1000);</script>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissable" id="failMsgDiv">
                <i class="fa fa-ban"></i>
                <b>Info! {{ Session::get('error') }}</b>
                <script> setTimeout(function(){window.parent.location.reload(true);}, 1000);</script>
            </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Topic Wise Listing</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ URL::to('/setting/add_topicwise_question_details_data/')}}" class="iframeLarge" ><button type="button" class="btn btn-warning"><i class="fa fa-plus"></i> Add Questions</button></a>
                    </div>
                </div>
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <form  action="" method="get">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group margine10bot">
                                        <label for="course_name">Class Name</label>
                                        <select class="form-control" id="t_class_details_id" name="t_class_details_id" onchange="getSubjectNameList(this.value);">
                                            @foreach($classArr as $menu)
                                                <option value="{{$menu['id']}}">{{$menu['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group margine10bot">
                                        <label for="course_name">Subbject Name</label>
                                        <select name="t_subject_details_id" maxlength="25" class="form-control" id="t_subject_details_id" autocomplete="off"></select>
                                    </div>
                                </div>
                                <div class="col-md-1 margine10bot" style="margin-top: 2%;">
                                    <div class="form-group">
                                        <span class="form-group-btn">
                                            <button type="submit" class="btn btn-md btn-info"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="listingTable">
                        @if(is_object($dbObj) && count($dbObj) > 0)	
                        <div class="table-responsive">            
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Topic Name</th>
                                    <th>Subject Name</th>
                                    <th>Class Name</th>
                                    <th>Board Name</th>
                                    <th>Total Number Questions</th>
                                </tr>
                                <?php $trCnt = ($dbObj->perPage() * ($dbObj->currentPage() - 1)) + 1; ?>              
                                @foreach($dbObj as $post)
                                <tr>
                                    <td>{{ $trCnt }}</td>
                                    <td><a href="{{ URL::to('/setting/add_topicwise_questions_list/'.base64_encode(base64_encode($post->id))) }}">{{ $post->topic_name }}</a></td>
                                    <td>{{ Controller::getSubjectName($post->t_subject_details_id) }}</td>
                                    <td>{{ Controller::getClassName($post->t_class_details_id) }}</td>
                                    <td>{{ Controller::getBoardNameByClassId($post->t_class_details_id) }}</td>
                                    <td>{{ Controller::getTotalNumerOfQuestionsByTopicId($post->id) }}</td>
                                </tr>
                                <?php $trCnt++; ?>
                                @endforeach
                            </table>           
                        </div>
                        {{$dbObj->links()}}
                        @else            
                        <div class="alert alert-info">
                            <i class="fa fa-info"></i>No data found.
                        </div>
                        @endif
                    </div>
                </div>	
            </div>
        </div>			
    </div>
</section>
@endsection