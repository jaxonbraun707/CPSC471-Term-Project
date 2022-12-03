<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/submittal.php');

$submittal_no = $_POST['submittal_no'] ?? '';

if(empty($submittal_no)) {
	$error = 'Please select a submittal to delete.';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

delete_submittal($db, $submittal_no);

// successfully redirect back to submittals listing
// return status code 200 as a sign that the post request was successful
header("Location: index.php", TRUE, 200);
die();
?>