<?php
$curRoute = Route::currentRouteAction();
$controller = '';
$action = '';
if ($curRoute != '') {
    if (strpos($curRoute, '@')) {
        $routePartArr = explode('@', $curRoute);
        if (isset($routePartArr) && is_array($routePartArr) && count($routePartArr) > 0) {
            if (isset($routePartArr[0])) {
                $controllerName = $routePartArr[0];
                $controllerNameArr = explode("/", str_replace('\\', '/', $controllerName));
                //print_r($controllerNameArr);
                $controller = $controllerNameArr[3];
            }
            if (isset($routePartArr[1])) {
                $action = $routePartArr[1];
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type='image/png' href="{{asset('public/frontend/logo.png')}}">
        <title>@yield('home-title')</title>
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/font-awesome.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/adminlite.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/js/plugins/iCheck/square/blue.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/skins/ionicons.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/js/plugins/datepicker/datepicker3.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/js/plugins/colorbox/colorbox.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/js/plugins/magicsuggest/magicsuggest-min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/js/plugins/bootstrap-fileinput/fileinput.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/adminlite.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/css/skins/_all-skins.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/js/bootstrap-timepicker.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/js/bootstrap-timepicker.min.css')}}">
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    </head>
    <body class="sidebar-mini skin-blue">
        <div id="loddingImage">
            <img src="{{asset('public/img/blockui_loader_large.gif')}}">
        </div>
        <div class="wrapper">
            @include('elements.admin-header')
            @include('elements.admin-leftpane')
            <div class="content-wrapper">
                @yield('admin-content')
            </div>
            @include('elements.admin-footer')
        </div>
         <script src="{{asset('public/js/jquery.min.js')}}"></script>
        <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('public/js/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('public/js/plugins/bootstrap-datetimepicker/moment.js')}}"></script>
        <script src="{{asset('public/js/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('public/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
        <script src="{{asset('public/js/plugins/colorbox/jquery.colorbox-min.js')}}"></script>
        <script src="{{asset('public/js/plugins/blockui/jquery.blockUI.js')}}"></script>
        <script src="{{asset('public/js/plugins/magicsuggest/magicsuggest-min.js')}}"></script>
        <script src="{{asset('public/js/plugins/fastclick/fastclick.min.js')}}"></script>
        <script src="{{asset('public/js/plugins/input-mask/jquery.inputmask.js')}}"></script>
        <script src="{{asset('public/js/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
        <script src="{{asset('public/js/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
        <script src="{{asset('public/js/plugins/bootstrap-fileinput/fileinput.min.js')}}"></script>
        <script src="{{asset('public/js/app.min.js')}}"></script>
        <script src="{{asset('public/js/demo.js')}}"></script>
        <script src="{{asset('public/js/bootstrap-timepicker.js')}}"></script>
        <script src="{{asset('public/js/bootstrap-timepicker.min.js')}}"></script>
        @include('includes/admin-script')
        <script src="http://cdn.ckeditor.com/4.7.3/full-all/ckeditor.js"></script>
		<script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js')}}"></script>
		
        <link href="{{ URL::asset('public/css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/css/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('public/css/datatables/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ URL::asset('public/js/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/js/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/js/datatables/dataTables.buttons.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/js/datatables/buttons.flash.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/js/datatables/jszip.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/js/datatables/pdfmake.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/js/datatables/vfs_fonts.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/js/datatables/buttons.html5.min.js')}}" type="text/javascript"></script>
        <script src="{{ URL::asset('public/js/datatables/buttons.print.min.js')}}" type="text/javascript"></script>
    </body>

    <script type="text/javascript">
        $('.datatablescrollexport').DataTable({
        dom: 'Bfrtip',
        "scrollY": 500,
        "scrollX": true,
        "order": [[ 0, "desc" ]],
        "iDisplayLength": 10,
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer:true,
                pageSize: 'A4',
                title: 'REPORT',            },
            {
                extend: 'excelHtml5',
                footer:true,
                title: 'REPORT'
            },
            {
                extend: 'print',
                footer:true,
                title: 'REPORT'
            }

       ],
            });
        $('.datatable1').DataTable({
        dom: 'Bfrtip',
        "iDisplayLength": 10,
        
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                footer:true,
                pageSize: 'A4',
                title: 'REPORT',            },
            {
                extend: 'excelHtml5',
                footer:true,
                title: 'REPORT'
            },
            {
                extend: 'print',
                footer:true,
                title: 'REPORT'
            }

       ],
       "scrollY": 450,
        
            });
    </script>

</html>