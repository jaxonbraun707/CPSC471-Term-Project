<?php
/**********************
 * 
 * query for retrieving all contracts
 * @param  PDO $db
 * @return $query     query object
 * 
 **********************/
function get_contracts($db) {	
	$q = "
		SELECT  
			    C.*, P.Title
		FROM Contract AS C, Proposal AS P
        WHERE 
            C.Proposal_No = P.Proposal_No
		";
	return $db->query($q);
}

/*********************
 * 
 * Search contracts by searching against Contract_No, Client Name and Sales SSN
 * @param  PDO $db          
 * @param  string $search_term 
 * @return $query              query object
 * 
 * TO DO:  Finish building out search terms!
 * 
 **********************/
function search_contracts($db, $search_term) {
	$q = "
		SELECT  
			C.*, P.Title
		FROM Contract AS C, Proposal AS P, Client AS CL, Sales_Have_Clients AS SC, Employee AS E
		WHERE
			C.Proposal_No = P.Proposal_No AND
            C.Client_Id = CL.Client_Id AND
			C.Client_Id = SC.Client_Id AND
			SC.Sales_SSN = E.SSN AND 
            
			(
				C.Contract_No LIKE :search_term OR
                CL.Company_Name LIKE :search_term OR
				E.First_Name LIKE :search_term OR
				E.Last_Name LIKE :search_term
				
			)
		GROUP BY Client_Id
	";

	$query = $db->prepare($q);
	$query->execute([':search_term' => "%$search_term%"]);

	return $query;
}

/**********************
 * 
 * query for adding contracts to the database
 * @param  PDO $db
 * @param  $Proposal_No, $Contract_No, $Start_Date, $Delivery_Date, $Payment_Terms, 
 * @param  $Issued_Date, $Expiry_Date, $Client_Id 
 * 
 **********************/
function add_contract($db, $proposal, $Contract_No, $Start_Date, $Delivery_Date, $Payment_Terms, $Issued_Date, $Expiry_Date, $Client_Id) {
	$contract_q = "
		INSERT INTO contract (Proposal_No, Contract_No, Start_Date, Delivery_Date, Payment_Terms, Issued_Date, Expiry_Date, Client_Id)
		VALUES (:proposal, :Contract_No, :Start_Date, :Delivery_Date, :Payment_Terms, :Issued_Date, :Expiry_Date, :Client_Id)
	";

	if ($db->beginTransaction()) {
		try {
			// insert contract
			$query = $db->prepare($contract_q);
			$query->execute([':proposal' => $proposal, ':Contract_No' => $Contract_No, ':Start_Date' => $Start_Date, ':Delivery_Date' => $Delivery_Date, ':Payment_Terms' => $Payment_Terms, ':Issued_Date' => $Issued_Date, ':Expiry_Date' => $Expiry_Date, ':Client_Id' => $Client_Id]);

	    	return $db->commit();
	  	} catch (Exception $e) {
	    	if ($db->inTransaction()) {
	       		$db->rollBack();
	       		throw $e;
	      	}        
	  	}
	}
}

/**********************
 * 
 * query for retrieving a contract
 * @param  PDO $db, $contract_no
 * @return $query     query object
 * 
 **********************/
function find_contract($db, $contract_no) {
	$q = "
		SELECT  
			C.*, P.Title, CL.Company_Name
		FROM Contract AS C, Proposal AS P, Client_Proposals AS CP, Client AS CL
		WHERE
			C.Contract_No = :contract_no AND
			C.Proposal_No = P.Proposal_No AND
			C.Proposal_No = CP.Proposal_No AND
			CP.Client_Id = CL.Client_Id
		";
	$query = $db->prepare($q);
	$query->execute([':contract_no' => $contract_no]);
	return $query;
}

/**********************
 * 
 * Update a Contract by Contract_No
 * @param  PDO $db
 * @param  $Delivery_Date, $Payment_Terms, $Expiry_Date
 * @return PDO query object
 * 
 **********************/
function update_contract($db, $Contract_No, $Delivery_Date, $Payment_Terms, $Expiry_Date) {
	$q = "
		UPDATE Contract AS C
		SET C.Delivery_Date = :Delivery_Date, C.Payment_Terms = :Payment_Terms, C.Expiry_Date = :Expiry_Date 
		WHERE C.Contract_No = :Contract_No
		";
	$query = $db->prepare($q);
	$query->execute([':Contract_No' => $Contract_No, ':Delivery_Date' => $Delivery_Date, ':Payment_Terms' => $Payment_Terms, 'Expiry_Date' => $Expiry_Date]);
	return $query;
}

/**********************
 * 
 * Delete a contract by Contract_No
 * @param  PDO $db
 * @param  string $Contract_No
 * @return PDO query object
 * 
 **********************/
function delete_contract($db, $Contract_No){
	$q = "
		DELETE FROM Contract
		
		WHERE Contract_No = :Contract_No
	";
	$query = $db->prepare($q);
	$query->execute([':Contract_No' => $Contract_No]);
	return $query;
}


