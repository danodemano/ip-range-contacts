<?php
//Get the op variable
@$op = $_GET['op'];

//Start the session
session_start();
?>
<html>
<head>
<title>IP Address Contacts - Network Created!</title>
<link rel=stylesheet type="text/css" href="style.css">
</head>
<body>
<?php
//If the op is null this page was likely accessed directly
//Kill the session, print an error and die
if ($op=='') {
	session_destroy();
	die('This page is not meant to be accessed directly.  Please <a href="index.php">click here</a> to return home.');
}else if ($op=='ipadded') {
	//Make sure this page wasn't refreshed
	if (empty($_SESSION['network'])) {
		die("Don't do that.  ".'Please <a href="index.php">click here</a> to return home.');
	} //end if (empty($_SESSION['network'])) {

	//Get the session data
	$network	= $_SESSION['network'];
	$broadcast	= $_SESSION['broadcast'];
	$total		= $_SESSION['total'];
	$cidr 		= $_SESSION['cidr'];
	$company 	= $_SESSION['company'];
	$notes		= $_SESSION['notes'];
	$provider	= $_SESSION['provider'];

	//Trash the session since we no longer need it
	session_destroy();
?>
<p class="success">The IP block has been created!</p>
Details follow:<br><br>
Network: <b><?php echo $network; ?></b><br>
Broadcast: <b><?php echo $broadcast; ?></b><br>
Total addresses: <b><?php echo $total; ?></b><br>
CIDR: <b><?php echo $cidr; ?></b><br>
Company: <b><?php echo $company; ?></b><br>
Notes: <b><?php echo $notes; ?></b><br>
Provider: <b><?php echo $provider; ?></b><br>
<?php
}else if ($op=='ipedited') {
	//Make sure this page wasn't refreshed
	if (empty($_SESSION['network'])) {
		die("Don't do that.  ".'Please <a href="index.php">click here</a> to return home.');
	} //end if (empty($_SESSION['network'])) {

	//Get the session data
	$network	= $_SESSION['network'];
	$cidr 		= $_SESSION['cidr'];
	$company 	= $_SESSION['company'];
	$notes		= $_SESSION['notes'];
	$provider	= $_SESSION['provider'];

	//Trash the session since we no longer need it
	session_destroy();
?>
<p class="success">The IP block has been edited!</p>
Details follow:<br><br>
Network: <b><?php echo $network; ?></b><br>
CIDR: <b><?php echo $cidr; ?></b><br>
Company: <b><?php echo $company; ?></b><br>
Notes: <b><?php echo $notes; ?></b><br>
Provider: <b><?php echo $provider; ?></b><br>
<?php
} else if ($op=='delete') {
	//Trash the session since we no longer need it
	session_destroy();
?>
<html>
<head>
<title>IP Address Contacts - Network Deleted!</title>
</head>
<body>
<p class="success">The IP block has been Deleted!</p>
<?php
} //if ($op<>'') {
?>
<br>
<br>
<br>
Please <a href="index.php">click here</a> to return to the home page.
