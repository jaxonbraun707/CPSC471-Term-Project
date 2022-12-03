<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/order.php');

$order_no = $_POST['order_no'] ?? '';
$labour = $_POST['labour'] ?? [];
$labour_date = $_POST['labour_date'] ?? '';
$labour_hours = $_POST['labour_hours'] ?? '';

if(empty($order_no)) {
	$error = 'Please select a order to add labour to.';
	$_SESSION['error'] = $error;
	header("Location: index.php");
	die();
}

if(empty($labour)) {
	$error = 'Please select labour to add to a order';
	$_SESSION['error'] = $error;
	header("Location: order.php?id=$order_no");
	die();
}

add_order_labour($db, $order_no, $labour, $labour_date, $labour_hours);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: order.php?id=$order_no");
die();
?>