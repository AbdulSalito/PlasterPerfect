<?php
// ask for the functions from it's file

require 'login.php';

require_once('AFunctions.php');
// insert the header
echo makeHeader("Admin");
// insert the navigation
echo makeMenu();

$showcontent = $_GET['showcontent'];
$contentID = $_GET['content'];
if ($showcontent == "1") {
	//start connection
	include 'db_conn.php';
	//updating data into databease
	$sql = "UPDATE content SET hide='0' WHERE conID='$contentID'";
	mysql_query($sql) or die (mysql_error());
	mysql_close($conn);
	// close database connection
}
elseif ($showcontent == "0") {
	//start connection
	include 'db_conn.php';
	//updating data into databease
	$sql = "UPDATE content SET hide='1' WHERE conID='$contentID'";
	mysql_query($sql) or die (mysql_error());
	mysql_close($conn);
	// close database connection
}

// start the form with an empty text box to insert the new data
echo "<div id = \"maincontent\">\n";
echo "<table  class=\"plaster\">\n";
echo "	<tr class=\"plaster\">\n";
echo "	<td colspan=\"4\"> modify website content </td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "	<td colspan=\"4\"><a href = \"addContent.php\">Add new content</a></td>\n";
echo "	</tr>\n";

include 'db_conn.php';
$sql = "SELECT * FROM content ORDER BY ordernu";
$queryresult = mysql_query($sql)
			or die(mysql_error());

// fill the table
while ($row = mysql_fetch_assoc($queryresult)) {
	$title = $row['title'];
	$secID = $row['conID'];
	$order = $row['ordernu'];
	$hide = $row['hide'];

	echo "<tr><td>$order</td>\n";
	echo "<td>$title</td>\n";
	echo "<td><a href = \"editContent.php?confirm=start&content=$secID\">Edit</a></td>\n";
	if ($hide == "1") {
		echo "<td><a href = \"index.php?content=$secID&showcontent=1 \">Show</a></td></tr>\n";
	}
	elseif ($hide == "0")
	echo "<td><a href = \"index.php?content=$secID&showcontent=0\">Hide</a></td></tr>\n";
	//
}

// close the db connection
mysql_free_result($queryresult);
mysql_close($conn);


echo "</table>\n";


echo "<hr>\n";
echo "<table  class=\"plaster\">\n";
echo "	<tr class=\"plaster\">\n";
echo "	<td colspan=\"4\"> modify username </td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "	<td colspan=\"4\"><a href = \"addUser.php\">Add new Username</a></td>\n";
echo "	</tr>\n";

include 'db_conn.php';
$sqlusr = "SELECT * FROM user";
$queryresultusr = mysql_query($sqlusr)
			or die(mysql_error());

// fill the table
while ($rowusr = mysql_fetch_assoc($queryresultusr)) {
	$username = $rowusr['username'];
	$email = $rowusr['email'];
	$userID = $rowusr['userID'];

	echo "<tr><td>$userID</td>\n";
	echo "<td>$username</td>\n";
	echo "<td>$email</td>\n";
	echo "<td><a href = \"editUser.php?user=$userID\">Edit</a></td></tr>\n";
}

// close the db connection
mysql_free_result($queryresultusr);
mysql_close($conn);


echo "</table>\n";
echo "</div>";



// making footer
echo makeFooter();

?>