<?php
// ask for the functions from it's file
require 'login.php';
	require_once('AFunctions.php');

// insert the header
echo makeHeader("Add Username");
// insert the navigation
echo makeMenu();


// start the form with an empty text box to insert the new data
	echo "<div id = \"maincontent\">\n";
	echo "<form id = \"addUser\" action = \"\" method = \"post\">\n";
	echo "<table  class=\"plaster\">\n";
	echo "	<tr class=\"plaster\">\n";
	echo "	<td colspan=\"2\"> Add new user </td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "	<td>username</td>\n";
	echo "	<td><input type=\"text\" name=\"usernamePost\" id=\"usernamePost\"></td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "	<td>Password</td>\n";
	echo "	<td><input type=\"password\" name=\"passwordPost\" id=\"passwordPost\"></td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "	<td>retype Password</td>\n";
	echo "	<td><input type=\"password\" name=\"repasswordPost\" id=\"repasswordPost\"></td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "	<td>email</td>\n";
	echo "	<td><input type=\"text\" name=\"emailPost\" id=\"emailPost\"></td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "	<td colspan=\"2\"><input type=\"submit\" value=\"Add user\"></td>\n";
	echo "	</tr>\n";
	echo "</table>\n";
	echo "</form>\n";

// START valdate if the all required fields exicts!
if (isset($_POST['usernamePost']) && isset($_POST['passwordPost'])) {
	if (($_POST['passwordPost']) == trim($_POST['repasswordPost'])) {
		// filling the fields into a variables
		$usern = trim($_POST['usernamePost']);
		$passw = trim($_POST['passwordPost']);
		$emaila = trim($_POST['emailPost']);

			// START valdate if all required fields are not empty
			if ($usern != "" && $passw != "" && $emaila != "") {


				//start connection
				include 'db_conn.php';


				$sql1 = "SELECT * FROM user";
				$queryresult1 = mysql_query($sql1)
					or die(mysql_error());
					while ($row1 = mysql_fetch_assoc($queryresult1)) {
					$userdb = $row1['username'];
					$emaildb = $row1['email'];

					if ($userdb != $usern && $emaildb != $emaila) {
						//inserting the VALID data into databease
						$sql = "INSERT INTO user (username, password, email)
									values ('$usern','$passw', '$emaila')";
						mysql_query($sql) or die (mysql_error());

						// displaying the inserted data as a confirmation

						echo "<div id = \"maincontent\">\n";
						echo "<table class=\"plaster\">\n";
						echo "	<tr class=\"plaster\">\n";
						echo "	<td colspan=\"2\"> The following username successfully added! </td>\n";
						echo "	</tr>\n";
						echo "	<tr>\n";
						echo "	<td>username</td>\n";
						echo "	<td><strong>$usern</strong></td>\n";
						echo "	</tr>\n";
						echo "	<tr>\n";
						echo "	<td>password</td>\n";
						echo "	<td><strong>$passw</strong></td>\n";
						echo "	</tr>\n";
						echo "	<tr>\n";
						echo "	<td>email</td>\n";
						echo "	<td><strong>$emaila</strong></td>\n";
						echo "	</tr>\n";
						echo "</table>\n";
						echo "</div>\n";
						// end displaying data

						echo "<p><a href=\"index.php?showcontent=0&content=0\">back to Modify page</a></p>\n";


						mysql_close($conn);
						// close database connection
					die ("please fill all the required fields");
					}
				}
				die ("username or email had been already in database");
			}
		die("<p>You have not entered all of the required fields</p>\n");
	}
	die ("Type the same passwords");
}


echo "</div>";

// making footer
echo makeFooter();

?>