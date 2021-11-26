@extends('layouts.home')
@section('home-title')
Home | Dashboard
@endsection
@section('home-content')
@php
use App\Http\Controllers\Controller;
@endphp
<style>
.active{
        color:#fcb221;
    }
 .a1{
  color: #fff;
}

.a1:hover{
  color: #fcb221;
}

.userbtn-dropdown2{
  background-color: #212959;
  color: #fff;
  border-radius: 5px;
  width: 100%;
  font-size: 14px;
  padding-top: 5px;
  padding-bottom: 5px;
 }

.userpanel-dashboard1{
    background-color: #212959;
    color: #fff; 
    border-radius: 5px;
    height: 40px; 
    text-align: left; 
    padding-left: 10px; 
    padding-top: 9px; font-size: 14px; 
    width: 100%;
}

.btn-profile{
  background-color: #fcb221; 
  color: #fff; 
  border-radius: 50px; 
  font-size: 17px; 
  padding: 10px 24px;
}

.date{
  background-color: #212959;
  color: #fff;
  border-radius: 7px;
  padding: 5px;
  width:  225px;
}

.buttn2{
  background: #fcb221;
    border: 0;
    border-radius: 50px;
    padding: 7px 24px;
    color: #fff;
    transition: 0.4s;
    font-size:13px;
    font-weight: bold;
    margin-top:4px;
}

.date{
  background-color: #212959; 
  border-radius: 7px; 
  color: #fff; 
  padding-left: 8px;
  padding-right: 8px;
  padding-top: 11px;
  float: center;
  width: 100%;
}

 html, body, #container {
    width: 100%;
    height: 380px;
    margin: 0;
    padding: 0;
}

@media (max-width: 768px){
  .pad{
    margin: 25px;
  }

  .date{
    margin-top: 10px;
  }
}
.anychart-credits-logo,.anychart-credits-text{
    display:none;
}
</style>
<main id="main">
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <ol>
                <li><a href="{{URL('/')}}">Home</a></li>
                <li>User Dashboard</li>
            </ol>
        </div>
    </section>
    <br>
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="userbtn"><i class="fa fa-dashboard"></i> &nbsp;<a class="a1" href="{{URL('home/dashboard')}}"> Dashboard</a></div>
                    <br>
                    <div class="userbtn"><i class="fa fa-bandcamp"></i> &nbsp;<a class="a1" href="{{URL('home/topiclist')}}"> Topic wise Test</a></div>
                    <br>
                    <!-- <div class="userbtn"><i class="fa fa-bandcamp"></i> &nbsp;<a class="a1" href="{{URL('home/setlist')}}"> Set wise Test</a></div>
                    <br> -->
                    <p class="userbtn" style="margin-bottom: 25px;">
                        <a class="a1 active"  data-toggle="collapse" href="#collapseExample" role="button"  aria-expanded="false" aria-controls="collapseExample" style="text-decoration:none"><i class="fa fa-file"></i>&nbsp; Performance Report &nbsp;&nbsp;&nbsp;&nbsp;<i class="icofont-caret-down"></i></a>
                    </p>
                    <div class="collapse" id="collapseExample" style="margin-top: -15px; margin-bottom: 10px">
                        <div class="card1">
                            <a href="{{URL('home/topicwiseperfomance')}}" class="userbtn-dropdown2 a1 active" style="color: #fcb221"><i class="fa fa-bar-chart" style="margin-left:30px; color: #fff"></i> &nbsp;Topic Wise</a>
                            <br>
                            <!-- <a href="{{URL('home/setwiseperfomance')}}" class="userbtn-dropdown2 a1" style="margin-top: -15px; color: #fcb221"><i class="fa fa-bar-chart" style="margin-left:30px; color: #fff"></i> &nbsp;Set Wise</a> -->
                        </div>
                    </div>
                    <div class="userbtn" style="border-top:"><i class="icofont-ui-user"></i> &nbsp;<a class="a1" href="{{URL('home/userprofile')}}">Profile</a></div>
                    <br>
                    <div class="userbtn"><i class="icofont-ui-password"></i> &nbsp;<a class="a1" href="{{URL('home/changepassword')}}"> Change Password</a></div>
                </div>
                <div class="col-lg-9 mb-4 content1">
                  <div class="container pad">
                    <div class="row">
                      <div class="col-md-3">
                        <form class="date">
                          <label>From date:
                            <input type="date" name="party" min="1985-01-01" max="2024-12-31">
                          </label>
                        </form>
                      </div>
                      <div class="col-md-3">
                        <form class="date">
                          <label>To date:
                            <input type="date" name="party" min="1985-01-01" max="2024-12-31">
                          </label>
                        </form>
                      </div>
                      <div class="col-md-2">
                        <button  class="buttn2">submit</button>
                      </div>
                    </div>
                  </div>
                    <div id="container"></div>
                </div>

            </div>

          </div> 
   </section>
  </main>
<script src="https://cdn.anychart.com/releases/8.10.0/js/anychart-core.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
<script src="https://cdn.anychart.com/releases/8.10.0/js/anychart-cartesian-3d.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
<script src="https://cdn.anychart.com/releases/8.10.0/js/anychart-exports.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
<script src="https://cdn.anychart.com/releases/8.10.0/js/anychart-ui.min.js?hcode=a0c21fc77e1449cc86299c5faa067dc4"></script>
<!-- Template Main JS File -->
<script>

  anychart.onDocumentReady(function () {

  // data
  var data = anychart.data.set([
    ["Mathmatics", 90],
    ["Physics", 72],
    ["Biology", 56],
    ["Chemistry", 81],
    ["Geography", 85],
    ["History", 66],
    ["Economics", 45],
    ["Civics", 21],
    ["Hindi", 91],
    ["English",71]
    ]);

  var dataSet1 = data.mapAs({x: 0, value: 1});
  var dataSet2 = data.mapAs({x: 0, value: 2});
  var dataSet3 = data.mapAs({x: 0, value: 3});

  // set chart type
  var chart = anychart.column3d();

  // setting title
  chart.title("Score Chart");

    // enabled grids
    chart.xGrid().enabled(true);
    chart.yGrid().enabled(true);  

  // set axes titles
  chart.xAxis().title("Subject");
  chart.yAxis().title("Score");

    // enable the value stacking mode
    chart.yScale().stackMode("value");

    // configure tooltips
    chart.tooltip().format("{%value}");

  // configure labels on the y-axis
  chart.yAxis().labels().format("{%value}");

  // set data
  var series1 = chart.column(dataSet1);
  series1.name("Sales 2009");
  var series2 = chart.column(dataSet2);
  series2.name("Sales 2010");
  var series3 = chart.column(dataSet3);
  series3.name("Sales 2011");

  // draw chart
  chart.container("container");
  chart.draw();
});

</script>

@endsection