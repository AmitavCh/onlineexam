@extends('layouts.home')
@section('home-title')
Home | Home Page
@endsection
@section('home-content')
@php
use App\Http\Controllers\Controller;
@endphp
 <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="item active">
            <img src="{{asset('public/frontend/assets/img/slide/banner-home-1.png')}}" alt="" style="width:100%;">
            <div class="carousel-caption">
                <p>Conduct High Concurrency Exam<p>
                <p class="slide-para">Think Exam handles large no. of users with 100k concurrency and get the advantage of a platform that is completely automated, smooth and user-friendly.</p>
            </div>
        </div>
        <div class="item">
            <img src="{{asset('public/frontend/assets/img/slide/banner-home-1.png')}}" alt="" style="width:100%;">
            <div class="carousel-caption">
                <p>Allow Your Learning Outside The Classroom</p>
                <p class="slide-para">with emphasis on learning, through technology Centralized Integrated, Multilingual, User-friendly &amp; Efficient Learning Platform</p>
            </div>
        </div>
    </div>
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
</div>
<br><br><br>
<main id="main">
    <section id="featured" class="featured">
        <div class="container">
            <h1 style="text-align: center;color: #636363;font-size: 31px;font-weight: bolder;">Welcome To The Best Online Education Source Of EDUZEM</h1>
            <br><br>
            <div class="row">
                <div class="col-lg-4">
                    <div class="icon-box">
                        <h3><a href="#">Solution for Education</a></h3>
                            <p>Zemusi Tech Solutions Pvt. Ltd. is bal Information Technology company, who is backed with a dedicated.</p><br>
                            <a href="#" class="buy-btn" style="float: Right; font-size: 15px">Read More</a>
                            <br><br>
                        <h3><a href="">Solution for Education</a></h3>
                            <p>Zemusi Tech Solutions Pvt. Ltd. is bal Information Technology company, who is backed with a dedicated.</p><br>
                            <a href="#" class="buy-btn" style="float: Right; font-size: 15px;">Read More</a>
                            <br><br>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="icon-box">
                        <h3><a href="#">Solution for Education</a></h3>
                            <p>Zemusi Tech Solutions Pvt. Ltd. is bal Information Technology company, who is backed with a dedicated.</p><br>
                            <a href="#" class="buy-btn" style="float: Right; font-size: 15px">Read More</a>
                            <br><br>
                        <h3><a href="">Solution for Education</a></h3>
                            <p>Zemusi Tech Solutions Pvt. Ltd. is bal Information Technology company, who is backed with a dedicated.</p><br>
                            <a href="#" class="buy-btn" style="float: Right; font-size: 15px">Read More</a>
                            <br><br>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="icon-box enquiry contact">
                        <h3><a href="#">Enquiry</a></h3>
                        <form action="#" method="post" role="form" class="php-email-form">
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Name*" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Email*" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Mobile Number*" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                <div class="validate"></div>
                            </div>
                            <textarea class="form-control" name="message" rows="3" data-rule="required" data-msg="Please write something for us" placeholder="Message*"></textarea>
                            <br>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="top-content">
        <div class="container-fluid">
            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner row w-100 mx-auto" role="listbox">
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active" >
                        <div style="background-image: url('public/frontend/assets/img/package-1.png'); border-radius:15px">
                            <br>
                            <h3 class="heading-corousel">Artificial Intelligence</h3>
                            <div>
                                <div><br><br><br><br><br><br></div>
                                <div class="row">
                                    <div class="col-12" >
                                        <div class="row text-info-corousel">    
                                            <div class="row strength-time">
                                                <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="count-corousel">5000</h4></span>
                                            </div>
                                            &nbsp; &nbsp; &nbsp; 
                                            <div class="row strength-time">
                                                <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="time-corousel">16:00</h4></span>
                                            </div>
                                            &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; 
                                            <h4 class="price-corousel">₹1200.00</h4>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" >
                        <div style="background-image: url('public/frontend/assets/img/package-1.png'); border-radius:15px">
                            <br>
                            <h3 class="heading-corousel">Artificial Intelligence</h3>
                            <br><br><br><br><br><br>
                            <div class="row">
                                <div class="col-lg-12" >
                                    <div class="row text-info-corousel">    
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="count-corousel">5000</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; 
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="time-corousel">16:00</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; 
                                        <h4 class="price-corousel">₹1200.00</h4>
                                    </div>
                                </div>
                            </div>                  
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" >
                        <div style="background-image: url('public/frontend/assets/img/package-1.png'); border-radius:15px">
                            <br>
                            <h3 class="heading-corousel">Artificial Intelligence</h3>
                            <br><br><br><br><br><br>
                            <div class="row">
                                <div class="col-lg-12" >
                                    <div class="row text-info-corousel">    
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="count-corousel">5000</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; 
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="time-corousel">16:00</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; 
                                        <h4 class="price-corousel">₹1200.00</h4>
                                    </div>
                                </div>
                            </div>                  
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" >
                        <div style="background-image: url('public/frontend/assets/img/package-1.png'); border-radius:15px">
                            <br>
                            <h3 class="heading-corousel">Artificial Intelligence</h3>
                            <br><br><br><br><br><br>
                            <div class="row">
                                <div class="col-lg-12" >
                                    <div class="row text-info-corousel">    
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="count-corousel">5000</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; 
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="time-corousel">16:00</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; 
                                        <h4 class="price-corousel">₹1200.00</h4>
                                    </div>
                                </div>
                            </div>                  
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" >
                        <div style="background-image: url('public/frontend/assets/img/package-1.png'); border-radius:15px">
                            <br>
                            <h3 class="heading-corousel">Artificial Intelligence</h3>
                            <br><br><br><br><br><br>
                            <div class="row">
                                <div class="col-lg-12" >
                                    <div class="row text-info-corousel">    
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="count-corousel">5000</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; 
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="time-corousel">16:00</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; 
                                        <h4 class="price-corousel">₹1200.00</h4>
                                    </div>
                                </div>
                            </div>                  
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" >
                        <div style="background-image: url('public/frontend/assets/img/package-1.png'); border-radius:15px">
                            <br>
                            <h3 class="heading-corousel">Artificial Intelligence</h3>
                            <br><br><br><br><br><br>
                            <div class="row">
                                <div class="col-lg-12" >
                                    <div class="row text-info-corousel">    
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="count-corousel">5000</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; 
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="time-corousel">16:00</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; 
                                        <h4 class="price-corousel">₹1200.00</h4>
                                    </div>
                                </div>
                            </div>                  
                        </div>
                    </div>
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" >
                        <div style="background-image: url('public/frontend/assets/img/package-1.png'); border-radius:15px">
                            <br>
                            <h3 class="heading-corousel">Artificial Intelligence</h3>
                            <br><br><br><br><br><br>
                            <div class="row">
                                <div class="col-lg-12" >
                                    <div class="row text-info-corousel">    
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="count-corousel">5000</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; 
                                        <div class="row strength-time">
                                            <img class="img-corousel" src="{{asset('public/frontend/assets/img/icon-user.png')}}">&nbsp;&nbsp;<span><h4 class="time-corousel">16:00</h4></span>
                                        </div>
                                        &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; 
                                        <h4 class="price-corousel">₹1200.00</h4>
                                    </div>
                                </div>
                            </div>                  
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <br><br>
    <section id="services" class="services">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Choose Your Package</h2>
                <p style="font-size: 14px"  >Duis mi ipsum, vestibulum eget nulla nec, maximus rhoncus turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 flex-gap">
                    <div class="icon-box" style="display:flex;  margin-bottom: 20px;">  
                        <video width="100%" height="100%" controls poster= "{{asset('public/frontend/assets/img/thumnail.jpg')}}">
                            <source  src="{{asset('public/frontend/assets/img/videos/seed.mp4')}}" type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 flex-gap">
                    <div class="icon-box"  style="display:flex; margin-bottom: 20px;">  
                        <video width="100%" height="100%" controls poster= "{{asset('public/frontend/assets/img/thumnail.jpg')}}">
                            <source src="{{asset('public/frontend/assets/img/videos/seed.mp4')}}" type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 flex-gap">
                    <div class="icon-box"  style="display:flex; margin-bottom: 20px;">  
                        <video width="100%" height="100%" controls poster= "{{asset('public/frontend/assets/img/thumnail.jpg')}}">
                            <source src="{{asset('public/frontend/assets/img/videos/seed.mp4')}}" type="video/mp4">
                        </video>
                    </div>
                </div> 
            </div>
            <br>  
            <div class="row">
                <div class="col-lg-4 col-md-6 flex-gap">
                    <div class="icon-box" style="display:flex; margin-bottom: 20px;">  
                        <video width="100%" height="100%" controls poster= "{{asset('public/frontend/assets/img/thumnail.jpg')}}">
                            <source src="{{asset('public/frontend/assets/img/videos/seed.mp4')}}" type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 flex-gap">
                    <div class="icon-box" style="display:flex; margin-bottom: 20px;">  
                        <video width="100%" height="100%" controls poster= "{{asset('public/frontend/assets/img/thumnail.jpg')}}">
                            <source src="{{asset('public/frontend/assets/img/videos/seed.mp4')}}" type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 flex-gap">
                    <div class="icon-box" style="display:flex; margin-bottom: 20px;">  
                        <video width="100%" height="100%" controls poster= "{{asset('public/frontend/assets/img/thumnail.jpg')}}">
                            <source src="{{asset('public/frontend/assets/img/videos/seed.mp4')}}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div>
        <video width="100%" height="100%" controls poster= "{{asset('public/frontend/assets/img/thumnail2.jpg')}}">
            <source src="{{asset('public/frontend/assets/img/videos/seed.mp4')}}" type="video/mp4">
        </video>
    </div>
    <br><br>
    <div class="container">
        <div class="section-title">
            <h2>Choose Your Package</h2>
            <p style="font-size: 14px">Duis mi ipsum, vestibulum eget nulla nec, maximus rhoncus turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
        </div>
        <div class="row image-center-index">
            <div class="col-lg-4 p-2">
                <img src="{{asset('public/frontend/assets/img/facl-1.png')}}">
            </div>
            <br>
            <div class="col-lg-4 p-2">
                <img src="{{asset('public/frontend/assets/img/facl-2.png')}}">
            </div>
            <br>
            <div class="col-lg-4 p-2">
                <img src="{{asset('public/frontend/assets/img/facl-1.png')}}">
            </div>
        </div>
        <br><br>
    </div>
    <br><br>
    <div class="container-fluid">
        <div class=" student-review">
            <h3 class="review-text section-title">Students Review</h3>
            <p style="text-align: center; font-size: 14px;line-height: 30px;">Tolerably behaviour may admitting daughters offending her ask own. Praise effect wishes change way and any wanted. Lively use looked latter regard had. Do he it part more last in. Merits ye if mr narrow points. Melancholy particular devonshire alteration it favourable appearance</p>
            <br>
            <div id="carousel-example-2" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner row w-100 mx-auto">
                    <div class="item col-12 col-sm-6 col-md-4 col-lg-12 active">
                        <div class="col-md-12">
                            <div class="row review-border p-3">
                                <div class="col-md-4" ><img src="{{asset('public/frontend/assets/img/student-1.png')}}"></div>
                                <div class="col-md-8">
                                    <p style="font-size: 14px; text-align: right; text-align:justify;line-height: 30px;">Maecenas leo leo, vehicula dapibus dapibus nec, vehicula id lacus. In hac habitasse platea dictumst. Aliquam ut suscipit sapien. Nam sit amet arcu vitae odio tempus ullamcorper sit amet a ante. Sed condimentum ipsum eu tortor commodo, sit amet scelerisque nibh condimentum.</p>
                                    <p style="font-size: 16px; text-align: left;">Sujit Lenka <br> Biotech Student</p>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="item col-12 col-sm-6 col-md-4 col-lg-12">
                        <div class="col-md-12">
                            <div class="row review-border p-3">
                                <div class="col-md-4" ><img src="{{asset('public/frontend/assets/img/student-1.png')}}"></div>
                                <div class="col-md-8">
                                    <p style="font-size: 14px; text-align: right; text-align:justify;line-height: 30px;">Maecenas leo leo, vehicula dapibus dapibus nec, vehicula id lacus. In hac habitasse platea dictumst. Aliquam ut suscipit sapien. Nam sit amet arcu vitae odio tempus ullamcorper sit amet a ante. Sed condimentum ipsum eu tortor commodo, sit amet scelerisque nibh condimentum.</p>
                                    <p style="font-size: 16px; text-align: left;">Sujit Lenka <br> DSFASDSA Student</p>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel-example-2" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-2" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <br>
    <section class="container">
    <br>
        <div class="section-title">
            <h2 style="text-align:center">OUR ONLINE EXAM CAMPUS</h2>
            <p style="text-align:center; font-size:14px">Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>
        <div class="top-content">
            <div class="container-fluid">
                <div id="carousel-example-3" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner row w-100 mx-auto" role="listbox">
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active" style="text-align:center;">
                            <img src="{{asset('public/frontend/assets/img/clients/client-1.png')}}" alt="">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" style="text-align:center;">
                            <img src="{{asset('public/frontend/assets/img/clients/client-2.png')}}" alt="">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" style="text-align:center;">
                            <img src="{{asset('public/frontend/assets/img/clients/client-3.png')}}" alt="">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" style="text-align:center;">
                            <img src="{{asset('public/frontend/assets/img/clients/client-4.png')}}" alt="">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" style="text-align:center;">
                            <img src="{{asset('public/frontend/assets/img/clients/client-5.png')}}" alt="">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" style="text-align:center;">
                            <img src="{{asset('public/frontend/assets/img/clients/client-6.png')}}" alt="">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" style="text-align:center;">
                            <img src="{{asset('public/frontend/assets/img/clients/client-7.png')}}" alt="">
                        </div>
                        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3" style="text-align:center;">
                            <img src="{{asset('public/frontend/assets/img/clients/client-8.png')}}" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel-example-3" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-example-3" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection