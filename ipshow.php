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
</body>
</html>
