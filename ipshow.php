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
<a href="edit.php?id=<?php echo $id; ?>">Edit&nbsp;Record</a>&nbsp;|&nbsp;<a href="delete.php?id=<?php echo $id; ?>">Delete&nbsp;Record</a><br>
<br>
<br>
<br>
<a href="index.php">Return to the main page</a>
</body>
</html>
