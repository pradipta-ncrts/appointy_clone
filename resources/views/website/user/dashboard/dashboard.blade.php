@extends('../layouts/website/master_template_web')
@section('title')
Squeedr
@endsection

@section('content')
<div class="body-part">
   <div class="container-custm">
      <div class="upper-cmnsection">
         <div class="heading-uprlft">Dashboard</div>
         <div class="upr-rgtsec">
            <div class="col-md-6">
               &nbsp;
            </div>
            <div class="col-md-6">
               <div class="full-rgt">
                  <div class="todate"><?php echo date('M d, Y');?></div>
                  <div class="dropdown custm-uperdrop">
                     <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"> <img src="{{asset('public/assets/website/images/arrow.png')}}" alt=""/></button>
                     <ul class="dropdown-menu ">
                        <li><a href="#">This Week</a></li>
                        <li><a href="#">Last Week</a></li>
                        <li><a href="#">This Month</a></li>
                        <li><a href="#">Last Month</a></li>
                        <li><a href="#">This Year</a></li>
                        <li><a href="#">Last Year</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="rightpan full">
         <!--<a class="add-w"  data-toggle="tooltip" title="Add Widget"><i class="fa fa-plus"></i></a>-->
         <div class="dash-info">
            <div class="col-sm-4 ">
               <div class="infobpx active">
                  <!--<a class="rem-w" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>-->
                  <h3>0</h3>
                  <h4>Appointment(S)</h4>
                  <p><span>0%</span> Form last month</p>
               </div>
            </div>
            <div class="col-sm-4 ">
               <div class="infobpx">
                  <!--<a class="rem-w" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>-->
                  <h3>0.00</h3>
                  <h4>Estimated Sales</h4>
                  <p><span>0%</span> Form last month</p>
               </div>
            </div>
            <div class="col-sm-4 ">
               <div class="infobpx">
                  <!--<a class="rem-w" data-toggle="tooltip" title="Remove"><i class="fa fa-trash-o"></i></a>-->
                  <h3>0</h3>
                  <h4>New Customers(S)</h4>
                  <p><span class="green">+0%</span> Form last month</p>
               </div>
            </div>
            <div class="clearfix"></div>
         </div>
         <hr>
         <div class="clearfix"></div>
         <div id="chartContainer" style="height: 300px; width: 100%;"></div>
         <hr>
         <a class="btn btn-primary butt-next center-block" style=" margin: 20px auto;  width: 200px;" id="addDataPoint"  >Quick Start Guide</a>
      </div>
   </div>
</div>
@endsection

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
   theme:"light2",
   animationEnabled: true,
   /*title:{
      text: "Game of Thrones Viewers of the First Airing on HBO"
   },*/
   axisY :{
      includeZero: false,
      //title: "Number of Viewers",
      //suffix: "mn"
   },
   axisX:{
      interval: 1,
   },
   toolTip: {
      shared: "true"
   },
   legend:{
      cursor:"pointer",
      itemclick : toggleDataSeries
   },
   data: [{
      type: "spline",
      visible: true,
      showInLegend: true,
      //yValueFormatString: "##.00mn",
      name: "Season 1",
      dataPoints: [
         { label: "1", y: 0 },
         { label: "2", y: 1},
         { label: "3", y: 0 },
         { label: "4", y: 0 },
         { label: "5", y: 0 },
         { label: "6", y: 0 },
         { label: "7", y: 0 },
         { label: "8", y: 0 },
         { label: "9", y: 3 },
         { label: "10", y: 0 },
         { label: "11", y: 0 },
         { label: "12", y: 0 },
         { label: "13", y: 0 },
         { label: "14", y: 0 },
         { label: "15", y: 0 },
         { label: "16", y: 0 },
         { label: "17", y: 0 },
         { label: "18", y: 0 },
         { label: "19", y: 0 },
         { label: "20", y: 0 },
         { label: "21", y: 0 },
         { label: "22", y: 1 },
         { label: "23", y: 0 },
         { label: "24", y: 0 },
         { label: "25", y: 0 },
         { label: "26", y: 0 },
         { label: "27", y: 0 },
         { label: "28", y: 0 },
         { label: "29", y: 0 },
         { label: "30", y: 0 },
         { label: "31", y: 0 },
      ]
   }]
});
chart.render();

$("#addDataPoint").click(function () {

   var length = chart.options.data[0].dataPoints.length;
   chart.options.data[0].name = "Month";
   
   for (var i = 0; i < 31; i++)
   {
      chart.options.data[0].dataPoints[i].y = Math.random();
   }
   
   chart.render();

   });

function toggleDataSeries(e) {
   if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
      e.dataSeries.visible = false;
   } else {
      e.dataSeries.visible = true;
   }
   chart.render();
}

}
</script>