<?php
function makeHeader($title) {

$headContent = <<<HEAD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>Plaster Perfect - $title </title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../style1.css" />
</head>
<body>
<div id="outerarea">
<div id="innerarea">
<div id = "header">
<img border="0" src="../images/banner.jpg">
</div>
HEAD;
	$headContent .="\n";
	return $headContent;
}

function makeMenu() {

	include 'db_conn.php';
	$sql = "SELECT * From content
	WHERE hide='0'
	ORDER BY ordernu";
	$queryresult = mysql_query($sql)
	or die(mysql_error());

	// start the table
	echo "<div id = \"navigation\">";
	echo "<table class=\"linkstbl\">";

	// fill the table
while ($row = mysql_fetch_assoc($queryresult)) {
	$title = $row['title'];
	$secID = $row['conID'];
echo "<tr><td class=\"links\"><a class=\"nav\" href = \"../show.php?section=$secID\">$title </a></td></tr>";

}
	echo "<tr><td class=\"links\"><hr></td></tr>";
	echo "<tr><td class=\"links\"><a class=\"nav\" href = \"index.php?showcontent=0&content=0\">Main Admin Page</a></td></tr>";
	echo "<tr><td class=\"links\"><a class=\"nav\" href = \"logout.php\">LogOut</a></td></tr>";
	echo "	<tr><td class=\"lastNav\"></td></tr>";
	echo "</table>";
	echo "</div>";
	// close the table

	// close the db connection
	mysql_free_result($queryresult);
	mysql_close($conn);
}

function makeFooter() {
	$footContent = <<< FOOT
	<div id = "footer">
	<p>All content copyright Plaster Perfect Co. 2010</p>
	</div>
	</div>
	</div>
	</body>
	</html>
FOOT;
	return $footContent;
}

function makeOrder($OrderSelected) {
	$Startnum=1;
	$limitnum= 10;
	// start the select box to add options
	$output = "<select name = \"Order\" id =\"Order\">";
	// foreach to fill the option list with the years range
	foreach (range($Startnum,$limitnum) as $NumAdd) {
		// check which one would be the selected option
		if ($OrderSelected == $NumAdd) {
			$output .= "<option selected=\"true\" value=\"$NumAdd\">$NumAdd</option>\n";
		}
		else{
			// add the options
			$output .= "<option value=\"$NumAdd\">$NumAdd</option>\n";
		}
	}
	// close the select box
	$output .="</select>";
	echo $output;
}

?>