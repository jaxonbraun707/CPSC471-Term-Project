<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/contract.php');

$Contract_No = $_POST['Contract_No'] ?? '';
$Delivery_Date = $_POST['Delivery_Date'] ?? '';
$Payment_Terms = $_POST['Payment_Terms'] ?? '';
$Expiry_Date = $_POST['Expiry_Date'] ?? '';

update_contract($db, $Contract_No, $Delivery_Date, $Payment_Terms, $Expiry_Date);

header("Location: contract.php?id=$Contract_No");
die();
?>