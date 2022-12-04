<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/submittal.php');

$submittal_no = $_POST['submittal_no'] ?? '';
$contract = $_POST['contract'] ?? null;
$new_submittal_no = $_POST['new_submittal_no'] ?? '';

if(empty($submittal_no)) {
	$error = 'Please select a submittal to edit.';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

if(empty($new_submittal_no)) {
	$error = 'Please enter a new submittal number.';
	$_SESSION['error'] = $error;
	header("Location: edit.php?id=$submittal_no", TRUE, 200);
	die();
}

update_submittal($db, $submittal_no, $contract, $new_submittal_no);

// successfully redirect back to submittals listing
// return status code 200 as a sign that the post request was successful
header("Location: submittal.php?id=$new_submittal_no", TRUE, 200);
die();
?>