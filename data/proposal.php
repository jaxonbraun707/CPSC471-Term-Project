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
 * query for retrieving a proposal
 * @param  PDO $db, $proposal_no
 * @return $query     query object
 * 
 **********************/
function find_proposal($db, $proposal_no) {
	$q = "
		SELECT  
			P.*, SP.Sales_SSN
		FROM Proposal AS P, Sales_Proposals AS SP
		WHERE
			P.Proposal_No = :proposal_no AND
			SP.Proposal_No = :proposal_no
		";
	$query = $db->prepare($q);
	$query->execute([':proposal_no' => $proposal_no]);
	return $query;
}

/**********************
 * 
 * Update a Proposal by Proposal_No
 * @param  PDO $db
 * @param  $Proposal_No, $Title, $Value, $Issued_Date, $Expiry_Date, $Sales_SSN 
 * @return PDO query object
 * 
 **********************/
function update_proposal($db, $Proposal_No, $Title, $Value, $Issued_Date, $Expiry_Date, $Sales_SSN) {
	$q = "
		UPDATE Proposal AS P, Sales_Proposals AS SP
		SET P.Proposal_No = :Proposal_No, P.Title = :Title, P.Value = :Value, P.Issued_Date = :Issued_Date, P.Expiry_Date = :Expiry_Date, SP.Sales_SSN = :Sales_SSN 
		WHERE P.Proposal_No = :Proposal_No AND SP.Proposal_No = :Proposal_No
	";
	$query = $db->prepare($q);
	$query->execute([':Proposal_No' => $Proposal_No, ':Title' => $Title, ':Value' => $Value, 'Issued_Date' => $Issued_Date, 'Expiry_Date' => $Expiry_Date, 'Sales_SSN' => $Sales_SSN]);
	return $query;
}

/**********************
 * 
 * query for adding proposals along with their related entities to the database
 * @param  PDO $db
 * @param  $Sales_SSN, $Proposal_No, $Title, $Value, $Client_Id, $Issued_Date, $Expiry_Date 
 * 
 **********************/
function add_proposal($db, $salesperson, $Proposal_No, $Title, $Value, $Client_Id, $Issued_Date, $Expiry_Date) {
	$proposal_q = "
		INSERT INTO proposal (Proposal_No, Title, Value, Issued_Date, Expiry_Date)
		VALUES (:Proposal_No, :Title, :Value, :Issued_Date, :Expiry_Date)
	";

	$sales_q = "
		INSERT INTO sales_proposals (Sales_SSN, Proposal_No)
		VALUES (:salesperson, :Proposal_No)
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
			$query->execute([':salesperson' => $salesperson, ':Proposal_No' => $Proposal_No]);

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

/*********************
 * 
 * Search proposals by searching against Proposal Title, Employee Name and Sales SSN
 * @param  PDO $db          
 * @param  string $search_term 
 * @return $query              query object
 * 
 **********************/
function search_proposals($db, $search_term) {
	$q = "
		SELECT  
			P.*
		FROM Proposal AS P, Employee AS E, Sales_Proposals AS SP
		WHERE
			P.Proposal_No = SP.Proposal_No AND
			E.SSN = SP.Sales_SSN AND
			(
				P.Title LIKE :search_term OR
				E.First_Name LIKE :search_term OR
				E.Last_Name LIKE :search_term OR
				SP.Sales_SSN LIKE :search_term
			)
		GROUP BY Proposal_No
	";

	$query = $db->prepare($q);
	$query->execute([':search_term' => "%$search_term%"]);

	return $query;
}

/**********************
 * 
 * Delete a proposal by Proposal_No
 * @param  PDO $db
 * @param  string $Proposal_No
 * @return PDO query object
 * 
 **********************/
function delete_proposal($db, $Proposal_No){
	$q = "
		DELETE FROM Proposal
		
		WHERE Proposal_No = :Proposal_No
	";
	$query = $db->prepare($q);
	$query->execute([':Proposal_No' => $Proposal_No]);
	return $query;
}

/**********************
 * 
 * Delete a proposal by Proposal_No
 * @param  PDO $db
 * @param  string $Proposal_No
 * @return PDO query object
 * 
 **********************/
function delete_salesproposal($db, $Proposal_No){
	$q = "
		DELETE FROM Sales_Proposals
		
		WHERE Proposal_No = :Proposal_No
	";
	$query = $db->prepare($q);
	$query->execute([':Proposal_No' => $Proposal_No]);
	return $query;
}

/**********************
 * 
 * Delete a proposal by Proposal_No
 * @param  PDO $db
 * @param  string $Proposal_No
 * @return PDO query object
 * 
 **********************/
function delete_clientproposal($db, $Proposal_No){
	$q = "
		DELETE FROM Client_Proposals
		
		WHERE Proposal_No = :Proposal_No
	";
	$query = $db->prepare($q);
	$query->execute([':Proposal_No' => $Proposal_No]);
	return $query;
}