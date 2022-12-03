<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/part.php');

$part_no = $_POST['Part_No'] ?? '';
$new_part_no = $_POST['new_part_no'] ?? '';


update_part($db, $part_no, $new_part_no);

header("Location: part.php?id=$new_part_no");
die();
?>