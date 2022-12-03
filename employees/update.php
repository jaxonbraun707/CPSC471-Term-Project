<?php
require_once('../init.php');
require_once('../must_be_admin.php');
require_once('../db.php');
require_once('../data/employee.php');

$SSN = $_POST['ssn'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$DOB = $_POST['dob'] ?? '';
$phone_no = $_POST['phone_no'] ?? '';
$email = $_POST['email'] ?? '';
$address_line_1 = $_POST['address_line_1'] ?? '';
$address_line_2 = $_POST['address_line_2'] ?? '';
$city = $_POST['city'] ?? '';
$prov_state = $_POST['prov_state'] ?? '';
$country = $_POST['country'] ?? '';
$postal_zip = $_POST['postal_zip'] ?? '';
$job_type = $_POST['job_type'] ?? '';
$sales_region = $_POST['sales_region'] ?? '';
$eng_specialty = $_POST['eng_specialty'] ?? '';
$lab_specialty = $_POST['lab_specialty'] ?? '';
$new_SSN = $_POST['new_ssn'] ?? '';


update_employee($db, $SSN, $first_name, $last_name, $DOB, $phone_no, $email, $address_line_1, $address_line_2, $city, $prov_state, $country, $postal_zip, $job_type, $sales_region, $eng_specialty, $lab_specialty, $new_SSN);

header("Location: employee.php?id=$new_SSN");
die();
?>