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

//Get the record for that ID
$record = block_details($id, $db);

//Close the database connection
require_once('lib/dbclose.php');

//Start the session, restarting it if the op isn't set
session_start();
if ($op=='') {
	session_destroy();
	session_start();
}else{
	//Get the session data
	$company 	= $_SESSION['company'];
	$notes		= $_SESSION['notes'];
	$provider	= $_SESSION['provider'];
} //if ($op<>'') {

?>
<html>
<head>
<title>IP Address Contacts - Edit Network</title>
<link rel=stylesheet type="text/css" href="style.css">
</head>
<body>
<?php
if ($record <> false) {
//Valid ID - continue to display the information
?>
<h2>Use this form to edit the company/notes/provider for an IP block</h2>
<p class="error">(NOTE: You cannot edit the network and CIDR.  If these need changed you will have to delete then recreate the network!)</p>
<?php
if ($op == 'invalidcompany') {
	echo '<p class="error">You did not enter a valid company, please correct it and try again</p>';
} //end if ($op == 'invalidcompany') {
?>
<form method="post" action='lib/doipedit.php?id=<?php echo $id;?>'>
	<table>
		<tr>
			<td>Network&nbsp;Address:&nbsp;</td>
			<td><input type="text" name="ip" id="ip" length="50" <?php echo 'value="'.$record['network'].'"'; ?> readonly ></td>
		</tr>
		<tr>
			<td>CIDR:&nbsp;</td>
			<td><input type="text" name="cidr" id="cidr" length="50"  <?php echo 'value="'.$record['cidr'].'"'; ?> readonly ></td>
		</tr>
		<?php if ($op=='') {
		?>
		<tr>
			<td>Company:&nbsp;</td>
			<td><input type="text" name="company" id="company" length="50" <?php echo 'value="'.$record['company'].'"'; ?>></td>
		</tr>
		<tr>
			<td>Notes:&nbsp;</td>
			<td><input type="text" name="notes" id="notes" length="50" <?php echo 'value="'.$record['notes'].'"'; ?>></td>
		</tr>
		<tr>
			<td>Provider:&nbsp;</td>
			<td><input type="text" name="provider" id="provider" length="50" <?php echo 'value="'.$record['provider'].'"'; ?>></td>
		</tr>
		<?php
		}else{
		?>
		<tr>
			<td>Company:&nbsp;</td>
			<td><input type="text" name="company" id="company" length="50" <?php if (!empty($company)) { echo 'value="'.$company . '"'; }?>></td>
		</tr>
		<tr>
			<td>Notes:&nbsp;</td>
			<td><input type="text" name="notes" id="notes" length="50" <?php if (!empty($notes)) { echo 'value="'.$notes . '"'; }?>></td>
		</tr>
		<tr>
			<td>Provider:&nbsp;</td>
			<td><input type="text" name="provider" id="provider" length="50" <?php if (!empty($provider)) { echo 'value="'.$provider . '"'; }?>></td>
		</tr>
		<?php } //end <?php if ($op=='') { ?>
		<tr>
			<td><input type="submit" value="Submit"></td>
			<td>&nbsp;</td>
		</tr>
	</table>
</form>
<br>
<br>
<br>
<?php
}else{
//No record found, display an error
?>
<h2><p class="error">IP BLOCK NOT FOUND!</p></h2>
<br>
<br>
<br>
<br>
<br>
<?php }// end if ($record <> false) { ?>
<a href="index.php">Return to the main page</a>
</body>
</html>
