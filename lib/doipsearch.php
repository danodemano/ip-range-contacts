<?php
//Start the sessions for preserving the data
session_start();

//Get the configs and connect to the database
require_once('dbconfig.php');
require_once('dbconnect.php');

//Require the IP address handling library
require_once('ip.lib.php');

//Require the main functions files
require_once('functions.php');

//Get the search string
if(get_magic_quotes_gpc()) {
	$term = stripslashes($_POST['search']);
} else {
	$term = $_POST['search'];;
} //end if(get_magic_quotes_gpc()) {

//Make sure the search string isn't empty
if (empty($term)) {
	//Redirect to the results page with an error
	require_once('dbclose.php');
	header('Location: ../results.php?op=blank');
	exit;
} //end if (empty($term)) {

//We have a search string, see if it's a IP address
$validipv4 = filter_var($term, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
$validipv6 = filter_var($term, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
if ($validipv4) {
	//Convert the address to an int and search
	$ip = new IPv4($term);
	$ip_int = $ip->numeric();
	
	//Search for address in the database
	$results = search_ip_blocks($ip_int, $db);
	if ($results <> false) {
		//Redirect back with the results and close the DB
		$_SESSION['results'] = $results;
		$_SESSION['term'] = $term;
		require_once('dbclose.php');
		header('Location: ../results.php?op=done');
		exit;
	} else {
		//No results, close the DB and redirect back with an error
		require_once('dbclose.php');
		header('Location: ../results.php?op=notfound');
		exit;
	} //end if ($res->rowCount() > 0) {
} else if ($validipv6) {
	//Convert the address to an int and search
	$ip = new IPv6($term);
	$ip_int = $ip->numeric();
	
	//Search for address in the database
	$results = search_ip_blocks($ip_int, $db);
	if ($results <> false) {
		//Redirect back with the results and close the DB
		$_SESSION['results'] = $results;
		$_SESSION['term'] = $term;
		require_once('dbclose.php');
		header('Location: ../results.php?op=done');
		exit;
	} else {
		//No results, close the DB and redirect back with an error
		require_once('dbclose.php');
		header('Location: ../results.php?op=notfound');
		exit;
	} //end if ($res->rowCount() > 0) {
} else {
	$results = search_for_term($term, $db);
	if ($results <> false) {
		//Redirect back with the results and close the DB
		$_SESSION['results'] = $results;
		$_SESSION['term'] = $term;
		require_once('dbclose.php');
		header('Location: ../results.php?op=done');
	} else {
		//No results, close the DB and redirect back with an error
		$_SESSION['term'] = $term;
		require_once('dbclose.php');
		header('Location: ../results.php?op=notfound');
		exit;
	} //end if ($results <> false) {
} //end if ($validip) {
