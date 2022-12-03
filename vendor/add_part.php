<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/vendor.php');

$vendor_id = $_POST['vendor_id'] ?? '';
$part = $_POST['part'] ?? [];
$vendor_price = $_POST['vendor_price'] ?? '';

if(empty($vendor_id)) {
	$error = 'Please select a part to add a vendor to.';
	$_SESSION['error'] = $error;
	header("Location: index.php");
	die();
}

if(empty($part)) {
	$error = 'Please select vendor to add to a part';
	$_SESSION['error'] = $error;
	header("Location: vendor.php?id=$vendor_id");
	die();
}

add_part_vendor($db, $vendor_id, $part, $vendor_price);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: vendor.php?id=$vendor_id");
die();
?>