<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/proposal.php');

$Sales_SSN = $_POST['Sales_SSN'] ?? '';
$Proposal_No = $_POST['Proposal_No'] ?? '';
$Title = $_POST['Title'] ?? '';
$Value = $_POST['Value'] ?? '';
$Client_Id = $_POST['Client_Id'] ?? '';
$Issued_Date = $_POST['Issued_Date'] ?? '';
$Expiry_Date = $_POST['Expiry_Date'] ?? '';


if(empty($Sales_SSN) || empty($Proposal_No) || empty($Title) || empty($Value) || empty($Client_Id) || empty($Issued_Date)){
	$error = 'Sales SSN, Proposal Number, Title, Value, Client Id, Issued Date fields are required';
	$_SESSION['error'] = $error;
	header("Location: ../proposals/create.php");
	die();
}

add_proposal($db, $Sales_SSN, $Proposal_No, $Title, $Value, $Client_Id, $Issued_Date, $Expiry_Date);

// successfully redirect back to employee listing
// return status code 200 as a sign that the post request was successful
header("Location: ../proposals/index.php");
die();
?>
