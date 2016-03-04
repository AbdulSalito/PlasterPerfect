<?php
// ask for the functions from it's file
require 'login.php';
	require_once('AFunctions.php');

// insert the header
echo makeHeader("Add Content");
// insert the navigation
echo makeMenu();


// start the form with an empty text box to insert the new data
	echo "<div id = \"maincontent\">\n";
	echo "<form id = \"addContent\" action = \"\" method = \"post\">\n";
	echo "<table  class=\"plaster\">\n";
	echo "	<tr class=\"plaster\">\n";
	echo "	<td colspan=\"2\"> Add new content </td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "	<td>Title</td>\n";
	echo "	<td><input type=\"text\" name=\"titlePost\" id=\"titlePost\"></td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "	<td>Text</td>\n";
	echo "	<td><textarea rows=\"10\" width=\"100%\" type=\"text\" name=\"textPost\" id=\"textPost\"></textarea></td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "	<td>Picture</td>\n";
	echo "	<td><input type=\"text\" name=\"picPost\" id=\"picPost\"></td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "	<td colspan=\"2\"><input type=\"submit\" value=\"Add content\"></td>\n";
	echo "	</tr>\n";
	echo "</table>\n";
	echo "</form>\n";

// START valdate if the all required fields exicts!
if (isset($_POST['titlePost']) && isset($_POST['textPost'])) {
	// filling the fields into a variables
	$title = trim($_POST['titlePost']);
	$text = trim($_POST['textPost']);
	$pic = trim($_POST['picPost']);

	// START valdate if all required fields are not empty
	if ($title != "" && $text != "" ) {

		// changing the special characters to be inserted safely into database
		$textHtmlSpeChar = htmlspecialchars($text,ENT_QUOTES);

		//start connection
		include 'db_conn.php';


		$sql1 = "SELECT * FROM content ORDER BY ordernu";
		$queryresult1 = mysql_query($sql1)
			or die(mysql_error());
		$orderdb = mysql_numrows($queryresult1) + 1;
		//inserting the VALID data into databease
		$sql = "INSERT INTO content (title, text, picture, ordernu, hide)
							values ('$title','$textHtmlSpeChar', '$pic','$orderdb','1')";
		mysql_query($sql) or die (mysql_error());

		// displaying the inserted data as a confirmation

		echo "<div id = \"maincontent\">\n";
		echo "<table class=\"plaster\">\n";
		echo "	<tr class=\"plaster\">\n";
		echo "	<td colspan=\"2\"> The following content successfully added! </td>\n";
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
		echo "</div>\n";
		// end displaying data

		echo "<p><a href=\"index.php?showcontent=0&content=0\">back to Modify page</a></p>\n";


		mysql_close($conn);
		// close database connection
		die("<p>You have not entered all of the required fields</p>\n");
	}
	die("<p>You have not entered all of the required fields</p>\n");
}


echo "</div>";

// making footer
echo makeFooter();

?>