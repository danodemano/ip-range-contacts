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

//Let's validate the IP address
$validipv4 = filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
$validipv6 = filter_var($ipaddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
if ($validipv4) {
	//Valid IPv4 - proceed!
} else if ($validipv6) {
	//Valid IPv6 - proceed!
} else {
	//Not a valid IP address, redirect back with an error
	//Make sure we save all the data into the session
	$_SESSION['ipaddress'] 	= $ipaddress;
	$_SESSION['cidr'] 	= $cidr;
	$_SESSION['company'] 	= $company;
	
	//Something is not right, redirect back to the create page
	header('Location: ../ipcreate.php?op=invalidip');
	exit;
} //end if ($validipv4) {
?>
