<?php
require_once('../init.php');
require_once('../db.php');
require_once('../data/design.php');

$design_no = $_POST['design_no'] ?? '';
$budget = $_POST['budget'] ?? '';
$authors = $_POST['authors'] ?? [];

// redirect back to create form if either value is empty.
if(empty($design_no) || empty($budget) || empty($authors)) {
	$error = 'Design and budget are required.';
	$_SESSION['error'] = $error;
	header("Location: /designs/create.php", TRUE, 200);
	die();
}

add_design($db, $design_no, $budget, $authors);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: /designs/index.php", TRUE, 200);
die();
?>