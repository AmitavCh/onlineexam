<section id="topbar" class="d-none d-lg-block">
    <div class="container d-flex">
        <div class="contact-info mr-auto">
            <i class="icofont-envelope"></i><a href="mailto:info@zemusitech.com">info@zemusitech.com</a>
            <i class="icofont-phone"></i>+91-674-297-3666
        </div>
        <div class="row">
            <?php if(isset(Auth::user()->full_name) && Auth::user()->full_name == ''){ ?>
                <div class="social-links">
                    <a href="{{URL('home/register')}}"><i class="fa fa-users"></i>  Register</a>
                    <a href="{{URL('home/login')}}"><i class="fa fa-sign-in"></i> Login</a>
                    <a href="{{URL('home/quickdemo')}}"><i class="fa fa-snowflake-o"></i> Quick Demo</a>
                </div>
            <?php }else if(isset(Auth::user()->full_name) && Auth::user()->full_name != ''){ ?>
                <div class="social-links">
                    <a href="{{URL('home/userprofile')}}"><i class="fa fa-user-circle"></i> {{Auth::user()->full_name}}</a>
                    <a href="{{URL('home/logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                </div>   
            <?php }else{ ?>
                <div class="social-links">
                    <a href="{{URL('home/register')}}"><i class="fa fa-users"></i>  Register</a>
                    <a href="{{URL('home/login')}}"><i class="fa fa-sign-in"></i> Login</a>
                    <a href="{{URL('home/quickdemo')}}"><i class="fa fa-snowflake-o"></i> Quick Demo</a>
                </div>
            <?php } ?>          
        </div>
    </div>
</section>
<header id="header">
    <div class="container d-flex">
        <div class="logo mr-auto">
            <a href="{{URL('/')}}"><img src="{{asset('public/frontend/assets/img/logo.png')}}"></a>
        </div>
        <nav class="nav-menu d-none d-lg-block " style="font-size:16px">
            <ul>
                <li class="home"><a href="{{URL('/')}}">Home</a></li>
                <li class="aboutus"><a href="{{URL('home/aboutus')}}">About Us</a></li>
                <li class="pricing"><a href="{{URL('home/pricing')}}">Pricing</a></li>
                <li class="contact"><a href="{{URL('home/contact')}}">Contact</a></li>
                <li class="menu-hide"><a href="{{URL('home/login')}}">Login</a></li>
                <li class="menu-hide"><a href="{{URL('home/register')}}">Register</a></li>
                <li class="menu-hide"><a href="{{URL('home/quickdemo')}}">Quick Demo</a></li>
            </ul>
        </nav>
    </div>
</header>

<script type="text/javascript">
jQuery(function ($) {
    var pathname = window.location.pathname; // Returns path only
    var url = window.location.href;     // Returns full URL
    var index = pathname.lastIndexOf("/") + 1;
    var filename = pathname.substr(index);
    var pageClass = filename.replace('.blade.php', '');
    if (pageClass != '') {
        $("." + pageClass).closest('li').addClass("active");
    } else if (pageClass == '') {
        $(".home").closest('li').addClass("active");
    }
});
</script>