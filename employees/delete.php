<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/employee.php');

$employee_SSN = $_GET['id'] ?? '';

if(empty($employee_SSN)){
    header("Location: index.php");
    die();
}

delete_employee($db, $employee_SSN);

header("Location: index.php");
die();

?>