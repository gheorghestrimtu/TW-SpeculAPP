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

The "old" version of the SELECT statement END*/

// SQLi-vulnerable code BEGIN											Gheorghe' --."' AND LAST_NAME = '".$surname."' "
echo ("SELECT FIRST_NAME, LAST_NAME, USER_ID FROM USERS WHERE FIRST_NAME = '".$name."' AND LAST_NAME = '".$surname."' ");
$stid = oci_parse($conn, "SELECT FIRST_NAME, LAST_NAME, USER_ID FROM USERS WHERE FIRST_NAME = '".$name."' AND LAST_NAME = '".$surname."' ");
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

$connected=false;
$row = oci_fetch_array($stid, OCI_NUM);if($row){
		$connected=true;
		$_SESSION["name"]=$row[0];
		$_SESSION["surname"]=$row[1];
		$_SESSION["uid"]=$row[2];
		$sti = oci_parse($conn, 'SELECT MAX(SESION_ID) FROM SESION ');
		if (!$sti) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Perform the logic of the query
		$re = oci_execute($sti);
		if (!$re) {
		$e = oci_error($sti);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$ro=oci_fetch_array($sti,OCI_NUM);
		$_SESSION["sesion"]=$ro[0]+1;
		print($ro[0].' '.$_SESSION["sesion"]);
		oci_free_statement($sti);
		$sti = oci_parse($conn, '
		BEGIN 
		manager_sesiune.insert_session(:newsesion, :myid);
		END;');
		$newSesionId=$_SESSION["sesion"];
		$id=$_SESSION["uid"];
		oci_bind_by_name($sti,':myid',$id);
		oci_bind_by_name($sti,':newsesion',$newSesionId);
		if (!$sti) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Perform the logic of the query
		$re = oci_execute($sti);
		if (!$re) {
		$e = oci_error($sti);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		oci_free_statement($sti);
		//following line of code is temporary
		$_SESSION["game"]=1;
	}

// End SQLi-vulnerable code



/* Begin SQLi-INvulnerable code

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
		$sti = oci_parse($conn, 'SELECT MAX(SESION_ID) FROM SESION ');
		if (!$sti) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Perform the logic of the query
		$re = oci_execute($sti);
		if (!$re) {
		$e = oci_error($sti);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		$ro=oci_fetch_array($sti,OCI_NUM);
		$_SESSION["sesion"]=$ro[0]+1;
		print($ro[0].' '.$_SESSION["sesion"]);
		oci_free_statement($sti);
		$sti = oci_parse($conn, 'begin manager_sesiune.insert_session(:newsesion,:myid); end;');
		$newSesionId=$_SESSION["sesion"];
		$id=$_SESSION["uid"];
		oci_bind_by_name($sti,':myid',$id);
		oci_bind_by_name($sti,':newsesion',$newSesionId);
		if (!$sti) {
			$e = oci_error($conn);
			trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}

		// Perform the logic of the query
		$re = oci_execute($sti);
		if (!$re) {
		$e = oci_error($sti);
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
		}
		oci_free_statement($sti);
		//following line of code is temporary
		$_SESSION["game"]=1;
	}
}*/

if($connected){
	header("Location: choice.html");
}else{
	header("Location: failure.html");
}
oci_free_statement($stid);
oci_close($conn);
?> 
   
