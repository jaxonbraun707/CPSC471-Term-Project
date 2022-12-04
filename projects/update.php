<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/project.php');

$project_no = $_POST['project_no'] ?? '';
$start_date = $_POST['start_date'] ?? '';
$end_date = $_POST['end_date'] ?? '';

if(empty($project_no)) {
	$error = 'Please select a project to edit.';
	$_SESSION['error'] = $error;
	header("Location: index.php", TRUE, 200);
	die();
}

if(empty($start_date) || empty($end_date)) {
	$error = 'Please start date and end date.';
	$_SESSION['error'] = $error;
	header("Location: edit.php?id=$project_no", TRUE, 200);
	die();
}

update_project($db, $project_no, $start_date, $end_date);

// successfully redirect back to projects listing
// return status code 200 as a sign that the post request was successful
header("Location: project.php?id=$project_no");
die();
?>