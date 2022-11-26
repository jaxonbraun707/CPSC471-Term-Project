<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/design.php');

$design_no = $_POST['design_no'] ?? '';
$author = $_POST['author'] ?? [];

if(empty($design_no)) {
	$error = 'Please select a design to add an author to.';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

if(empty($author)) {
	$error = 'Please select an author to add to a design';
	$_SESSION['error'] = $error;
	header("Location: design.php?id=$design_no", TRUE, 200);
	die();
}

add_design_author($db, $design_no, $author);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: design.php?id=$design_no", TRUE, 200);
die();
?>