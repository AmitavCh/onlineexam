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
    margin-top:-6px;
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
input,date{color: black;}
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
<script type = "text/javascript" src = "https://www.gstatic.com/charts/loader.js"></script>
<script type = "text/javascript"> google.charts.load('current', {packages: ['corechart']});</script>
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
                <div class="col-lg-9 mb-4">
                  <div class="pad">
                    <div class="row">
                      <form class="date">
                        <div class="col-md-4">
                          <label>From date:
                            <input type="date" name="party" min="1985-01-01" max="2024-12-31">
                          </label>
                        </div>
                        <div class="col-md-4">
                          <label>To date:
                            <input type="date" name="party" min="1985-01-01" max="2024-12-31">
                          </label>
                        </div>
                        <div class="col-md-2">
                          <button  class="buttn2">submit</button>
                        </div>
                     </form>  
                    </div>
                    <div id="chart_div" style="width: 800px; height: 340px; margin-top: 20px;"></div>
                 </div>
                </div>

          </div> 
   </section>
  </main>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- Template Main JS File -->
<script>
  google.charts.load('current', {'packages':['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawStuff);
  function drawStuff() {
    var button = document.getElementById('change-chart');
    var chartDiv = document.getElementById('chart_div');
    var arrayFromPHP = <?php echo json_encode($reportingFormat); ?>;
    var week_data = arrayFromPHP;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Subject');
    data.addColumn('number', 'Mark');
    //data.addColumn('string', 'Exam Date');
    for (var i = 0; i < week_data.length; i++) {
        data.addRow([week_data[i].topic_name, week_data[i].marks]);
    }
    var materialOptions = {
      width: 900,
      series: {
        0: { axis: 'distance' }, // Bind series 0 to an axis named 'distance'.
        1: { axis: 'brightness' } // Bind series 1 to an axis named 'brightness'.
      },
      axes: {
        y: {
          distance: {label: 'Score'}, // Left y-axis.
          brightness: {side: 'right', label: 'apparent magnitude'} // Right y-axis.
        }
      }
    };

    var classicOptions = {
      width: 900,
      series: {
        0: {targetAxisIndex: 0},
        1: {targetAxisIndex: 1}
      },
      title: 'Nearby galaxies - distance on the left, brightness on the right',
      vAxes: {
        // Adds titles to each axis.
        0: {title: 'parsecs'},
        1: {title: 'apparent magnitude'}
      }
    };

    function drawMaterialChart() {
      var materialChart = new google.charts.Bar(chartDiv);
      materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
      button.innerText = 'Change to Classic';
      button.onclick = drawClassicChart;
    }

    function drawClassicChart() {
      var arrayFromPHP = <?php echo json_encode($reportingFormat); ?>;
      var week_data = arrayFromPHP;
      var classicChart = new google.visualization.ColumnChart(chartDiv);
      classicChart.draw(data, classicOptions);
      button.innerText = 'Change to Material';
      button.onclick = drawMaterialChart;
    }
    drawMaterialChart();
  };
  
</script>

@endsection