

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

<section id="signupform" >
<form id="myForm2" action="" onsubmit="return myFunction()">
  <input type="text" id="firstname" name="firstname" placeholder="First Name"> <br>
  <input type="text" id="lastname" name="lastname" placeholder="Last Name"> <br>
  <input type="text" id="email" name="email" placeholder="email" ><br>
  <input type="password" id="password" name="password" placeholder="password"><br>
  <input id="sub" type="submit" value="Submit">
  <p class="message">Already registered? <a href="jsandformual.html">Sign In</a></p>
</form> 
</section>

<p id="demo"></p>

<script>
function myFunction() {
    var x = document.getElementById("myForm2");
    if(x.elements[0].value!=""&&x.elements[1].value!=""&&x.elements[2]!=""&&x.elements[3]!="") {x.submit();}
    else{
    document.getElementById("demo").innerHTML="All boxes must be filled";}
	return false;
}
</script>

</body>
</html>