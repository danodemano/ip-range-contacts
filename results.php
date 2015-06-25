<?php
//Get the op variable
@$op = $_GET['op'];

//Start the session
session_start();

if ($op=='') {
	session_destroy();
	die('This page is not meant to be accessed directly.  Please <a href="index.php">click here</a> to return home.');
} //end if ($op=='') {
?>
<html>
<head>
<title>IP Address Contacts - Search Results</title>
<link rel=stylesheet type="text/css" href="style.css">
</head>
<body>
<h2>Search Results:</h2>
<?php
if ($op == 'blank') {
?>
<p class="error">You did not enter a search term, please try again!</p>
<?php
} else if ($op == 'notfound') {
?>
<p class="error">No results were found, please try again!</p>
<?php
$term = $_SESSION['term'];
//Destroy the session
session_destroy();
echo "<br>";
echo "You searched for: $term";
} else {
//Get the IP blocks from the session data
$results = $_SESSION['results'];
$term = $_SESSION['term'];

//Destroy the session
session_destroy();

echo $results;
echo "<br>";
echo "You searched for: $term";
} //end if ($op == 'blank') {
?>
<br>
<br>
<br>
<h2>Search again:</h2>
<form method="post" action='lib/doipsearch.php'>
	<table>
		<tr>
			<td>Search&nbsp;Term:&nbsp;</td>
			<td><input type="text" name="search" id="search" length="80"></td>
		</tr>
		<tr>
			<td><input type="submit" value="Submit"></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
<br>
<br>
<br>
Please <a href="index.php">click here</a> to return to the home page.
</body>
</html>
