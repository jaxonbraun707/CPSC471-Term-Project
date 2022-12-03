<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/vendor.php');

$vendor_id = $_POST['vendor_id'] ?? '';

if(empty($vendor_id)) {
	$error = 'Please select a vendor to delete.';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

delete_vendor($db, $vendor_id);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: index.php");
die();
?>