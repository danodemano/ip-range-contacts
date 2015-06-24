<?php
//Get the configs and connect to the database
require_once('lib/dbconfig.php');
require_once('lib/dbconnect.php');

//Require the IP address handling library
require_once('lib/ip.lib.php');

//Require the main functions files
require_once('lib/functions.php');
?>

<html>
<head>
<title>IP Address Contacts - Home</title>
<link rel=stylesheet type="text/css" href="style.css">
</head>
<body>
<h2>Navigation Links:</h2>
<a href="ipcreate.php">Create new IP block</a><br>
<h2>Search for IP range (Company or Address):</h2>
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
<h2>Current IP Blocks:</h2>
<?php
//Echo out all the IP blocks
$ip_blocks = all_blocks($db);
echo $ip_blocks;

//Close the database connection
require_once('lib/dbclose.php');
?>
</body>
</html>
