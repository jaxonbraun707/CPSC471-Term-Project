<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/vendor.php');

$vendor_id = $_POST['vendor_id'] ?? '';
$vendor_name = $_POST['vendor_name'] ?? '';
$vendor_phone_no = $_POST['vendor_phone_no'] ?? '';
$parts = $_POST['part'] ?? [];
$price = $_POST['price'] ?? '';

// redirect back to create form if either value is empty.
if(empty($vendor_id) || empty($parts) || empty($price)) {
	$error = 'All fields are required.';
	$_SESSION['error'] = $error;
	header("Location: create.php");
	die();
}

add_vendor($db, $vendor_id, $vendor_name, $vendor_phone_no, $parts, $price);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: index.php");
die();
?>