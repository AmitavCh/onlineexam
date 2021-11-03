@extends('layouts.home')
@section('home-title')
Home | Quick Demo Page
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
 
    border-radius: 5px
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
    padding-bottom: 22px;
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
    border-radius: 5px;
    font-weight: bold;
    color: #21295a;
}
@media (max-width: 768px){
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
    padding-bottom: 20px;
}
}

.of-hidden{
    overflow: hidden;
}

.qa-block{
    padding: 30px 0;
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
    font-weight: normal;
    color: #000;
    font-family: "Open Sans", sans-serif;
    line-height: 1.5;
    font-size: 14px;
}

.buttn2{
    display: inline-block;
    border-radius: 5px;
    background-color: #fcaf17;
    height: 40px;
    width: 113px;
    font-weight: bold;
    color: #21295a; 
}
</style>
<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{URL('/')}}">Home</a></li>
                <li>Quick Demo</li>
            </ol>
        </div>
    </section>
    <section class="container-fluid">
      <div class="container clear-fx">

        <!-- question no -->
          <div class="container right-panel"  style="background-color: #ebebeb">
            <ul class="status-list clear-fx">
              <li>1</li>
              <li>2</li>
              <li>3</li>
              <li>4</li>
              <li>5</li>
              <li>6</li>
              <li>7</li>
              <li>8</li>
              <li>9</li>
              <li>10</li>
              <li>11</li>
              <li>12</li>
              <li>13</li>
              <li>14</li>
              <li>15</li>
              <li>16</li>
              <li>17</li>
              <li>18</li>
              <li>19</li>
              <li>20</li>
            </ul>
             <!-- <div class="container" style="text-align: center;">
                    <button type="button" class="buttn3">Submit</button>
                  </div> -->
          </div>


<br><br>
            <!--   <div class="col-md-2"><br><br></div> -->

              <!-- question -->
              <div class="container" style="background-color: #ebebeb; border-radius: 5px; padding:20px;">
                <div class="of-hidden" style="float: center;">

                  <form class="qa-block" style="text-align: left;">
                    <h6 class="question">What is the value of Pi? Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat? </h6>
                      <br>
                      
                      <ul >
                        <li><label><input type="radio" name="choice" value="1.34"> 1.34</label></li>
                        <li><label><input type="radio" name="choice" value="3.41"> 3.41</label></li>
                        <li><label><input type="radio" name="choice" value="3.14"> 3.14</label></li>
                        <li><label><input type="radio" name="choice" value="4.13"> 4.13</label></li>
                      </ul>
                    </form>



                    <!-- buttons -->
                    <div class="row" style="text-align: center">


                     <div class="btn-group">
                       <div class="col-md-6">
                         <button type="button" class="buttn2">previous</button>
                       </div>
                       <div class="col-md-6">
                         <button type="button" class="buttn2">Save & next</button>
                       </div>
                     </div>


                   </div>


                 </div>
               </div>


             </div>
           </section>
</main>
@endsection
