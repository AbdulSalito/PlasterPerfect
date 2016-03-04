<?php
require 'login.php';
require_once('AFunctions.php');

echo makeHeader("Edit Sections");
echo makeMenu();

$confirmation = $_GET['confirm'];

if ($confirmation == "yes") {
	echo "<div id = \"maincontent\">";

if (isset($_POST['titleE']) && isset($_POST['textE'])) {

	// filling the fields into a variables
	$contentID = $_POST['contentE'];
	$order = $_POST['Order'];
	$title = trim($_POST['titleE']);
	$text = trim($_POST['textE']);
	$pic = trim($_POST['picE']);

	// START valdate if all required fields are not empty
	if ($title != "" && $text != "" ) {

		// changing the special characters to be inserted safely into database
		$textHtmlSpeChar = htmlspecialchars($text,ENT_QUOTES);

		//start connection
		include 'db_conn.php';

		//inserting the VALID data into databease

		$sql = "UPDATE content SET title='$title', text='$textHtmlSpeChar', picture='$pic', ordernu='$order' WHERE conID='$contentID'";
		mysql_query($sql) or die (mysql_error());

		// displaying the inserted data as a confirmation

		echo "<table class=\"plaster\">\n";
		echo "	<tr class=\"plaster\">\n";
		echo "	<td colspan=\"2\"> The following content successfully Edited! </td>\n";
		echo "	</tr>\n";
		echo "	<tr>\n";
		echo "	<td>Title</td>\n";
		echo "	<td><strong>$title</strong></td>\n";
		echo "	</tr>\n";
		echo "	<tr>\n";
		echo "	<td>Text</td>\n";
		echo "	<td><strong>".nl2br($text)."</strong></td>\n";
		echo "	</tr>\n";
		echo "	<tr>\n";
		echo "	<td>Picture</td>\n";
		echo "	<td><img border=\"0\" src=\"images/$pic\"></td>\n";
		echo "	</tr>\n";
		echo "</table>\n";
		// end displaying data

		echo "<p><a href=\"index.php?showcontent=0&content=0\">back to modify Content</a></p>\n";


		mysql_close($conn);
		// close database connection
	}
	else {echo "<p>You have not entered all of the required fields</p>\n";}
	// END checking the lengths of the fields


}
else {
	echo "<p>You have not entered all of the required fields</p>\n";}
	echo "</div>";
}
else {

$contID = $_GET['content'];

	include 'db_conn.php';

	$sql = "SELECT * FROM content WHERE conID='$contID'";
	$queryresult = mysql_query($sql)
	or die(mysql_error());

	while ($row = mysql_fetch_assoc($queryresult)) {
	$con = $row['conID'];
	$title = $row['title'];
	$text = $row['text'];
	$pic = $row['Picture'];
	$order = $row['ordernu'];


		echo "<div id = \"maincontent\">\n";
		echo "<form id = \"addContent\" action = \"editContent.php?confirm=yes\" method = \"post\">\n";
		echo "<table  class=\"plaster\">\n";
		echo "	<tr class=\"plaster\">\n";
		echo "	<td colspan=\"2\"> Edit content </td>\n";
		echo "	</tr>\n";
		echo "	<tr>\n";
		echo "	<td>ID</td>\n";
		echo "	<td><input type=\"text\" name=\"contentE\" id=\"contentE\" readonly=\"true\" value=\"$con\"></td>\n";
		echo "	</tr>\n";
		echo "	<tr>\n";
		echo "	<td>Order</td>\n";
		echo "<td>";
		echo makeOrder($order);
		echo "</td></tr>\n";
		echo "	<tr>\n";
		echo "	<td>Title</td>\n";
		echo "	<td><input type=\"text\" name=\"titleE\" id=\"titleE\" value=\"$title\"></td>\n";
		echo "	</tr>\n";
		echo "	<tr>\n";
		echo "	<td>Text</td>\n";
		echo "	<td><textarea rows=\"10\" cols=\"50\" width=\"100%\" type=\"text\" name=\"textE\" id=\"textE\">$text</textarea></td>\n";
		echo "	</tr>\n";
		echo "	<tr>\n";
		echo "	<td>Picture</td>\n";
		echo "	<td><input type=\"text\" name=\"picE\" id=\"picE\" value=\"$pic\"></td>\n";
		echo "	</tr>\n";
		echo "	<tr>\n";
		echo "	<td colspan=\"2\"><input type=\"submit\" value=\"Edit content\"></td>\n";
		echo "	</tr>\n";
		echo "</table>\n";
		echo "</form>\n";
		echo "</div>";	}
}
echo makeFooter();

?>