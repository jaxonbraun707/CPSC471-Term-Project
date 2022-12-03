<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/vendor.php');

$vendor_id = $_POST['vendor_id'] ?? '';
$vendor_name = $_POST['new_vendor_name'] ?? '';
$vendor_phone_no = $_POST['new_vendor_phone_no'] ?? '';
$new_vendor_id = $_POST['new_vendor_id'] ?? '';


update_vendor($db, $vendor_id, $vendor_name, $vendor_phone_no, $new_vendor_id);

header("Location: vendor.php?id=$new_vendor_id");
die();
?>