<!DOCTYPE html>
<html>
<head><title>Formular Web</title></head>
<body>
<h1>Formular de autentificare</h1>
<form action="dbt.php" method="post"> 
<?php
	if(!isset($_COOKIE["username"])){	
?>
   <p>Name: <input type="text" name="name" size="20"
        placeholder="Numele d-voastra" />
      Surname: <input type="text" name="surname" size="20"
   	    placeholder="Prenumele d-voastra" /> </p>
   <p><input type="submit" value="Trimite" 
        title="Apasati butonul pentru a expedia datele spre server" /> </p>
<?php
	}
	else{
?>
	<p>Name: <input type="text" name="name" size="20"
        placeholder=<?php echo($_COOKIE["username"]) ?>		/>
    Surname: <input type="text" name="surname" size="20"
   	    placeholder="Prenumele d-voastra" /> </p>
	<p><input type="submit" value="Trimite" 
        title="Apasati butonul pentru a expedia datele spre server" /> </p>
<?php
	}
?>
</form> 
</body>
</html>