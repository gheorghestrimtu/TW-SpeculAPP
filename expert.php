<?php 
session_start();
if (!$_REQUEST["currency1"]||!$_REQUEST["currency2"]||!$_REQUEST["currency1sum"]) { 
	header("Location: failure.html");
} 

$currency1=$_REQUEST["currency1"];
$currency2=$_REQUEST["currency2"];
$currency1sum=$_REQUEST["currency1sum"];

echo "$currency1 $currency2 $currency1sum \n";

$conn = oci_connect('speculapp', 'SPECULAPP', 'localhost/XE');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$currsti=oci_parse($conn,"SELECT CURR_ID FROM CURRENCY WHERE TRIGRAMM='".$currency1."' ");
if(!$currsti){
	$e=oci_error($conn);
	trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
$currstir=oci_execute($currsti);
if(!$currstir){
	$e=oci_error($currsti);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$ro=oci_fetch_array($currsti,OCI_NUM);
$currId1=$ro[0];

$currsti=oci_parse($conn,"SELECT CURR_ID FROM CURRENCY WHERE TRIGRAMM='".$currency2."' ");
if(!$currsti){
	$e=oci_error($conn);
	trigger_error(htmlentities($e['message'],ENT_QUOTES),E_USER_ERROR);
}
$currstir=oci_execute($currsti);
if(!$currstir){
	$e=oci_error($currsti);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$ro=oci_fetch_array($currsti,OCI_NUM);
$currId2=$ro[0];

$sti = oci_parse($conn, 'SELECT MAX(TRANSACTION_ID) FROM TRANSACTION');
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
$newTransactionId=$ro[0]+1;

$stid2 = oci_parse($conn, "INSERT INTO TRANSACTION VALUES (:newtransaction, :sesionid, :gameid,:myid,:currid1,:currid2,".$currency1sum.",".$currency1sum.",SYSDATE) ");
$id = $_SESSION["uid"];
$sessionId=$_SESSION["sesion"];
$gameId=$_SESSION["game"];
oci_bind_by_name($stid2, ':myid', $id);
oci_bind_by_name($stid2, ':newtransaction', $newTransactionId);
oci_bind_by_name($stid2, ':sesionid', $sessionId);
oci_bind_by_name($stid2, ':gameid', $gameId);
oci_bind_by_name($stid2, ':currid1', $currId1);
oci_bind_by_name($stid2, ':currid2', $currId2);
if (!$stid2) {
    $e = oci_error($conn);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Perform the logic of the query
$r2 = oci_execute($stid2);
if (!$r2) {
    $e = oci_error($stid2);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}


oci_free_statement($sti);
oci_free_statement($stid2);

oci_close($conn);

?>
