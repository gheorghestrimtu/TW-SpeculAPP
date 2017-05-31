<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head><title>Fail</title>
<link rel="stylesheet" type="text/css" href="navbar.css" />
<link rel="stylesheet" type="text/css" href="failure.css" />
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
<div class="already">
		<p class="center"> Authentication has failed! </p>
</div>
</body>
</html>