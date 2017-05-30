<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="navbar.css" />
	<link rel="stylesheet" type="text/css" href="admin.css" />

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
	<div class="menu1">

		<div class="upperleft">
		<form action="delete_stuff.php">
				<input type="submit" value="Delete Stuff" id="del">
		</form>

		</div>
		<div class="upperright">
		<form action="change_stuff.php">
				<input type="submit" value="Change Stuff" id="cha">
		</form>
		</div>
<<<<<<< HEAD
	</div>

=======

	</div>


>>>>>>> origin/Testing
</body>
</html>