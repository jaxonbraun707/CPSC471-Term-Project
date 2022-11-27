<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/client.php');

$client_Id = $_POST['Client_Id'] ?? '';
$email = $_POST['Email'] ?? '';
$contact_Name = $_POST['Contact_Name'] ?? '';
$company_Name = $_POST['Company_Name'] ?? '';
$website = $_POST['Website'] ?? '';
$phone_No = $_POST['Phone_No'] ?? '';
$address_line_1 = $_POST['Address_Line_1'] ?? '';
$address_line_2 = $_POST['Address_Line_2'] ?? '';
$city = $_POST['City'] ?? '';
$prov_state = $_POST['Prov_State'] ?? '';
$country = $_POST['Country'] ?? '';
$postal_zip = $_POST['Postal_Zip'] ?? '';

if(empty($client_Id) || empty($contact_name) || empty($address_line_1) || empty($city) || empty($prov_state) || empty($country) || empty($postal_zip)){
	$error = 'Client ID, Contact Name, Address Line 1, City, Prov/State, Country, Postal/Zip fields are required';
	$_SESSION['error'] = $error;
	header("Location: ../clients/create.php");
	die();
}

add_client($db, $client_Id, $email, $contact_Name, $company_Name, $website, $phone_No, $address_line_1, $address_line_2, $city, $prov_state, $country, $postal_zip);

// successfully redirect back to employee listing
// return status code 200 as a sign that the post request was successful
header("Location: ../clients/index.php");
die();
?>