<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/design.php');

$design_no = $_POST['design_no'] ?? '';
$budget = $_POST['budget'] ?? '';
$new_design_no = $_POST['new_design_no'] ?? '';

if(empty($design_no)) {
	$error = 'Please select a design to edit.';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

if(empty($new_design_no)) {
	$error = 'Please enter a new design number.';
	$_SESSION['error'] = $error;
	header("Location: edit.php?id=$design_no", TRUE, 200);
	die();
}

if(empty($budget)) {
	$error = 'Please fill up the budget';
	$_SESSION['error'] = $error;
	header("Location: edit.php?id=$design_no", TRUE, 200);
	die();
}

update_design($db, $design_no, $budget, $new_design_no);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: design.php?id=$new_design_no", TRUE, 200);
die();
?>