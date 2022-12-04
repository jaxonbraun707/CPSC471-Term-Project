<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/contract.php');
require_once('../data/client.php');

$proposal = $_POST['proposal'] ?? '';
$Contract_No = $_POST['Contract_No'] ?? '';
$Start_Date = $_POST['Start_Date'] ?? '';
$Delivery_Date = $_POST['Delivery_Date'] ?? '';
$Payment_Terms = $_POST['Payment_Terms'] ?? '';
$Issued_Date = $_POST['Issued_Date'] ?? '';
$Expiry_Date = $_POST['Expiry_Date'] ?? '';

$client = get_clientId($db, $proposal);
$client = $client->fetchAll(PDO::FETCH_ASSOC);

foreach ($client as $clients) {
	$Client_Id = $clients['Client_Id'];
}


if(empty($proposal) || empty($Contract_No)){
	$error = 'Proposal Number, Contract_No fields are required';
	$_SESSION['error'] = $error;
	header("Location: ../contracts/create.php");
	die();
}

add_contract($db, $proposal, $Contract_No, $Start_Date, $Delivery_Date, $Payment_Terms, $Issued_Date, $Expiry_Date, $Client_Id);

// successfully redirect back to employee listing
// return status code 200 as a sign that the post request was successful
header("Location: ../contracts/index.php");
die();
?>
