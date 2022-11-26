<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/design.php');

$design_no = $_POST['design_no'] ?? '';

if(empty($design_no)) {
	$error = 'Please select a design to delete.';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

delete_design($db, $design_no);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: index.php", TRUE, 200);
die();
?>