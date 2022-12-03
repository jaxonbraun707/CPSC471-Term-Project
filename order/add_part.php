<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/order.php');
require_once('../data/part.php');

$order_no = $_POST['order_no'] ?? '';
$part_no = $_POST['part_no'] ?? '';
$qty = $_POST['qty'] ?? '';

$part_exists = get_part($db, $part_no);

if(empty($order_no)) {
	$error = 'Please select a order to add labour to.';
	$_SESSION['error'] = $error;
	header("Location: index.php");
	die();
}

if(empty($part_no_exists)) {
	$error = 'Part to add doesnt exist';
	$_SESSION['error'] = $error;
	header("Location: order.php?id=$order_no");
	die();
}

add_order_part($db, $order_no, $part_no, $qty);

// successfully redirect back to designs listing
// return status code 200 as a sign that the post request was successful
header("Location: order.php?id=$order_no");
die();
?>