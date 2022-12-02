<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/submittal.php');

$submittal_no = $_POST['submittal_no'] ?? '';
$authors = $_POST['authors'] ?? [];
$contract = $_POST['contract'] ?? [];
$attachment = $_FILES['attachment'] ?? '';

// redirect back to create form if either value is empty.
if(empty($submittal_no) || empty($authors)) {
	$error = 'Submittal and authors are required.';
	$_SESSION['error'] = $error;
	header("Location: create.php", TRUE, 200);
	die();
}

if (!empty($attachment) && $attachment['size'] > 10000000) {
	$error = 'File is too large.';
	$_SESSION['error'] = $error;
	header("Location: create.php", TRUE, 200);
	die();
}

// TODO: test with contract
add_submittal($db, $submittal_no, $contract, $authors);

if(!empty($attachment['tmp_name'])) {
	// save attachment
	add_submittal_attachment($db, $submittal_no, $attachment['name']);
	move_uploaded_file($attachment['tmp_name'], BASE_PATH . '/attachments/' . $attachment['name']);
} else {
	$attachment = null;
}

// successfully redirect back to submittals listing
// return status code 200 as a sign that the post request was successful
header("Location: index.php", TRUE, 200);
die();
?>