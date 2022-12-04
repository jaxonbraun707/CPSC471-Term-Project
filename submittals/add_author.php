<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/submittal.php');

$submittal_no = $_POST['submittal_no'] ?? '';
$author = $_POST['author'] ?? [];

if(empty($submittal_no)) {
	$error = 'Please select a submittal to add an author to.';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

if(empty($author)) {
	$error = 'Please select an author to add to a submittal';
	$_SESSION['error'] = $error;
	header("Location: submittal.php?id=$submittal_no", TRUE, 200);
	die();
}

add_submittal_author($db, $submittal_no, $author);

// successfully redirect back to submittals listing
// return status code 200 as a sign that the post request was successful
header("Location: submittal.php?id=$submittal_no", TRUE, 200);
die();
?>