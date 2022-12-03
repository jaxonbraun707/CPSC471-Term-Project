<?php
require_once('../init.php');
require_once('../must_be_logged_in.php');
require_once('../db.php');
require_once('../data/proposal.php');

$Proposal_No = $_GET['id'] ?? '';

if(empty($Proposal_No)){
    header("Location: ../proposals/index.php");
    die();
}

delete_salesproposal($db, $Proposal_No);
delete_clientproposal($db, $Proposal_No);
delete_proposal($db, $Proposal_No);

header("Location: ../proposals/index.php");
die();

?>