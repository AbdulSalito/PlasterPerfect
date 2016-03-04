<?php
function makeHeader($title) {

$headContent = <<<HEAD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<title>Plaster Perfect - $title </title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="style1.css" />
</head>
<body>
<div id="outerarea">
<div id="innerarea">
<div id = "header">
<img border="0" src="images/banner.jpg">
</div>
HEAD;
	$headContent .="\n";
	return $headContent;
}

function makeMenu() {

	include 'Admin/db_conn.php';
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
echo "<tr><td class=\"links\"><a class=\"nav\" href = \"show.php?section=$secID\">$title </a></td></tr>";

}
	echo "	<tr><td class=\"lastNav\"></td></tr>";
	echo "</table>";
	echo "</div>";
	// close the table

	// close the db connection
	mysql_free_result($queryresult);
	mysql_close($conn);
}

function makeMainArea($mainHeading, $subtitle, $contentText ) {
$mainContent = <<<MAINAREA
<div id = "maincontent">
<h2>$mainHeading </h2>
<h3>$subtitle </h3>
<p>$contentText </p>
</div>
MAINAREA;
	$mainContent .= "\n";
	return $mainContent;
}

function makePar($Par) {
	$pargraph = <<<Parg
<div id = "maincontent">
<p>$Par </p>
</div>
Parg;
	$pargraph .= "\n";
	return $pargraph;
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

?>