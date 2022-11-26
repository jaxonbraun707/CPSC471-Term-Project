<?php
/**
 * Insert a design to the database along with
 * related entitites.
 * @param PDO $db        
 * @param int $design_no 
 * @param int $budget    
 * @param array $authors   SSNs of authors
 *
 * TODO: include drawings.
 */
function add_design($db, $design_no, $budget, $authors) {
	$design_q = "
		INSERT INTO Design (Design_No, Budget)
		VALUES (:design_no, :budget)
	";

	$author_q = "
		INSERT INTO Engineering_Designs (Eng_SSN, Design_No)
		VALUES (:author, :design_no)
	";

	if ($db->beginTransaction()) {
		try {
			// insert designs
	    	$query = $db->prepare($design_q);
			$query->execute([':design_no' => $design_no, ':budget' => $budget]);

			// assocate designs with authors
			foreach($authors as $author) {
				$query = $db->prepare($author_q);
				$query->execute([':design_no' => $design_no, ':author' => $author]);
			}

	    	return $db->commit();
	  	} catch (Exception $e) {
	    	if ($db->inTransaction()) {
	       		$db->rollBack();

	       		throw $e;
	      	}        
	  	}
	}
}

/**
 * query for retrieving all designs
 * @param  PDO $db
 * @return $query     query object
 */
function get_designs($db) {	
	$q = "
		SELECT  
			Design.*
		FROM Design, Engineering_Designs, Employee, User
		WHERE
			Design.Design_No = Engineering_Designs.Design_No AND
			Engineering_Designs.Eng_SSN = Employee.SSN AND
			Employee.SSN = User.ESSN
		GROUP BY Design_No
		";
	return $db->query($q);
}

/**
 * limit designs by searching against number, and some employee details
 * @param  PDO $db          
 * @param  string $search_term 
 * @return $query              query object
 */
function search_designs($db, $search_term) {
	$q = "
		SELECT  
			Design.*
		FROM Design, Engineering_Designs, Employee, User
		WHERE
			Design.Design_No = Engineering_Designs.Design_No AND
			Engineering_Designs.Eng_SSN = Employee.SSN AND
			Employee.SSN = User.ESSN AND
			(
				Design.Design_No LIKE :search_term OR
				Employee.First_Name LIKE :search_term OR
				Employee.Last_Name LIKE :search_term OR
				User.username LIKE :search_term
			)
		GROUP BY Design_No
	";

	$query = $db->prepare($q);
	$query->execute([':search_term' => "%$search_term%"]);

	return $query;
}