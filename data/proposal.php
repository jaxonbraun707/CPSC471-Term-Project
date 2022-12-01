<?php
/**********************
 * 
 * query for retrieving all proposals
 * @param  PDO $db
 * @return $query     query object
 * 
 **********************/
function get_proposals($db) {	
	$q = "
		SELECT  
			    *
		FROM Proposal
		";
	return $db->query($q);
}

/**********************
 * 
 * query for adding proposals along with their related entities to the database
 * @param  PDO $db
 * @param  $Sales_SSN, $Proposal_No, $Title, $Value, $Client_Id, $Issued_Date, $Expiry_Date 
 * 
 **********************/
function add_proposal($db, $Sales_SSN, $Proposal_No, $Title, $Value, $Client_Id, $Issued_Date, $Expiry_Date) {
	$proposal_q = "
		INSERT INTO proposal (Proposal_No, Title, Value, Issued_Date, Expiry_Date)
		VALUES (:Proposal_No, :Title, :Value, :Issued_Date, :Expiry_Date)
	";

	$sales_q = "
		INSERT INTO sales_proposals (Sales_SSN, Proposal_No)
		VALUES (:Sales_SSN, :Proposal_No)
	";

	$client_q = "
		INSERT INTO client_proposals (Client_Id, Proposal_No)
		VALUES (:Client_Id, :Proposal_No)
	";

	if ($db->beginTransaction()) {
		try {
			// insert proposal
			$query = $db->prepare($proposal_q);
			$query->execute([':Proposal_No' => $Proposal_No, ':Title' => $Title, ':Value' => $Value, ':Issued_Date' => $Issued_Date, ':Expiry_Date' => $Expiry_Date]);

			// insert associated sales_ssn
			$query = $db->prepare($sales_q);
			$query->execute([':Sales_SSN' => $Sales_SSN, ':Proposal_No' => $Proposal_No]);

			// insert associated client_id
			$query = $db->prepare($client_q);
			$query->execute([':Client_Id' => $Client_Id, ':Proposal_No' => $Proposal_No]);

	    	return $db->commit();
	  	} catch (Exception $e) {
	    	if ($db->inTransaction()) {
	       		$db->rollBack();
	       		throw $e;
	      	}        
	  	}
	}
}