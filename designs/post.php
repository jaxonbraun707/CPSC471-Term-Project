<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/design.php');

$design_no = $_POST['design_no'] ?? '';
$budget = $_POST['budget'] ?? '';
$authors = $_POST['authors'] ?? [];
$drawings = explode(",", $_POST['drawings']) ?? [];

// redirect back to create form if either value is empty.
if(empty($design_no) || empty($budget) || empty($authors)) {
	$error = 'Design, budget, and authors are required.';
	$_SESSION['error'] = $error;
	header("Location: create.php", TRUE, 200);
	die();
}

add_design($db, $design_no, $budget, $authors, $drawings);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: index.php", TRUE, 200);
die();
?>