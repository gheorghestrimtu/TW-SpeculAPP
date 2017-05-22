<?php
	session_start();
	try{
		$conn=oci_connect('speculapp','SPECULAPP','localhost/XE');
		if (!$conn) {
			$e = oci_error();
			throw new Exception;
		}
		// Prepare the statement
		$stid = oci_parse($conn, 'SELECT WIN_SUM,LOSE_SUM FROM SETTINGS');
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
		$row = oci_fetch_array($stid, OCI_NUM);
		$winsum=$row[0];
		$losesum=$row[1];
		oci_free_statement($stid);
		$stid = oci_parse($conn, "SELECT EXCHANGE_RATE FROM CURRENCY WHERE TRIGRAMM='USD'");
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
		$row = oci_fetch_array($stid, OCI_NUM);
		$usdrate=$row[0];
		oci_free_statement($stid);
		$stid = oci_parse($conn, "SELECT EXCHANGE_RATE FROM CURRENCY WHERE TRIGRAMM='EUR'");
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
		$row = oci_fetch_array($stid, OCI_NUM);
		$eurrate=$row[0];
		oci_free_statement($stid);
	}catch(Exception $e){
		header("Location: generic_error.php");
	}		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
	<link rel="stylesheet" type="text/css" href="navbar.css" />
	<link rel="stylesheet" type="text/css" href="changestuff.css" />
</head>
<body>
	<nav>
		<ul class="navigation">
			<?php	
				if(isset($_SESSION["logged"])){
					if($_SESSION["uid"]==1){
						echo '<li><a href="admin.php">Home</a></li>';
					}else{
						echo '<li><a href="choice.php">Home</a></li>';
					}
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
	<div class="menu">
		<div class="board">
		<p>current win sum: <?php echo htmlspecialchars($winsum); ?></p>
		<form action="changewinsum.php">
				<input type="text" id="delete" name="delete" ><br>
				<input type="submit" value="Change win sum" id="sub">
		</form>
		<p>current lose sum: <?php echo htmlspecialchars($losesum); ?></p>
		<form action="changelosesum.php">
				<input type="text" id="delete" name="delete" ><br>
				<input type="submit" value="Change lose sum" id="sub">
		</form>
		<p>dollar exchange rate: <?php echo htmlspecialchars($usdrate); ?></p>
		<form action="changeusdrate.php">
				<input type="text" id="delete" name="delete" ><br>
				<input type="submit" value="Change dollar rate" id="sub">
		</form>
		<p>euro exchange rate: <?php echo htmlspecialchars($eurrate); ?></p>
		<form action="changeeurrate.php">
				<input type="text" id="delete" name="delete" ><br>
				<input type="submit" value="Change euro rate" id="sub">
		</form>
		
		</div>
	</div>
</body>
</html>