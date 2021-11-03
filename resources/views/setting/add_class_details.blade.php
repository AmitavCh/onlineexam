@extends('layouts.admin-master')
@section('home-title')
Setting | Class Details
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
                <script>setTimeout(function () {
                        $('#sucMsgDiv').fadeOut('slow');
                    }, 2000);</script>
            </div>
            @endif
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissable" id="failMsgDiv">
                <i class="fa fa-ban"></i>
                <b>Info! {{ Session::get('error') }}</b>
                <script>setTimeout(function () {
                        $('#failMsgDiv').fadeOut('slow');
                    }, 8000);</script>
            </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Class Listing</h3>
                    <div class="box-tools pull-right">
                        <a href="{{ URL::to('/setting/add_class_details_data/')}}" class="iframeD" ><button type="button" class="btn btn-warning"><i class="fa fa-plus"></i> Add Class</button></a>
                    </div>
                </div>
                <div class="box-body">
                    <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap">
                        <form  action="" method="get">
                            <div class="row">
                                <div class="col-md-3 margine10bot"> 
                                    <div class="form-group">
                                        <input type="text" name="search" maxlength="25" class="form-control" id="{{Request::get('search')}}" placeholder="Search by class name" autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="col-md-1 margine10bot">
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
                                    <th>Board Name</th>
                                    <th>Class Name</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                <?php $trCnt = ($dbObj->perPage() * ($dbObj->currentPage() - 1)) + 1; ?>              
                                @foreach($dbObj as $post)
                                <tr>
                                    <td>{{$trCnt}}</td>
                                    <td>{{ Controller::getBoardName($post->t_board_details_id) }}</td>
                                    <td>{{$post->class_name}}</td>
                                    <td>{{$post->is_active}}</td>
                                    <td class="text-center">							
                                        <a class="iframeD btn-sm" title="Edit Record" href="{{ URL::to('/setting/add_class_details_data/'.base64_encode(base64_encode($post->id))) }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @if($post->is_active == 'N')
                                        <a class="btn-sm" title="Active Record" href="{{URL::to('/setting/classDetailsActive/'.base64_encode(base64_encode($post->_id)))}}" onclick="return confirm('Are you sure to Active Record ?')">
                                            <i class="fa fa-check-circle-o"></i>
                                        </a> 
                                        @endif
                                        @if($post->is_active == 'Y')
                                        <a class="btn-sm" title="Deactive Record" href="{{URL::to('/setting/classDetailsDeactive/'.base64_encode(base64_encode($post->_id)))}}" onclick="return confirm('Are you sure to De-Active Record ?')">
                                            <i class="fa fa-exclamation-triangle"></i>
                                        </a> 
                                        @endif
                                    </td>
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