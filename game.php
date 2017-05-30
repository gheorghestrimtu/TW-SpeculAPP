<?php
	session_start();
	if(!isset($_SESSION["logged"])){
		header("Location: login.php");
	}

	//create new game with unknown outcome
	try{
		$conn=oci_connect('speculapp','SPECULAPP','localhost/XE');
		if (!$conn) {
			$e = oci_error();
			throw new Exception;
		}
		// Prepare the statement
		$stid = oci_parse($conn, 'SELECT MAX(GAME_ID) FROM GAME');
		if (!$stid) {
			$e = oci_error($conn);
			throw new Exception;
		}
		// Perform the logic of the query
		$r = oci_execute($stid);
		if (!$r) {
			$e = oci_error($stid);
			throw new Exception;
		}	
		$row=oci_fetch_array($stid, OCI_NUM);
		$oldgameid=$row[0];
		$gameid=$oldgameid+1;
		oci_free_statement($stid);
		// Prepare the statement
		$stid=oci_parse($conn,'INSERT INTO GAME VALUES(:gameid,:sesionid,:userid,2,0,0,0,0)');
		if (!$stid) {
			$e = oci_error($conn);
			throw new Exception;
		}
		oci_bind_by_name($stid,":gameid",$gameid);
		oci_bind_by_name($stid,":sesionid",$_SESSION["sesion"]);
		oci_bind_by_name($stid,":userid",$_SESSION["uid"]);
		$r = oci_execute($stid);
		if (!$r) {
			$e = oci_error($stid);
			throw new Exception;
		}
		oci_free_statement($stid);
		oci_close($conn);
	}catch(Exception $e){
		session_unset();
		header("Location: error_while_connecting.php");
	}
	//get average exchange rates
	try{
		$conn=oci_connect('speculapp','SPECULAPP','localhost/XE');
		if (!$conn) {
			$e = oci_error();
			throw new Exception;
		}
		// Prepare the statement
		$stid = oci_parse($conn, 'SELECT EXCHANGE_RATE FROM CURRENCY');
		if (!$stid) {
			$e = oci_error($conn);
			throw new Exception;
		}
		// Perform the logic of the query
		$r = oci_execute($stid);
		if (!$r) {
			$e = oci_error($stid);
			throw new Exception;
		}
		// Fetch the results of the query
		$row = oci_fetch_array($stid, OCI_NUM);
		$row = oci_fetch_array($stid, OCI_NUM);
		$usd_rate=$row[0];
		$row = oci_fetch_array($stid, OCI_NUM);
		$eur_rate=$row[0];
		oci_free_statement($stid);
		oci_close($conn);
	}catch(Exception $e){
		session_unset();
		header("Location: error_while_connecting.php");
	}
	//get win and loss sums and time interval and start sum
	try{
		$conn=oci_connect('speculapp','SPECULAPP','localhost/XE');
		if (!$conn) {
			$e = oci_error();
			throw new Exception;
		}
		// Prepare the statement
		$stid = oci_parse($conn, 'SELECT WIN_SUM, LOSE_SUM, INTERVAL, START_SUM FROM SETTINGS');
		if (!$stid) {
			$e = oci_error($conn);
			throw new Exception;
		}
		// Perform the logic of the query
		$r = oci_execute($stid);
		if (!$r) {
			$e = oci_error($stid);
			throw new Exception;
		}
		$row=oci_fetch_array($stid,OCI_NUM);
		$win=$row[0];
		$lose=$row[1];
		$interval=$row[2];
		$start_sum=$row[3];
		oci_free_statement($stid);
		oci_close($conn);
	}catch(Exception $e){
		session_unset();
		header("Location: error_while_connecting.php");
	}
	
	//end of game function, useless
	function end_game($outcome,$total_sum,$eur,$usd,$ron){
		
	}

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
				title: "chart updates every "+(parseInt(document.getElementById("interval").innerHTML)/1000)+" secs"
			},
			axisY:{
				prefix: 'RON ',
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



<<<<<<< HEAD
		var updateInterval = parseInt(document.getElementById("interval").innerHTML);
=======
		var updateInterval = 10000;

>>>>>>> origin/Testing
		var eur_avg_rate=parseFloat(document.getElementById("eurorate").innerHTML);//<?php echo $eur_rate; ?>;
		var usd_avg_rate=parseFloat(document.getElementById("dollarrate").innerHTML);//<?php echo $usd_rate; ?>;
		var win_sum=parseFloat(document.getElementById("winsum").innerHTML);//<?php echo $win; ?>;
		var lose_sum=parseFloat(document.getElementById("losesum").innerHTML);//<?php echo $lose; ?>;
		// initial value
		var yValue1 = eur_avg_rate; 
		var yValue2 = usd_avg_rate;

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
 

				yValue1 = (Math.random() * ((eur_avg_rate+1.1111) - (eur_avg_rate-1.1111)) + (eur_avg_rate-1.1111));
				yValue2 = (Math.random() * ((usd_avg_rate+1.1111) - (usd_avg_rate-1.1111)) + (usd_avg_rate-1.1111));
				yValue3 = (Math.random() * (6.4321 - 4.9123) + 4.9123);
				values["USD"]=yValue2;
				values["EUR"]=yValue1;
				totalvalue=parseFloat(document.getElementById("USD").innerHTML)*values["USD"]
				+parseFloat(document.getElementById("EUR").innerHTML)*values["EUR"]+parseFloat(document.getElementById("RON").innerHTML);
				document.getElementById("total").innerHTML=totalvalue.toFixed(4);		
				//if totalvalue is=> to 2000 then the player won the game, if totalvalue is <100 then the player lost the game
				if(totalvalue<lose_sum){
					//game
					write_game_end(0);
					
				}
				if(totalvalue>=win_sum){
					write_game_end(1);

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

		write_transaction(currency1,currency2,sum_to_convert);
		return false;
	}
	function write_transaction(currency1,currency2,sum_to_convert){
		var gameid=parseFloat(document.getElementById("gameid").innerHTML);
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var useless=this.responseText;
			}
		};
		xhttp.open("GET", "insert_transaction.php?gameid="+gameid+"&curr1="+currency1+"&curr2="+currency2+"&sum="+sum_to_convert, true);
		xhttp.send();
	}
	
	function write_game_end(outcome){
		var gameid=parseFloat(document.getElementById("gameid").innerHTML);
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var useless=this.responseText;
			}
		};
		xhttp.open("GET", "game_end.php?gameid="+gameid+"&outcome="+outcome, true);
		xhttp.send();
		if(outcome==1){
			window.location="win.php";
		}
		else{
			window.location="loss.php";
		}
	}

	</script>
	<script type="text/javascript" src="canvasjs.min.js"></script>
</head>
<body>
	<div id="eurorate" style="display:none;">
		<?php echo htmlspecialchars($eur_rate); ?>
	</div>
	<div id="dollarrate" style="display:none;">
		<?php echo htmlspecialchars($usd_rate); ?>
	</div>
	<div id="winsum" style="display:none;">
		<?php echo htmlspecialchars($win); ?>
	</div>
	<div id="losesum" style="display:none;">
		<?php echo htmlspecialchars($lose); ?>
	</div>
	<div id="gameid" style="display:none;">
		<?php echo htmlspecialchars($gameid); ?>
	</div>
	<div id="startsum" style="display:none;">
		<?php echo htmlspecialchars($start_sum); ?>
	</div>
	<div id="interval" style="display:none;">
		<?php echo htmlspecialchars($interval); ?>
	</div>
	
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

		<p>win sum: <?php echo htmlspecialchars($win); ?> lose sum: <?php echo htmlspecialchars($lose); ?> </p>

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
			<td>RON</td><td id="RON"><?php echo htmlspecialchars($start_sum); ?></td>
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