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
		FROM Contract AS C, Proposal AS P, Client AS CL
		WHERE
			C.Proposal_No = P.Proposal_No AND
            C.Client_Id = CL.Client_Id AND
            
			(
				C.Contract_No LIKE :search_term OR
                CL.Company_Name LIKE :search_term
				
			)
		GROUP BY Client_Id
	";

	$query = $db->prepare($q);
	$query->execute([':search_term' => "%$search_term%"]);

	return $query;
}