<?php
/**********************
 * 
 * query for retrieving all clients
 * @param  PDO $db
 * @return $query     query object
 * 
 **********************/
function get_clients($db) {	
	$q = "
		SELECT  
			    *
		FROM CLIENT
		";
	return $db->query($q);
}

/**********************
 * 
 * query for searching clients by company name, contact name, or prov_state
 * @param  PDO $db
 * @return $query     query object
 * 
 **********************/
function search_clients($db, $search_term) {	
	$q = "
		SELECT  C.*
		FROM Client AS C
        WHERE
            (
                C.Company_Name LIKE :search_term OR
                C.Contact_Name LIKE :search_term OR
                C.Prov_State LIKE :search_term
            )
		";
		
		$query = $db->prepare($q);
		$query->execute([':search_term' => "%$search_term%"]);
		return $query;
}


/**********************
 * 
 * query for adding clients to the database
 * @param  PDO $db
 * @param  $client_Id, $Email, $Contact_Name, $Company_Name, $Website, $Phone_No 
 * @param  $Address_Line_1, $Address_Line_2, $City, $Prov_State, $Country, $Postal_Zip
 * 
 **********************/
function add_client($db, $Client_Id, $Email, $Contact_Name, $Company_Name, $Website, $Phone_No, $Address_Line_1, $Address_Line_2, $City, $Prov_State, $Country, $Postal_Zip) {
	$client_q = "
		INSERT INTO Client
		VALUES (:Client_Id, :Email, :Contact_Name, :Company_Name, :Website, :Phone_No, :Address_Line_1, :Address_Line_2, :City, :Prov_State, :Country, :Postal_Zip)
	";

	if ($db->beginTransaction()) {
		try {
			// insert client
			$query = $db->prepare($client_q);
			$query->execute([':Client_Id' => $Client_Id, 'Email' => $Email, ':Contact_Name' => $Contact_Name, ':Company_Name' => $Company_Name, ':Website' => $Website, ':Phone_No' => $Phone_No, ':Address_Line_1' => $Address_Line_1, ':Address_Line_2' => $Address_Line_2, ':City' => $City, ':Prov_State' => $Prov_State, ':Country' => $Country, ':Postal_Zip' => $Postal_Zip]);

	    	return $db->commit();
	  	} catch (Exception $e) {
	    	if ($db->inTransaction()) {
	       		$db->rollBack();
	       		throw $e;
	      	}        
	  	}
	}
}
