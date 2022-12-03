<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/order.php');

$order_no = $_POST['order_no'] ?? '';
$project_no = $_POST['project_no'] ?? '';
$ship_date = $_POST['ship_date'] ?? '';
$labours = $_POST['labour'] ?? [];
$labour_date = $_POST['labour_date'] ?? '';
$labour_hours = $_POST['labour_hours'] ?? '';

// redirect back to create form if either value is empty.
if(empty($order_no) || empty($project_no) || empty($labours)) {
	$error = 'Order, Project, and labour are required.';
	$_SESSION['error'] = $error;
	header("Location: create.php", TRUE, 200);
	die();
}

add_order($db, $order_no, $project_no, $ship_date, $labours, $labour_date, $labour_hours);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: index.php");
die();
?>