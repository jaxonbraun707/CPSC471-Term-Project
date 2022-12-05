<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/order.php');

$order_no = $_POST['order_no'] ?? '';
$part_no = $_POST['part_no'] ?? '';
$qty = $_POST['qty'] ?? '';

if(empty($order_no)) {
	$error = 'Please select a order to add a part to.';
	$_SESSION['error'] = $error;
	header("Location: index.php");
	die();
}

add_order_part($db, $order_no, $part_no, $qty);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: order.php?id=$order_no");
die();
?>