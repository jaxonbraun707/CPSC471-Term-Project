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
$new_Client_Id = $_POST['New_Client_Id'] ?? '';

update_client($db, $client_Id, $email, $contact_Name, $company_Name, $website, $phone_No, $address_line_1, $address_line_2, $city, $prov_state, $country, $postal_zip);

header("Location: client.php?id=$client_Id");
die();
?>