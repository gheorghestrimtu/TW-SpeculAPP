<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
$conn = oci_connect('speculapp', 'SPECULAPP', 'localhost/XE');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$p = $_SESSION["uid"];
$name=$_SESSION["name"];
$surname=$_SESSION["surname"];

$stid = oci_parse($conn, 'begin :r := number_of_sessions(:p); end;');
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
print "<table border='1'>\n";
while ($row = oci_fetch_array($stid2, OCI_ASSOC+OCI_RETURN_NULLS)) {
    print "<tr>\n";
    foreach ($row as $item) {
        print "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    print "</tr>\n";
}
print "</table>\n";

oci_free_statement($stid2);

oci_close($conn);
?>

</body>
</html>