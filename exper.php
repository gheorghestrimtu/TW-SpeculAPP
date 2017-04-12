<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Transaction form</title>
<link rel="stylesheet" type="text/css" href="navmenu.css" />
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

<form action="expert.php">
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
	<input type="submit" value="Submit">
</form>
</body>
</head>