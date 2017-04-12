<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sessions</title>
	<link rel="stylesheet" type="text/css" href="navmenu.css" />
	<link rel="stylesheet" href="http://tablesorter.com/docs/css/jq.css" type="text/css" media="print, projection, screen" />
	<link rel="stylesheet" href="http://tablesorter.com/themes/blue/style.css" type="text/css" media="print, projection, screen" />
	<script type="text/javascript" src="http://tablesorter.com/jquery-latest.js"></script>
	<script type="text/javascript" src="http://tablesorter.com/__jquery.tablesorter.js"></script>
	<script type="text/javascript" src="http://tablesorter.com/addons/pager/jquery.tablesorter.pager.js"></script>
	<script type="text/javascript" src="http://tablesorter.com/docs/js/chili/chili-1.8b.js"></script>
	<script type="text/javascript" src="http://tablesorter.com/docs/js/docs.js"></script>
	<script type="text/javascript">
	$(function() {
		$("#myTable")
			.tablesorter({widthFixed: true, widgets: ['zebra']})
			.tablesorterPager({container: $("#pager")});
	});
	</script>
	<link rel="stylesheet" type="text/css" href="http://tablesorter.com/docs/js/chili/javascript.css">
</head>
<body>
<nav>
<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="contact.php">Contact</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="jsandformual.html">Login</a></li>
  <li><a href="signup.php">Signup</a></li>
</ul>
</nav>
<section id="deletesessionbutton">
<form action="deletesession.php">
	<label for="delete">Delete Session No.</label><br>
	<input type="text" id="delete" name="delete" ><br>
	<input type="submit" value="Submit">
</form>
</section>

<?php
$conn = oci_connect('speculapp', 'SPECULAPP', 'localhost/XE');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$p = $_SESSION["uid"];
$name=$_SESSION["name"];
$surname=$_SESSION["surname"];

$stid = oci_parse($conn, 'begin :r := manager_sesiune.number_of_sessions(:p); end;');
oci_bind_by_name($stid, ':p', $p);
oci_bind_by_name($stid, ':r', $r, 40);

oci_execute($stid);

print "<p>Number of sessions for user: $name $surname: $r </p>";   // prints 24

oci_free_statement($stid);

$stid2 = oci_parse($conn, 'SELECT * FROM SESION WHERE USER_ID=:myid');
$id = $_SESSION["uid"];
oci_bind_by_name($stid2, ':myid', $id);
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

// Fetch the results of the query
print('<section id="sessiontable">');
print('<table id="myTable" class="tablesorter" border="1">');
print('<thead><tr><th>Session ID</th><th>User ID</th><th>Start time</th><th>End time</th></thead>');
print('<tbody>');
while ($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print "<tr>\n";
    foreach ($row as $item) {
        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    print "</tr>\n";
}
print('</tbody>');
print "</table>";
print('</section>');

oci_free_statement($stid2);

oci_close($conn);
?>

<div id="pager" class="pager">
	<form>
		<img src="http://tablesorter.com/addons/pager/icons/first.png" class="first"/>
		<img src="http://tablesorter.com/addons/pager/icons/prev.png" class="prev"/>
		<input type="text" class="pagedisplay"/>
		<img src="http://tablesorter.com/addons/pager/icons/next.png" class="next"/>
		<img src="http://tablesorter.com/addons/pager/icons/last.png" class="last"/>
		<select class="pagesize">
			<option selected="selected"  value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option  value="40">40</option>
		</select>
	</form>
</div>

</div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
_uacct = "UA-2189649-2";
urchinTracker();
</script>
</body>
</html>