
<?php

	session_start();
	if(!isset($_SESSION["logged"])){
		header("Location: login.php");
	}
	$wins=25;
	$losses=23;
	try{
		how_many();
	}catch(Exception $e){
		header("Location: generic_error.php");
	}
	function how_many(){
		global $wins,$losses;
		$conn=oci_connect('speculapp','SPECULAPP','localhost/XE');
		if (!$conn) {
			$e = oci_error();
			throw new Exception;
		}
		// Prepare the statement
		$stid = oci_parse($conn, 'SELECT COUNT(*) FROM GAME WHERE USER_ID=:id AND OUTCOME=1');
		if (!$stid) {
			$e = oci_error($conn);
			throw new Exception;
		}
		$id=$_SESSION["uid"];
		oci_bind_by_name($stid,':id',$id);
		// Perform the logic of the query
		$r = oci_execute($stid);
		if (!$r) {
			$e = oci_error($stid);
			throw new Exception;
		}
		// Fetch the results of the query
		$row = oci_fetch_array($stid, OCI_NUM);
		$wins=$row[0];
		//free the statement
		oci_free_statement($stid);
		// Prepare the statement
		$stid = oci_parse($conn, 'SELECT COUNT(*) FROM GAME WHERE USER_ID=:id AND OUTCOME=0');
		if (!$stid) {
			$e = oci_error($conn);
			throw new Exception;
		}
		$id=$_SESSION["uid"];
		oci_bind_by_name($stid,':id',$id);
		// Perform the logic of the query
		$r = oci_execute($stid);
		if (!$r) {
			$e = oci_error($stid);
			throw new Exception;
		}
		// Fetch the results of the query
		$row = oci_fetch_array($stid, OCI_NUM);
		$losses=$row[0];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="navbar.css" />
	<link rel="stylesheet" type="text/css" href="user.css" />
			<script type="text/javascript">
				var wins = "<?php echo $wins; ?>";
				var losses= "<?php echo $losses; ?>";
				window.onload=function () {
					var chart = new CanvasJS.Chart("upperleft",
					{
						theme: "theme2",
						title:{
							text: "Games Won/Lost"
						},
						data: [
						{
							type: "pie",
							//showInLegend: true,
							toolTipContent: "{y} - #percent %",
							yValueFormatString: "#0.#",
							legendText: "{indexLabel}",
							dataPoints: [
								{ y: wins, indexLabel: "Wins" },
								{ y: losses, indexLabel: "Losses" }
							]
						}
						]
					});
					chart.render();
				}
			</script>
	<script src="canvasjs.min.js"></script>
</head>
<body>
	<nav>
		<ul class="navigation">
			<?php	
				if(isset($_SESSION["logged"])){
					echo '<li><a class="active" href="choice.php">Home</a></li>';
				}
				else{
					echo '<li><a class="active" href="home.php">Home</a></li>';
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

<main class="inline-block-center">
	<div id="upperleft">
	</div>
	
	<div id="center">
		<p style="font-weight: bold; font-size:34px;"> Best players ever: </p>
		<?php
			try{
				$conn=oci_connect('speculapp','SPECULAPP','localhost/XE');
				if (!$conn) {
					throw new Exception;
				}
				// Prepare the statement
				$stid = oci_parse($conn, 'SELECT * FROM TOP_TRADERS');
				if (!$stid) {
					throw new Exception;
				}
				// Perform the logic of the query
				$r = oci_execute($stid);
				if (!$r) {
					throw new Exception;
				}
				$statement=oci_parse($conn,'SELECT FIRST_NAME, LAST_NAME FROM USERS WHERE USER_ID=:userid');
				if (!$statement) {
					throw new Exception;
				}
				echo '<table id="best">';
				echo '<tr><th><i><u>Name</u></i></th><th><i><u>Win Ratio</u></i></th></tr>';
				while($row=oci_fetch_array($stid,OCI_NUM)){
					$userid=$row[0];
					$ratio=$row[1];
					oci_bind_by_name($statement,':userid',$userid);
					$result=oci_execute($statement);
					if(!$result){
						throw new Exception;
					}
					$arr=oci_fetch_array($statement,OCI_NUM);
					$name=$arr[0].' '.$arr[1];
					echo '<tr><td>'.$name.'</td><td>'.$ratio.'</td></tr>';
				}
				echo '</table>';
				oci_free_statement($statement);
				oci_free_statement($stid);
			}catch(Exception $e){
				header("Location: generic_error.php");
			}
		?>
		<div id="buttonlist">
		<a href="#html" download>
			<button type="button">Download as HTML</button>
		</a>
		<a href="#json" download>
			<button type="button">Download as JSON</button>
		</a>
		<a href="#pdf" download>
			<button type="button">Download as PDF</button>
		</a>
		</div>
	</div>
	
	<div id="upperright">
		<p style="padding-top: 20px;"><?php echo ("Welcome back, "."<b>".$_SESSION["email"]."</b>"."!") ?></p>
		<p><?php echo ("<i>"."Isn't it a great day for a profitable day-trading?"."</i>") ?></p>
		
		<form action="game.php" method="get">
			<button class="newgame" type="submit">Start a New Game</button>
		</form>
	</div>
	
</main>

</body>
</html>