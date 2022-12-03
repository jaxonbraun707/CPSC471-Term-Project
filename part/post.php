<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/part.php');

$part_no = $_POST['part_no'] ?? '';
$vendors = $_POST['vendor'] ?? [];
$price = $_POST['price'] ?? '';

// redirect back to create form if either value is empty.
if(empty($part_no) || empty($vendors) || empty($price)) {
	$error = 'All fields are required.';
	$_SESSION['error'] = $error;
	header("Location: create.php");
	die();
}

add_part($db, $part_no, $vendors, $price);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: index.php");
die();
?>