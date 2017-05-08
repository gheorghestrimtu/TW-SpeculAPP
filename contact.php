<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Contact</title>
<<<<<<< HEAD
	<link rel="stylesheet" type="text/css" href="navbar.css" />
	<link rel="stylesheet" type="text/css" href="contact.css" />
=======

	<link rel="stylesheet" type="text/css" href="navbar.css" />
	<link rel="stylesheet" type="text/css" href="contact.css" />

>>>>>>> origin/master
</head>
<body>
	<nav>
		<ul class="navigation">
			<?php	
				if(isset($_SESSION["logged"])){
<<<<<<< HEAD
					if($_SESSION["uid"]==1){
						echo '<li><a href="admin.php">Home</a></li>';
					}else{
						echo '<li><a href="choice.php">Home</a></li>';
					}
=======
					echo '<li><a href="choice.php">Home</a></li>';
>>>>>>> origin/master
				}
				else{
					echo '<li><a href="home.php">Home</a></li>';
				}
			?>  
			<li><a class="active" href="contact.php">Contact</a></li>
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

<section id="names">
<p id="creator"> Game Creators</p>
<p> Gheorghe Strîmtu <a target="_blank" href="https://www.facebook.com/Uimitorul"> <img id="fb" src="fb.png" ></a></p>
<p> Iaroslav Mazur <a target="_blank" href="https://www.facebook.com/Mazur.Iaroslav" > <img id="fb" src="fb.png" > </a></p>
</section>



</body>
</html>