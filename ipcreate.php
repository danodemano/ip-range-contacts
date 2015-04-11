<?php
//Get the configs and connect to the database
require_once('lib/dbconfig.php');
require_once('lib/dbconnect.php');
?>
<html>
<head>
<title>IP Address Contacts - Create Network</title>
</head>
<body>

<form action='lib/doipcreate.php'>
	<table>
		<tr>
			<td>IP&nbsp;Address:&nbsp;</td>
			<td><input type="text" name="ip" id="ip" length="50"></td>
		</tr>
		<tr>
			<td>CIDR:&nbsp;</td>
			<td><input type="text" name="cidr" id="cidr" length="50"></td>
		</tr>
		<tr>
			<td>Company:&nbsp;</td>
			<td><input type="text" name="company" id="company" length="50"></td>
		</tr>
		<tr>
			<td><input type="submit" value="Submit"></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
<?
//Close the database connection
require_once('lib/dbclose.php');
?>
