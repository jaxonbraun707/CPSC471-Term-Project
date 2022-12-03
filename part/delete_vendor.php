<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/part.php');

$part_no = $_POST['part_no'] ?? '';
$vendor = $_POST['vendor_id'] ?? [];

if(empty($part_no)) {
	$error = 'Please select a part to delete a vendor from.';
	$_SESSION['error'] = $error;
	header("Location: index.php");
	die();
}

if(empty($vendor)) {
	$error = 'Please select an vendor to delete from a part';
	$_SESSION['error'] = $error;
	header("Location: part.php?id=$part_no");
	die();
}

delete_vendor_part($db, $part_no, $vendor); 

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: part.php?id=$part_no");
die();
?>