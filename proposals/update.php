<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/proposal.php');

$Proposal_No = $_POST['Proposal_No'] ?? '';
$Title = $_POST['Title'] ?? '';
$Value = $_POST['Value'] ?? '';
$Issued_Date = $_POST['Issued_Date'] ?? '';
$Expiry_Date = $_POST['Expiry_Date'] ?? '';
$salesperson = $_POST['salesperson'] ?? '';

if(empty($salesperson)){
	$error = 'Sales Person field is required';
	$_SESSION['error'] = $error;
	header("Location: edit.php?id=$Proposal_No");
	die();
}

update_proposal($db, $Proposal_No, $Title, $Value, $Issued_Date, $Expiry_Date, $salesperson);

header("Location: proposal.php?id=$Proposal_No");
die();
?>