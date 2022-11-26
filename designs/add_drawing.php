<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/design.php');

$design_no = $_POST['design_no'] ?? '';
$drawing = $_POST['drawing'] ?? [];

if(empty($design_no)) {
	$error = 'Please select a design to add a drawing to';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

if(empty($drawing)) {
	$error = 'Please input a drawing to add to a design';
	$_SESSION['error'] = $error;
	header("Location: design.php?id=$design_no", TRUE, 200);
	die();
}

add_design_drawing($db, $design_no, $drawing);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: design.php?id=$design_no", TRUE, 200);
die();
?>