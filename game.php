<?php
	session_start();
	if(!isset($_SESSION["logged"])){
		header("Location: login.php");
	}
<<<<<<< HEAD
	
=======
>>>>>>> origin/master
?>

<!DOCTYPE html>
<html>
<head>
	<title> New Game </title>
	<link rel="stylesheet" type="text/css" href="navbar.css" />
	<link rel="stylesheet" type="text/css" href="gamecss.css" />
	<script type="text/javascript">
	var values={RON:1,USD:0,EUR:0};
	var eurvalue;
	var usdvalue;
	window.onload = function () {

		// dataPoints
		var dataPoints1 = [];
		var dataPoints2 = [];
		var dataPoints3 = [];
		var chart = new CanvasJS.Chart("console1",{
			zoomEnabled: true,
			title: {
				text: "Cotatie(RON)"		
			},
			toolTip: {
				shared: true
				
			},
			legend: {
				verticalAlign: "top",
				horizontalAlign: "center",
                                fontSize: 14,
				fontWeight: "bold",
				fontFamily: "calibri",
				fontColor: "dimGrey"
			},
			axisX: {
				title: "chart updates every 10 secs"
			},
			axisY:{
				prefix: 'RON',
				includeZero: false
			}, 
			data: [{ 
				// dataSeries1
				type: "line",
				xValueType: "dateTime",
				showInLegend: true,
				name: "EUR",
				dataPoints: dataPoints1
			},
			{				
				// dataSeries2
				type: "line",
				xValueType: "dateTime",
				showInLegend: true,
				name: "USD" ,
				dataPoints: dataPoints2
			},
			{				
				// dataSeries3
				type: "line",
				xValueType: "dateTime",
				showInLegend: true,
				name: "GBP" ,
				dataPoints: dataPoints3
			}],
          legend:{
            cursor:"pointer",
            itemclick : function(e) {
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
              }
              else {
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          }
		});



		var updateInterval = 10000;
		// initial value
		var yValue1 = 4.5333; 
		var yValue2 = 4.1453;
		var yValue3 = 5.3604;
		
		var time = new Date();
		//time.setHours(9);
		//time.setMinutes(30);
		//time.setSeconds(00);
		//time.setMilliseconds(00);
		// starting at 9.30 am

		var updateChart = function (count) {
			count = count || 1;

			// count is number of times loop runs to generate random dataPoints. 

			for (var i = 0; i < count; i++) {
				
				// add interval duration to time				
				time.setTime(time.getTime()+ updateInterval);
 
				yValue1 = (Math.random() * (5.2345 - 4.1234) + 4.1234);
				yValue2 = (Math.random() * (4.3456 - 3.6789) + 3.6789);
				yValue3 = (Math.random() * (6.4321 - 4.9123) + 4.9123);
				values["USD"]=yValue2;
				values["EUR"]=yValue1;
				totalvalue=parseInt(document.getElementById("USD").innerHTML)*values["USD"]
				+parseInt(document.getElementById("EUR").innerHTML)*values["EUR"]+parseInt(document.getElementById("RON").innerHTML);
				document.getElementById("total").innerHTML=totalvalue.toFixed(4);		
				//if totalvalue is=> to 2000 then the player won the game, if totalvalue is <100 then the player lost the game
				if(totalvalue<100){
					//loss
				}
				if(totalvalue>=2000){
					//win
				}
				// pushing the new values
				dataPoints1.push({
					x: time.getTime(),
					y: yValue1
				});
				dataPoints2.push({
					x: time.getTime(),
					y: yValue2
				});
				dataPoints3.push({
					x: time.getTime(),
					y: yValue3
				});

			};

			// updating legend text with  updated with y Value 
			chart.options.data[0].legendText = " EUR " + yValue1.toFixed(4);
			chart.options.data[1].legendText = " USD " + yValue2.toFixed(4); 
			chart.options.data[2].legendText = " GBP " + yValue3.toFixed(4); 

			chart.render();

		};

		// generates first set of dataPoints 
		updateChart(2);	
		 
		// update chart after specified interval 
		setInterval(function(){updateChart()}, updateInterval);
		
		
	}
	//function for calculating the total amount of money
	function calculate(){
		//document.getElementById("total").innerHTML=test;
		var currencies = document.getElementsByName('currency1');
		var currency1;
		for(var i = 0; i < currencies.length; i++){
			if(currencies[i].checked){
				currency1 = currencies[i].value;
				break;
			}
		}
		currencies = document.getElementsByName('currency2');
		var currency2;
		for(var i = 0; i < currencies.length; i++){
			if(currencies[i].checked){
				currency2 = currencies[i].value;
				break;
			}
		}
		var sum_to_convert=parseFloat(document.getElementsByName('currency1sum')[0].value);
		var currency1_total_sum=parseFloat(document.getElementById(currency1).innerHTML);
		var currency1_sum_after_convert=currency1_total_sum-sum_to_convert;
		if(currency1_sum_after_convert>=0){
			document.getElementById(currency1).innerHTML=currency1_sum_after_convert;
			var sum_in_ron=sum_to_convert*values[currency1];
			var sum_in_currency2=sum_in_ron/values[currency2];
			var currency2_total_sum=parseFloat(document.getElementById(currency2).innerHTML);
			document.getElementById(currency2).innerHTML=currency2_total_sum+sum_in_currency2;
		}
		//document.getElementById(currency2).innerHTML=parseInt(document.getElementById(currency2).innerHTML)+
		//(parseInt(document.getElementsByName('currency1sum')[0].value)*values[currency1])/values[currency2];
		//values[currency1]*parseInt(document.getElementById(currency1).innerHTML);
		//document.getElementById("clicked").innerHTML=currency1+" "+currency2+" "+document.getElementsByName('currency1sum')[0].value;
		return false;
	}
	</script>
	<script type="text/javascript" src="canvasjs.min.js"></script>
</head>
<body>
	<nav>
		<ul class="navigation">
			<?php	
				if(isset($_SESSION["logged"])){
					echo '<li><a href="choice.php">Home</a></li>';
				}
				else{
					echo '<li><a href="home.php">Home</a></li>';
				}
			?>  
			<li><a href="contact.php">Contact</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="signup.php">Signup</a></li>
			<?php	
				if(isset($_SESSION["logged"])){
					echo '<li style="float:right"><a href="logout.php">Logout</a></li>';
				}
			?>  
		</ul>
	</nav>
	<div name="console" class="console">
	<div class="console1" id="console1">

	</div>
	<div name="console2" class="console2">
		<form class="ex" name="ex"  onsubmit="return calculate()">
		<fieldset>
			<legend>From</legend>
				<input type="radio" name="currency1" value="RON" checked> RON<br>
				<input type="radio" name="currency1" value="EUR"> EUR<br>
				<input type="radio" name="currency1" value="USD"> USD
		</fieldset>
		<fieldset>
			<legend>To</legend>
				<input type="radio" name="currency2" value="RON" checked> RON<br>
				<input type="radio" name="currency2" value="EUR"> EUR<br>
				<input type="radio" name="currency2" value="USD"> USD
		</fieldset>
		<fieldset>
		<legend>Sum</legend>
			Currency 1:<br>
			<input type="text" name="currency1sum" value="0"><br>
			<br>
		</fieldset>
			<input class="exchange" type="submit" value="convert">
		</form>
		<table border=1 style="margin-top:5px;width:100%;">
		<tr>
			<td>RON</td><td id="RON">200</td>
		</tr>
		<tr>
			<td>USD</td><td id="USD">0</td>
		</tr>
		<tr>
			<td>EUR</td><td id="EUR">0</td>
		</tr>
		<tr>
			<td>TOTAL(RON)</td><td id="total"></td>
		</tr>
		</table>
	</div>
	</div>
	

</body>
</html>