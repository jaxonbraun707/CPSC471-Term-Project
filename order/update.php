<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/order.php');

$order_no = $_POST['order_no'] ?? '';
$new_order_no = $_POST['new_order_no'] ?? '';
$project_no = $_POST['new_project_no'] ?? '';
$ship_date = $_POST['new_ship_date'] ?? '';

update_order($db, $order_no, $new_order_no, $project_no, $ship_date);


header("Location: order.php?id=$new_order_no");
die();
?>