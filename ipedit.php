<?php
//Get the configs and connect to the database
require_once('lib/dbconfig.php');
require_once('lib/dbconnect.php');

//Require the IP address handling library
require_once('lib/ip.lib.php');

//Require the main functions files
require_once('lib/functions.php');

//Get the ID for the record
$id = $_GET['id'];

//For redirecting back regardless of filename
$self = $_SERVER['PHP_SELF'];

//Get the op variable
@$op = $_GET['op'];

//Start the session, restarting it if the op isn't set
session_start();
if ($op=='') {
	session_destroy();
	session_start();
}else{
	//Get the session data
	$ipaddress	= $_SESSION['ipaddress'];
	$cidr 		= $_SESSION['cidr'];
	$company 	= $_SESSION['company'];
	$notes		= $_SESSION['notes'];
	$provider	= $_SESSION['provider'];
} //if ($op<>'') {

?>
<html>
<head>
<title>IP Address Contacts - Create Network</title>
</head>
<body>
<h2>Use this form to enter in a new IP range and company</h2>
<form method="post" action='lib/doipcreate.php'>
	<table>
		<tr>
			<td>IP&nbsp;Address:&nbsp;</td>
			<td><input type="text" name="ip" id="ip" length="50" <?php if (!empty($ipaddress)) { echo 'value='.$ipaddress; }?>></td>
		</tr>
		<tr>
			<td>CIDR:&nbsp;</td>
			<td><input type="text" name="cidr" id="cidr" length="50" <?php if (!empty($cidr)) { echo 'value='.$cidr; }?>></td>
		</tr>
		<tr>
			<td>Company:&nbsp;</td>
			<td><input type="text" name="company" id="company" length="50" <?php if (!empty($company)) { echo 'value='.$company; }?>></td>
		</tr>
		<tr>
			<td>Notes:&nbsp;</td>
			<td><input type="text" name="notes" id="notes" length="50" <?php if (!empty($notes)) { echo 'value='.$notes; }?>></td>
		</tr>
		<tr>
			<td>Provider:&nbsp;</td>
			<td><input type="text" name="provider" id="provider" length="50" <?php if (!empty($provider)) { echo 'value='.$provider; }?>></td>
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
<a href="index.php">Return to the main page</a>
</body>
</html>