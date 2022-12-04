<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/project.php');

$design = $_POST['design'] ?? [];
$contract = $_POST['contract'] ?? [];
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';

// redirect back to create form if either value is empty.
if(empty($design) || empty($contract) || empty($start_date) || empty($end_date)) {
	$error = 'Design, Contract, Start Date, and End Date are all required.';
	$_SESSION['error'] = $error;
	header("Location: create.php", TRUE, 200);
	die();
}

add_project($db, $design, $contract, $start_date, $end_date);

// successfully redirect back to projects listing
// return status code 200 as a sign that the post request was successful
// header("Location: index.php", TRUE, 200);
die();
?>