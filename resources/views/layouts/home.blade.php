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
        <link rel="icon" href="{{asset('public/frontend/assets/img/fevicon.png')}}" type="image/gif" sizes="16x16">
        <title>@yield('home-title')</title>
        <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/assets/vendor/icofont/icofont.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/assets/vendor/boxicons/css/boxicons.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/assets/vendor/animate.css/animate.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/assets/vendor/venobox/venobox.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
        <link rel="stylesheet" type="text/css" href="{{asset('public/frontend/assets/css/style.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
   </head>
    <body>
        @include('elements.home-header')
        @yield('home-content')
        @include('elements.home-footer')
        <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
        <script src="{{asset('public/frontend/assets/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/vendor/php-email-form/validate.js')}}"></script>
        <script src="{{asset('public/frontend/assets/vendor/jquery-sticky/jquery.sticky.js')}}"></script>
        <script src="{{asset('public/frontend/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/vendor/counterup/counterup.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/vendor/venobox/venobox.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/js/main.js')}}"></script>
        @include('includes/admin-script')
    </body>
</html>