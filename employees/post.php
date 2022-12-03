<?php
require_once('../init.php');
require_once('../must_be_admin.php');
require_once('../db.php');
require_once('../data/employee.php');
require_once('../data/user.php');

$SSN = $_POST['SSN'] ?? '';
$first_name = $_POST['First_Name'] ?? '';
$last_name = $_POST['Last_Name'] ?? '';
$DOB = $_POST['DOB'] ?? '';
$phone_no = $_POST['Phone_No'] ?? '';
$email = $_POST['Email'] ?? '';
$address_line_1 = $_POST['Address_Line_1'] ?? '';
$address_line_2 = $_POST['Address_Line_2'] ?? '';
$city = $_POST['City'] ?? '';
$prov_state = $_POST['Prov_State'] ?? '';
$country = $_POST['Country'] ?? '';
$postal_zip = $_POST['Postal_Zip'] ?? '';
$job_type = $_POST['Job_Type'] ?? '';
$sales_region = $_POST['Sales_Region'] ?? '';
$eng_specialty = $_POST['Eng_Specialty'] ?? '';
$lab_specialty = $_POST['Lab_Specialty'] ?? '';
$username = $_POST['Username'] ?? '';
$password = $_POST['Password'] ?? '';
$user_type = $_POST['User_Type'] ?? '';

if(empty($SSN) || empty($first_name) || empty($last_name) || empty($DOB) || empty($phone_no) || empty($email) || empty($address_line_1) || empty($address_line_2) || empty($city) || empty($prov_state) || empty($country) || empty($postal_zip) || empty($job_type) || empty($username) || empty($password) || empty($user_type)){
	$error = 'All Fields are required except for Sales Region, Engineering Specialty, and Labour Specialty.';
	$_SESSION['error'] = $error;
	header("Location: ../employees/create.php");
	die();
}

add_employee($db, $SSN, $first_name, $last_name, $DOB, $phone_no, $email, $address_line_1, $address_line_2, $city, $prov_state, $country, $postal_zip, $job_type, $sales_region, $eng_specialty, $lab_specialty);

add_user($db, $SSN, $username, $password, $user_type);

// successfully redirect back to employee listing
// return status code 200 as a sign that the post request was successful
//header("Location: ../employees/index.php");
die();
?>