<?php
function add_submittal($db, $submittal_no, $contract, $authors) {
	$author_q = "
		INSERT INTO Engineering_Submittals (Eng_SSN, Submittal_No)
		VALUES (:author, :submittal_no)
	";

	if ($db->beginTransaction()) {
		try {
			// insert submittal
			if(empty($contract)) {
				$submittal_q = "
					INSERT INTO Submittal (Submittal_No, Contract_No)
					VALUES (:submittal_no, NULL)
				";
	    		$query = $db->prepare($submittal_q);
				$query->execute([':submittal_no' => $submittal_no]);
			} else {
				$submittal_q = "
					INSERT INTO Submittal (Submittal_No, Contract_No)
					VALUES (:submittal_no, :contract_no)
				";
				$query = $db->prepare($submittal_q);
				$query->execute([':submittal_no' => $submittal_no, ':contract_no' => $contract]);
			}

			// associate submittals with authors
			foreach($authors as $author) {
				$query = $db->prepare($author_q);
				$query->execute([':submittal_no' => $submittal_no, ':author' => $author]);
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

function add_submittal_attachment($db, $submittal_no, $attachment) {
	$q = "
		INSERT INTO Submittals_Attachments (Submittal_No, Filename)
		VALUES (:submittal_no, :attachment)
	";

	$query = $db->prepare($q);
	$query->execute([':submittal_no' => $submittal_no, ':attachment' => $attachment]);
}

function delete_submittal_attachment($db, $submittal_no, $attachment) {
	$q = "
		DELETE FROM Submittals_Attachments
		WHERE 
			Submittal_no = :submittal_no AND
			Attachment_No = :attachment
	";
	$query = $db->prepare($q);
	$query->execute(['submittal_no' => $submittal_no, 'attachment' => $attachment]);
	return $query;
}

function add_submittal_author($db, $submittal_no, $ssn) {
	$q = "
		INSERT INTO Engineering_Submittals (Submittal_No, Eng_SSN)
		VALUES (:submittal_no, :ssn);
	";
	$query = $db->prepare($q);
	$query->execute(['submittal_no' => $submittal_no, 'ssn' => $ssn]);
	return $query;
}

function delete_submittal_author($db, $submittal_no, $ssn) {
	$q = "
		DELETE FROM Engineering_Submittals
		WHERE 
			submittal_no = :submittal_no AND
			Eng_SSN = :ssn
	";
	$query = $db->prepare($q);
	$query->execute(['submittal_no' => $submittal_no, 'ssn' => $ssn]);
	return $query;
}

function find_submittal($db, $submittal_no) {
	$q = "
		SELECT  
			Submittal.*
		FROM Submittal
		WHERE
			Submittal.Submittal_No = :submittal_no
		";
	$query = $db->prepare($q);
	$query->execute([':submittal_no' => $submittal_no]);
	return $query;
}

function find_submittal_authors($db, $submittal_no) {
	$q = "
		SELECT  
			Employee.*
		FROM Submittal, Engineering_Submittals, Employee
		WHERE
			Submittal.Submittal_No = :submittal_no AND
			Submittal.Submittal_No = Engineering_Submittals.Submittal_No AND
			Engineering_Submittals.Eng_SSN = Employee.SSN
		";
	$query = $db->prepare($q);
	$query->execute([':submittal_no' => $submittal_no]);
	return $query;
}

function find_submittal_attachments($db, $submittal_no) {
	$q = "
		SELECT * FROM Submittals_Attachments
		WHERE 
			submittal_no = :submittal_no
	";
	$query = $db->prepare($q);
	$query->execute(['submittal_no' => $submittal_no]);
	return $query;
}

function get_new_submittal_authors($db, $submittal_no, $job) {
	$q = "
		SELECT  
			Employee.*
		FROM Employee
		WHERE
			Employee.Job_Type = :job AND
			Employee.SSN NOT IN (
				SELECT Eng_SSN FROM Engineering_Submittals
				WHERE Submittal_No = :submittal_no
			)
		";
	$query = $db->prepare($q);
	$query->execute([':submittal_no' => $submittal_no, ':job' => $job]);
	return $query;
}

function get_submittals($db) {	
	$q = "
		SELECT  
			Submittal.*,
			Attachments.Count
		FROM 
			Submittal, Engineering_Submittals, Employee, User,
			(
                SELECT
                	Submittal.Submittal_No, COUNT(Submittals_Attachments.Attachment_No) as Count
                FROM Submittal LEFT OUTER JOIN Submittals_Attachments ON Submittal.Submittal_No = Submittals_Attachments.Submittal_No
                GROUP BY Submittal.Submittal_No
            ) as Attachments
		WHERE
			Submittal.Submittal_No = Engineering_Submittals.Submittal_No AND
            Submittal.Submittal_No = Attachments.Submittal_No AND
			Engineering_Submittals.Eng_SSN = Employee.SSN AND
			Employee.SSN = User.ESSN
		GROUP BY
			Submittal.Submittal_No
		";
	return $db->query($q);
}

function search_submittals($db, $search_term) {	
	$q = "
		SELECT  
			Submittal.*,
			Attachments.Count
		FROM 
			Submittal, Engineering_Submittals, Employee, User,
			(
                SELECT
                	Submittal.Submittal_No, COUNT(Submittals_Attachments.Attachment_No) as Count
                FROM Submittal LEFT OUTER JOIN Submittals_Attachments ON Submittal.Submittal_No = Submittals_Attachments.Submittal_No
                GROUP BY Submittal.Submittal_No
            ) as Attachments
		WHERE
			Submittal.Submittal_No = Engineering_Submittals.Submittal_No AND
            Submittal.Submittal_No = Attachments.Submittal_No AND
			Engineering_Submittals.Eng_SSN = Employee.SSN AND
			Employee.SSN = User.ESSN AND
			(
				Submittal.Submittal_No LIKE :search_term OR
				Employee.First_Name LIKE :search_term OR
				Employee.Last_Name LIKE :search_term OR
				User.username LIKE :search_term
			)
		GROUP BY
			Submittal.Submittal_No
		";
	$query = $db->prepare($q);
	$query->execute([':search_term' => "%$search_term%"]);

	return $query;
}

function update_submittal($db, $submittal_no, $contract, $new_submittal_no) {
	if(empty($contract)) {
		$q = "
			UPDATE Submittal
			SET Submittal_No = :new_submittal_no, Contract_No = NULL
			WHERE Submittal_No = :submittal_no;
		";

		$query = $db->prepare($q);
		$query->execute([':submittal_no' => $submittal_no, ':new_submittal_no' => $new_submittal_no]);
	} else {
		$q = "
			UPDATE Submittal
			SET Submittal_No = :new_submittal_no, Contract_No = :contract
			WHERE Submittal_No = :submittal_no;
		";

		$query = $db->prepare($q);
		$query->execute([':submittal_no' => $submittal_no, ':contract' => $contract, ':new_submittal_no' => $new_submittal_no]);
	}
	return $query;
}

function delete_submittal($db, $submittal_no) {
	$q = "
		DELETE FROM Submittal WHERE Submittal_No = :submittal_no
	";
	$query = $db->prepare($q);
	$query->execute(['submittal_no' => $submittal_no]);
	return $query;
}
?>