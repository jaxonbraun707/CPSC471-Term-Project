<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/part.php');

$part_no = $_POST['part_no'] ?? '';

if(empty($part_no)) {
	$error = 'Please select a part to delete.';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

delete_part($db, $part_no);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: index.php");
die();
?>