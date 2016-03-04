<?php

require_once('Functions.php');



// get the motor ID and put it into a variable
$sectionID = $_GET['section'];
// start the db connection
include 'Admin/db_conn.php';
// do the sql statment
$sql = "SELECT * FROM content WHERE conID='$sectionID'";
$queryresult = mysql_query($sql)
	or die(mysql_error());

while ($row = mysql_fetch_assoc($queryresult)) {
	$headertitle = $row['title'];
	$text = $row['text'];
	// insert the header
	echo makeHeader("$headertitle");
	// insert the navigation
	echo makeMenu();

	echo "<div id = \"maincontent\">";
	echo "".nl2br(htmlspecialchars_decode($text,ENT_QUOTES))."";
}
echo "</div>";
// close the table

// close the db connection
mysql_free_result($queryresult);
//mysql_close($conn);

echo makeFooter();

?>