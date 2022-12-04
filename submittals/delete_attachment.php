<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/submittal.php');

$submittal_no = $_POST['submittal_no'] ?? '';
$attachment = $_POST['attachment'] ?? [];

if(empty($submittal_no)) {
	$error = 'Please select a submittal to delete a attachment from.';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

if(empty($attachment)) {
	$error = 'Please select an attachment to delete from a submittal';
	$_SESSION['error'] = $error;
	header("Location: submittal.php?id=$submittal_no", TRUE, 200);
	die();
}

delete_submittal_attachment($db, $submittal_no, $attachment);
// pretend to delete the file from file system.

// successfully redirect back to submittals listing
// return status code 200 as a sign that the post request was successful
header("Location: submittal.php?id=$submittal_no", TRUE, 200);
die();
?>