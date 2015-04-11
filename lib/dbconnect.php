<?php
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$database); 
if (!$conn) {
    die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}
?>
