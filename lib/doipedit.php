<?php
//Start the sessions for preserving the data
session_start();

//Get the configs and connect to the database
require_once('dbconfig.php');
require_once('dbconnect.php');

//Require the IP address handling library
require_once('ip.lib.php');

//The ID of the record to edit
$id = $_GET['id'];

//Get all the form data
if(get_magic_quotes_gpc()) {
	$network	= stripslashes($_POST['ip']);
	$cidr 		= stripslashes($_POST['cidr']);
	$company 	= stripslashes($_POST['company']);
	$notes	 	= stripslashes($_POST['notes']);
	$provider 	= stripslashes($_POST['provider']);
} else {
	$network	= $_POST['ip'];
	$cidr 		= $_POST['cidr'];
	$company 	= $_POST['company'];
	$notes	 	= $_POST['notes'];
	$provider 	= $_POST['provider'];
} //end if(get_magic_quotes_gpc()) {

//Make sure company is not empty
if (empty($company)) {
	//Invalid company, redirect back to the edit page
	//Make sure we save all the data into the session
	$_SESSION['company'] 	= $company;
	$_SESSION['notes'] 		= $notes;
	$_SESSION['provider'] 	= $provider;

	//Something is not right, redirect back to the create page
	require_once('dbclose.php');
	header("Location: ../ipedit.php?id=$id&op=invalidcompany");
	exit;
} //end if (empty($company)) {

//Insert the IP information into the database
$query = "UPDATE `ip_ranges` SET `company` = " . $db->quote($company) . ", `notes` = " . $db->quote($notes) . ", `provider` = " . $db->quote($provider) . " ".
		 "WHERE `id` = " . $db->quote($id) . " AND `cidr` = " . $db->quote($cidr) . ";";
$res = $db->query($query);
$res->closeCursor();

//We are done with the database connection at this point
require_once('dbclose.php');

//Stash all the session data and redirect to the done page
$_SESSION['network'] 	= $network;
$_SESSION['cidr'] 		= $cidr;
$_SESSION['company'] 	= $company;
$_SESSION['notes'] 		= $notes;
$_SESSION['provider'] 	= $provider;

//redirect to done
header('Location: ../done.php?op=ipedited');
exit;
?>
