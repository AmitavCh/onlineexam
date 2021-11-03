@extends('layouts.home')
@section('home-title')
Home | Pricing Page
@endsection
@section('home-content')
@php
use App\Http\Controllers\Controller;
@endphp

<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{URL('/')}}">Home</a></li>
                <li>Contact</li>
            </ol>
        </div>
    </section>
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="info-box mb-4">
                        <i class="bx bx-envelope"></i>
                        <h3>Email Us</h3>
                        <p style="font-size: 14px">contact@example.com</p>
                    </div>
                    <div class="info-box  mb-4">
                        <i class="bx bx-map"></i>
                        <h3>India Office</h3>
                        <p style="font-size: 14px">M5/23, Acharya Vihar, <br>Bhubaneswar, Odisha <br>India. - 754107</p>
                    </div>
                    <div class="info-box  mb-4">
                        <i class="bx bx-map"></i>
                        <h3>USA Office</h3>
                        <p style="font-size: 14px"> 3 Bethesda Metro Center Suite 700 <br>Bethesda, MD <br>United States. - 20814</p>
                    </div>
                </div>
                <!-- <div class="col-lg-6 ">
                  <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
                </div> -->
                <div class="col-lg-8" style="background-color: #212959; border-radius: 17px;">
                    <div class="contact-form-text "><br/>
                        <h4 style="color: #fcb221;">Have You Any Query</h4>
                    </div>
                    <form action="#" method="post" role="form" class="php-email-form">
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Name*" data-rule="minlen:4" data-msg="Please enter your name" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Email*" data-rule="minlen:4" data-msg="Please enter your of email" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Mobile Number*" data-rule="minlen:4" data-msg="Please enter your mobile number" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Board Name*" data-rule="minlen:4" data-msg="Please enter your board" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Class*" data-rule="minlen:4" data-msg="Please enter your class" />
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="4" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection