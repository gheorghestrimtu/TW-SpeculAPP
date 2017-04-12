

<!DOCTYPE html>
<html>
<head>
<title>Sign up</title>
<link rel="stylesheet" type="text/css" href="navmenu.css" />
</head>
<body>


<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="jsandformual.html">Login</a></li>
  <li><a href="signup.php">Signup</a></li>
</ul>

<section id="signupform">
<div id="div1">
<form id="myForm" action="">
  <label for="name">First Name</label><br>
  <input type="text" id="name" name="name" ><br>
  <label for="surname">Last Name</label><br>
  <input type="password" id="surname" name="surname" ><br>
  <input style="display:none" type="submit" value="Submit">
</form> 
<button id="signup" onclick="myFunction()">Sign up</button>
</div>
</section>

<p id="demo"></p>

<script>
function myFunction() {
    var x = document.getElementById("myForm");
    if(x.elements[0].value!=""&&x.elements[1].value!="") {x.submit();}
    else{
    document.getElementById("demo").innerHTML="All boxes must be filled";}
}
</script>

</body>
</html>