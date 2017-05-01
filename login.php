<?php
	session_start();
	if(isset($_SESSION["logged"])){
		header("Location: already_logged_in.php");
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="navbar.css" />
	<link rel="stylesheet" type="text/css" href="login.css" />
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
			<li><a class="active" href="login.php">Login</a></li>
			<li><a href="signup.php">Signup</a></li>
			<?php	
				if(isset($_SESSION["logged"])){
					echo '<li><a href="logout.php">Logout</a></li>';
				}
			?>  
		</ul>
	</nav>
	<section id="loginform">
		<form id="myForm" method="post" action="connect.php" onsubmit="return myFunction()">
			<input type="text" id="name" name="email" placeholder="E-mail" ><br>
			<input type="password" id="surname" name="password" placeholder="Password" ><br>
			<input  type="submit" id="sub" value="Submit" >
			<p class="message">Not registered? <a href="signup.php">Create an account</a></p>
		</form> 
	</section>
	<p id="demo"></p>
	<script>
		function myFunction() {
			var x = document.getElementById("myForm");
			if(x.elements[0].value!=""&&x.elements[1].value!="") {return true;}
			else{
				document.getElementById("demo").innerHTML="All boxes must be filled";
				return false;
			}
		}
	</script>
</body>
</html>