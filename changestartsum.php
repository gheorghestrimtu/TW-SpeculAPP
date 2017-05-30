<?php
	session_start();
	$startsum=$_REQUEST["delete"];
	if(!is_numeric($startsum)||$startsum<0){
		header('Location: change_stuff.php');
	}
	try{
		$conn=oci_connect('speculapp','SPECULAPP','localhost/XE');
		if (!$conn) {
			$e = oci_error();
			throw new Exception;
		}
		// Prepare the statement
		$stid = oci_parse($conn, 'UPDATE SETTINGS SET START_SUM=:startsum');
		if (!$stid) {
			$e = oci_error($conn);
			throw new Exception;
		}
		oci_bind_by_name($stid,':startsum',$startsum);
		// Perform the logic of the query
		$r = oci_execute($stid);
		if (!$r) {
			$e = oci_error($stid);
			throw new Exception;
		}
		oci_free_statement($stid);
	}catch(Exception $e){
		header("Location: change_stuff.php");
	}		
	header("Location: change_stuff.php");
?>