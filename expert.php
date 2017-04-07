<?php 
if (!$_REQUEST["currency1"]||!$_REQUEST["currency2"]||!$_REQUEST["currency1sum"]) { 
	header("Location: failure.html");
} 

$currency1=$_REQUEST["currency1"];
$currency2=$_REQUEST["currency2"];
$currency1sum=$_REQUEST["currency1sum"];

echo "$currency1 $currency2 $currency1sum \n";

?>
