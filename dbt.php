<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<body>
<?php
if (!$_REQUEST["name"]||!$_REQUEST["surname"]) { 
	header("Location: failure.html");
} 
$name = $_REQUEST["name"];
$surname=$_REQUEST["surname"];
$conn = oci_connect('speculapp', 'SPECULAPP', 'localhost/XE');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Prepare the statement
$stid = oci_parse($conn, 'SELECT FIRST_NAME, LAST_NAME, USER_ID FROM USERS');
if (!$stid) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r = oci_execute($stid);
if (!$r) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Fetch the results of the query
$connected=false;
while ($row = oci_fetch_array($stid, OCI_NUM)) {
    if($row[0]==$name&&$row[1]==$surname){
		$connected=true;
		$_SESSION["name"]=$row[0];
		$_SESSION["surname"]=$row[1];
		$_SESSION["uid"]=$row[2];
	}
}

if($connected){
	header("Location: choice.html");
}else{
	header("Location: failure.html");
}
oci_free_statement($stid);
oci_close($conn);
?> 
   
