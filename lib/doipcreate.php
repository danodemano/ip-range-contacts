<?php

//Start the sessions for preserving the data
session_start();

//Get the configs and connect to the database
require_once('dbconfig.php');
require_once('dbconnect.php');

//Require the IP address handling library
require_once('ip.lib.php');

//Get all the form data
if(get_magic_quotes_gpc()) {
	$ipaddress	= stripslashes($_POST['ip']);
	$cidr 		= stripslashes($_POST['cidr']);
	$company 	= stripslashes($_POST['company']);
} else {
	$ipaddress	= $_POST['ip'];
	$cidr 		= $_POST['cidr'];
	$company 	= $_POST['company'];
} //end if(get_magic_quotes_gpc()) {

//Check for valid CIDR
if ((is_null($cidr)) OR (!is_numeric($cidr)) OR (($cidr>64) OR ($cidr<0))) {
	//Invalid CIDR, redirect back to the create page
	//Make sure we save all the data into the session
	$_SESSION['ipaddress'] 	= $ipaddress;
	$_SESSION['cidr'] 	= $cidr;
	$_SESSION['company'] 	= $company;
	
	//Something is not right, redirect back to the create page
	require_once('lib/dbclose.php');
	header('Location: ../ipcreate.php?op=invalidcidr');
	exit;
} //end if ((is_null($cidr)) OR (!is_numeric($cidr)) OR (($cidr>64) OR ($cidr<0))) {

//Make sure company is not null
if (is_null($company)) {
	//Invalid company, redirect back to the create page
	//Make sure we save all the data into the session
	$_SESSION['ipaddress'] 	= $ipaddress;
	$_SESSION['cidr'] 	= $cidr;
	$_SESSION['company'] 	= $company;
	
	//Something is not right, redirect back to the create page
	require_once('lib/dbclose.php');
	header('Location: ../ipcreate.php?op=invalidcompany');
	exit;
} //end if ($company == '') {

//Let's validate the IP address
$validipv4 = filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
$validipv6 = filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
if ($validipv4) {
	//Valid IPv4 - proceed!
	
	//Create the new block and get the first and last IP addresses
	$block = new IPv4Block($ipaddress, $cidr);
	$first = $block->getFirstIp();
	$last  = $block->getLastIp();

	//Convert the first IP to integer
	$firstip  = new IPv4((string)$first);
	$firstint = $firstip->numeric();

	//Convert the last IP to integer
	$lastip  = new IPv4((string)$last);
	$lastint = $lastip->numeric();

	//SANATIZE ALL THE THINGS!!
	$firstint = mysqli_real_escape_string($conn, $firstint);
	$lastint  = mysqli_real_escape_string($conn, $lastint);
	$cidr	  = mysqli_real_escape_string($conn, $cidr);
	$company  = mysqli_real_escape_string($conn, $company);

	//Insert the IP information into the database
	$sql = "INSERT INTO `ip_ranges` (`start`, `end`, `cidr`, `company`, `ipv`) VALUES ('$firstint', '$lastint', '$cidr', '$company', '4');";
	mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . "<br>Line: ".__LINE__ ."<br>File: ".__FILE__);

	//We are done with the database connection at this point
	require_once('lib/dbclose.php');
} else if ($validipv6) {
	//Valid IPv6 - proceed!

	//Create the new block and get the first and last IP addresses
	$block = new IPv6Block($ipaddress, $cidr);
	$first = $block->getFirstIp();
	$last  = $block->getLastIp();

	//Convert the first IP to integer
	$firstip  = new IPv6((string)$first);
	$firstint = $firstip->numeric();

	//Convert the last IP to integer
	$lastip  = new IPv6((string)$last);
	$lastint = $lastip->numeric();

	//SANATIZE ALL THE THINGS!!
	$firstint = mysqli_real_escape_string($conn, $firstint);
	$lastint  = mysqli_real_escape_string($conn, $lastint);
	$cidr	  = mysqli_real_escape_string($conn, $cidr);
	$company  = mysqli_real_escape_string($conn, $company);

	//Insert the IP information into the database
	$sql = "INSERT INTO `ip_ranges` (`start`, `end`, `cidr`, `company`, `ipv`) VALUES ('$firstint', '$lastint', '$cidr', '$company', '6');";
	mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . "<br>Line: ".__LINE__ ."<br>File: ".__FILE__);

	//We are done with the database connection at this point
	require_once('lib/dbclose.php');
} else {
	//Not a valid IP address, redirect back with an error
	//Make sure we save all the data into the session
	$_SESSION['ipaddress'] 	= $ipaddress;
	$_SESSION['cidr'] 	= $cidr;
	$_SESSION['company'] 	= $company;
	
	//Something is not right, redirect back to the create page
	require_once('lib/dbclose.php');
	header('Location: ../ipcreate.php?op=invalidip');
	exit;
} //end if ($validipv4) {
?>