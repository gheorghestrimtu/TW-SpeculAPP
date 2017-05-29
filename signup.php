<?php
	session_start();
	if(isset($_SESSION["logged"])){
		header("Location: already_logged_in.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
	<link rel="stylesheet" type="text/css" href="navbar.css" />
	<link rel="stylesheet" type="text/css" href="signup.css" />
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
			<li><a class="active" href="signup.php">Signup</a></li>
			<?php	
				if(isset($_SESSION["logged"])){
					echo '<li><a href="logout.php">Logout</a></li>';
				}
			?>  
		</ul>
	</nav>
	<section id="signupform" >
		<form id="myForm2" action="createuser.php" onsubmit="return myFunction()">
			<input type="text" id="firstname" name="firstname" placeholder="First Name"> <br>
			<input type="text" id="lastname" name="lastname" placeholder="Last Name"> <br>
			<input type="text" id="email" name="email" placeholder="E-mail" ><br>
			<input type="password" id="password" name="password" placeholder="Password"><br>
			<input id="sub" type="submit" value="Submit">
			<p class="message">Already registered? <a href="login.php">Sign In</a></p>
		</form> 
	</section>
	<p id="demo"></p>
	<script>
		function myFunction() {
			var x = document.getElementById("myForm2");
			if(x.elements[0].value!=""&&x.elements[1].value!=""&&x.elements[2]!=""&&x.elements[3]!="") {return true;}
			else{
				document.getElementById("demo").innerHTML="All boxes must be filled";
				return false;
			}
		}
	</script>
</body>
</html>