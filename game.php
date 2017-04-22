<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title> New Game </title>
	<link rel="stylesheet" type="text/css" href="navmenu.css" />
	<link rel="stylesheet" type="text/css" href="gamecss.css" />
</head>
<body>
	<nav>
	<ul>
		<li><a href="home.php">Home</a></li>
		<li><a href="contact.php">Contact</a></li>
		<li><a href="about.php">About</a></li>
		<li><a href="jsandformual.html">Login</a></li>
		<li><a href="signup.php">Signup</a></li>
	</ul>
	</nav>
	<div class="console">
	<div class="console1">
		<form class="curs" action="#">
			<fieldset>
			<legend>Currency</legend>
				<input type="radio" name="currency1" value="RON" checked> RON<br>
				<input type="radio" name="currency1" value="EUR"> EUR<br>
				<input type="radio" name="currency1" value="USD"> USD
			</fieldset>
			<input  class="aflacurs" type="submit" value="Afla Curs">
		</form>
		<div class="show curs">
		<p> Cursul pentru currency </p>
		</div>
	</div>
	<div class="console2">
		<form class="ex" action="#">
		<fieldset>
			<legend>Currency 1</legend>
				<input type="radio" name="currency1" value="RON" checked> RON<br>
				<input type="radio" name="currency1" value="EUR"> EUR<br>
				<input type="radio" name="currency1" value="USD"> USD
		</fieldset>
		<fieldset>
			<legend>Currency 2</legend>
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
			<input class="exchange" type="submit" value="Exchange">
		</form>
		<p>total:<p>
	</div>
	<div class="console3">
	<p> Flux de stiri atom despre cei mai "bogati" jucatori</p>
	</div>
	</div>
	

</body>
</html>