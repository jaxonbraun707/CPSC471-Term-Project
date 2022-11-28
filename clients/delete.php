<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/client.php');

$Client_Id = $_GET['id'] ?? '';

if(empty($Client_Id)){
    header("Location: index.php");
    die();
}

delete_client($db, $Client_Id);

header("Location: ../client/index.php");
die();

?>