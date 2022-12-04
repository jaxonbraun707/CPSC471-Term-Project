<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/submittal.php');

$submittal_no = $_POST['submittal_no'] ?? '';
$attachment = $_FILES['attachment'] ?? '';

if(empty($submittal_no)) {
	$error = 'Please select a submittal to add a attachment to';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

if(empty($attachment['tmp_name'])) {
	$error = 'Please input a attachment to add to a submittal';
	$_SESSION['error'] = $error;
	header("Location: submittal.php?id=$submittal_no", TRUE, 200);
	die();
}

add_submittal_attachment($db, $submittal_no, $attachment['name']);
move_uploaded_file($attachment['tmp_name'], BASE_PATH . '/attachments/' . $attachment['name']);

// successfully redirect back to submittals listing
// return status code 200 as a sign that the post request was successful
header("Location: submittal.php?id=$submittal_no", TRUE, 200);
die();
?>