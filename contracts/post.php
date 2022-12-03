<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/contract.php');

$Proposal_No = $_POST['Proposal_No'] ?? '';
$Contract_No = $_POST['Contract_No'] ?? '';
$Start_Date = $_POST['Start_Date'] ?? '';
$Delivery_Date = $_POST['Delivery_Date'] ?? '';
$Payment_Terms = $_POST['Payment_Terms'] ?? '';
$Issued_Date = $_POST['Issued_Date'] ?? '';
$Expiry_Date = $_POST['Expiry_Date'] ?? '';
$Client_Id = $_POST['Client_Id'] ?? '';


if(empty($Proposal_No) || empty($Contract_No) || empty($Client_Id)){
	$error = 'Proposal Number, Contract_No, Client Id fields are required';
	$_SESSION['error'] = $error;
	header("Location: ../contracts/create.php");
	die();
}

add_contract($db, $Proposal_No, $Contract_No, $Start_Date, $Delivery_Date, $Payment_Terms, $Issued_Date, $Expiry_Date, $Client_Id);

// successfully redirect back to employee listing
// return status code 200 as a sign that the post request was successful
header("Location: ../contracts/index.php");
die();
?>
