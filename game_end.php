<?php	
	session_start();
	$gameid=$_REQUEST["gameid"];
	$outcome=$_REQUEST["outcome"];
	try{
		$conn=oci_connect('speculapp','SPECULAPP','localhost/XE');
		if (!$conn) {
			$e = oci_error();
			throw new Exception;
		}
		// Prepare the statement
		$stid = oci_parse($conn, 'UPDATE GAME SET OUTCOME=:outcome WHERE GAME_ID=:gameid');
		if (!$stid) {
			$e = oci_error($conn);
			throw new Exception;
		}
		oci_bind_by_name($stid,':outcome',$outcome);
		oci_bind_by_name($stid,':gameid',$gameid);
		// Perform the logic of the query
		$r = oci_execute($stid);
		if (!$r) {
			$e = oci_error($stid);
			throw new Exception;
		}	
		oci_free_statement($stid);
	}catch(Exception $e){
	
	}
?>
	