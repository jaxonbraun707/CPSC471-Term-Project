<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/contract.php');

$Contract_No = $_GET['id'] ?? '';

if(empty($Contract_No)){
    header("Location: ../contracts/index.php");
    die();
}

delete_contract($db, $Contract_No);

header("Location: ../contracts/index.php");
die();

?>