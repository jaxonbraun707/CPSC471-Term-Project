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
function add_design($db, $design_no, $budget, $authors, $drawings) {
	$design_q = "
		INSERT INTO Design (Design_No, Budget)
		VALUES (:design_no, :budget)
	";

	$author_q = "
		INSERT INTO Engineering_Designs (Eng_SSN, Design_No)
		VALUES (:author, :design_no)
	";

	$drawing_q = "
		INSERT INTO Drawings (Design_No, Drawing_No)
		VALUES (:design_no, :drawing_no)
	";

	if ($db->beginTransaction()) {
		try {
			// insert designs
	    	$query = $db->prepare($design_q);
			$query->execute([':design_no' => $design_no, ':budget' => $budget]);

			// associate designs with authors
			foreach($authors as $author) {
				$query = $db->prepare($author_q);
				$query->execute([':design_no' => $design_no, ':author' => $author]);
			}

			// associate designs with drawings
			foreach($drawings as $drawing) {
				$query = $db->prepare($drawing_q);
				$query->execute([':design_no' => $design_no, ':drawing_no' => $drawing]);
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

function delete_design($db, $design_no) {
	$q = "
		DELETE FROM Design WHERE Design_No = :design_no
	";
	$query = $db->prepare($q);
	$query->execute(['design_no' => $design_no]);
	return $query;
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

function find_design($db, $design_no) {
	$q = "
		SELECT  
			Design.*
		FROM Design
		WHERE
			Design.Design_No = :design_no
		";
	$query = $db->prepare($q);
	$query->execute([':design_no' => $design_no]);
	return $query;
}

function get_new_design_authors($db, $design_no, $job) {
	$q = "
		SELECT  
			Employee.*
		FROM Employee
		WHERE
			Employee.Job_Type = :job AND
			Employee.SSN NOT IN (
				SELECT Eng_SSN FROM Engineering_Designs
				WHERE Design_No = :design_no
			)
		";
	$query = $db->prepare($q);
	$query->execute([':design_no' => $design_no, ':job' => $job]);
	return $query;
}

function find_design_authors($db, $design_no) {
	$q = "
		SELECT  
			Employee.*
		FROM Design, Engineering_Designs, Employee
		WHERE
			Design.Design_No = :design_no AND
			Design.Design_No = Engineering_Designs.Design_No AND
			Engineering_Designs.Eng_SSN = Employee.SSN
		";
	$query = $db->prepare($q);
	$query->execute([':design_no' => $design_no]);
	return $query;
}

function add_design_author($db, $design_no, $ssn) {
	$q = "
		INSERT INTO Engineering_Designs (Design_No, Eng_SSN)
		VALUES (:design_no, :ssn);
	";
	$query = $db->prepare($q);
	$query->execute(['design_no' => $design_no, 'ssn' => $ssn]);
	return $query;
} 

function delete_design_author($db, $design_no, $ssn) {
	$q = "
		DELETE FROM Engineering_Designs
		WHERE 
			design_no = :design_no AND
			Eng_SSN = :ssn
	";
	$query = $db->prepare($q);
	$query->execute(['design_no' => $design_no, 'ssn' => $ssn]);
	return $query;
}

function find_design_drawings($db, $design_no) {
	$q = "
		SELECT * FROM Drawings
		WHERE 
			design_no = :design_no
	";
	$query = $db->prepare($q);
	$query->execute(['design_no' => $design_no]);
	return $query;
}

function add_design_drawing($db, $design_no, $drawing) {
	$q = "
		INSERT INTO Drawings (Design_No, Drawing_No)
		VALUES (:design_no, :drawing)
	";
	$query = $db->prepare($q);
	$query->execute(['design_no' => $design_no, 'drawing' => $drawing]);
	return $query;
}

function delete_design_drawing($db, $design_no, $drawing) {
	$q = "
		DELETE FROM Drawings
		WHERE 
			design_no = :design_no AND
			Drawing_No = :drawing
	";
	$query = $db->prepare($q);
	$query->execute(['design_no' => $design_no, 'drawing' => $drawing]);
	return $query;
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

function update_design($db, $design_no, $budget, $new_design_no) {
	$q = "
		UPDATE Design
		SET Design_No = :new_design_no, Budget = :budget
		WHERE Design_No = :design_no;
	";
	$query = $db->prepare($q);
	$query->execute([':design_no' => $design_no, ':budget' => $budget, ':new_design_no' => $new_design_no]);
	return $query;
}