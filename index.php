<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="ui/main.css" />
    <script src="main.js"></script>
    <script>
           window.onload = function () {

var dataPoints1 = [];
var dataPoints2 = [];

var chart = new CanvasJS.Chart("chartContainer", {
    theme: "dark1",
    animationEnabled: true,
    backgroundColor: "transparent",
	zoomEnabled: true,
	title: {
		text: "Comparison of Power Usage over Time"
	},
	axisX: {
		title: "chart updates every 3 secs"
	},
	axisY:{
		prefix: "kWh",
		includeZero: false
	}, 
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		verticalAlign: "top",
		fontSize: 22,
		fontColor: "dimGrey",
		itemclick : toggleDataSeries
	},
	data: [{ 
		type: "line",
        fill: false,
		xValueType: "dateTime",
		yValueFormatString: "kWh ####.00",
		xValueFormatString: "hh:mm:ss TT",
		showInLegend: true,
		name: "Company A",
		dataPoints: dataPoints1
		},
		{				
			type: "line",
            fill: false,
			xValueType: "dateTime",
			yValueFormatString: "kWh ####.00",
			showInLegend: true,
			name: "Company B" ,
			dataPoints: dataPoints2
	}]
});

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

var updateInterval = 3000;
// initial value
var yValue1 = 600; 
var yValue2 = 605;

var time = new Date;
// starting at 9.30 am
time.setHours(9);
time.setMinutes(30);
time.setSeconds(00);
time.setMilliseconds(00);

function updateChart(count) {
	count = count || 1;
	var deltaY1, deltaY2;
	for (var i = 0; i < count; i++) {
		time.setTime(time.getTime()+ updateInterval);
		deltaY1 = .5 + Math.random() *(-.5-.5);
		deltaY2 = .5 + Math.random() *(-.5-.5);

	// adding random value and rounding it to two digits. 
	yValue1 = Math.round((yValue1 + deltaY1)*100)/100;
	yValue2 = Math.round((yValue2 + deltaY2)*100)/100;

	// pushing the new values
	dataPoints1.push({
		x: time.getTime(),
		y: yValue1
	});
	dataPoints2.push({
		x: time.getTime(),
		y: yValue2
	});
	}
    p1name = " person 1 "
	// updating legend text with  updated with y Value 
	chart.options.data[0].legendText = " Person 1 " + yValue1 + "kWh";
	chart.options.data[1].legendText = " Person 2 " + yValue2 + "kWh"; 
	chart.render();
    document.getElementById("p2use").innerHTML = yValue2 +"kwh"
    document.getElementById("p1use").innerHTML = yValue1 +"kWh"
}
// generates first set of dataPoints 
updateChart(100);	
setInterval(function(){updateChart()}, updateInterval);

}
            </script>
</head>
<body>
    <img id="desc" src="../Logo.png">
        <h1 id="title">Conservation Competition</h1>
        <p id="slogan">Gamification for good</p>
    <div id="right" class="user">    
        <form action="/" method="post">
        <input type="text" name="username" id="you2" class="name" value="Person 2" oninput="change2()"><br>
        </form>
        <p class = "name" id="name2">Person 2</p>
        <p>Usage:</p>
        <p id="p2use"></p>
    </div>
    <div id="chartContainer"></div>
    <div id="left" class="user">    
        <form action="/" method="post">
        <input type="text" name="username" id="you1" class="name" value="Person 1" oninput="change1()">
        </form>
        <p class = "name" id="name1">Person 1</p>
        <p>Usage:</p>
        <p id="p1use"></p>
    </div>
    <!--<div id="leader">
        <div class="user_lead" id="1">
            <p class="name" id="1">Lorem, ipsum.</p>
            <p class="usage" id="1"></p>
        </div>
        <div class="user_lead" id="2">
            <p class="name" id="2">Lorem, ipsum.</p>
            <p class="usage" id="2"></p>
        </div>
        <div class="user_lead" id="3">
            <p class="name" id="3">Lorem, ipsum.</p>
            <p class="name" id="3"></p>
        </div>
        <div class="user_lead" id="4">
            <p class="name" id="4">Lorem, ipsum.</p>
            <p class="usage" id="4"></p>
        </div>
    </div>-->
    <script>
        function change1(){
            document.getElementById('name1').innerHTML = document.getElementById("you1").value
            p1name = document.getElementById("you1").value
        }
        function change2(){
            document.getElementById('name1').innerHTML = document.getElementById("you2").value
            p1name = document.getElementById("you2").value
        }
    </script>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
