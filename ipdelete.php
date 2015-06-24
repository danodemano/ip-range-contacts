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

//Get the confirm variable
@$confirm = $_GET['confirm'];

if ((!empty($id)) AND ($confirm==true)) {
  //Remove the record from the database
  remove_block($id, $db);

  require_once('lib/dbclose.php');
  header('Location: done.php?op=delete');
  exit;
} // if ((!empty($id)) AND ($confirm==true)) {

//Get the record for that ID
$record = block_info($id, $db);

//Close the database connection
require_once('lib/dbclose.php');
?>
<html>
<head>
<title>IP Address Contacts - Details</title>
</head>
<body>
<h2>IP block details:</h2>
<?php echo $record; ?>
<br>
<a href="$self?id=<?php echo $id;?>&confirm=true">Please click here to confirm you want to delete this record!</a><br><b>(This action CANNOT be undone)</b><br>
<br>
<br>
<br>
<a href="index.php">Return to the main page</a>
</body>
</html>
