<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/order.php');

$order_no = $_POST['order_no'] ?? '';
$labour = $_POST['labour'] ?? [];

if(empty($order_no)) {
	$error = 'Please select a design to delete an author from.';
	$_SESSION['error'] = $error;
	header("Location: index.php");
	die();
}

if(empty($labour)) {
	$error = 'Please select an author to delete from a design';
	$_SESSION['error'] = $error;
	header("Location: order.php?id=$order_no");
	die();
}

delete_order_labour($db, $order_no, $labour);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: order.php?id=$order_no");
die();
?>