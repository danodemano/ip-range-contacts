<?php
//Get the op variable
@$op = $_GET['op'];

//Start the session
session_start();

//If the op is null this page was likely accessed directly
//Kill the session, print and error and die
if ($op=='') {
	session_destroy();
	die('This page is not meant to be accessed directly.  Please <a href="index.php">click here</a> to return home.');
}else if ($op='ipadded') {
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

	//Trash the session since we no longer need it
	session_destroy();
?>
<html>
<head>
<title>IP Address Contacts - Network Created!</title>
</head>
<body>
<font color="green"><b>The IP block has been created!</b></font><br><br>
Details follow:<br><br>
Network: <b><?php echo $network; ?></b><br>
Broadcast: <b><?php echo $broadcast; ?></b><br>
Total addresses: <b><?php echo $total; ?></b><br>
CIDR: <b><?php echo $cidr; ?></b><br>
Company: <b><?php echo $company; ?></b><br>
<br>
<br>
<br>
Please <a href="index.php">click here</a> to return to the home page.
<?php
} //if ($op<>'') {
?>
