<?php
function get_employees_by_job($db, $job) {
	$q = "
		SELECT * FROM Employee, User
		WHERE job_type = :job_type AND Employee.SSN = User.ESSN
	";
	$query = $db->prepare($q);
	$query->execute([':job_type' => $job]);

	return $query;
}


function add_employee($db, $SSN, $First_Name, $Last_Name, $DOB, $Phone_No, $Email, $Address_Line_1, $Address_Line_2, $City, $Prov_State, $Country, $Postal_Zip, $Job_Type, $Sales_Region, $Eng_Specialty, $Lab_Specialty) {
	$emp_q = "
		INSERT INTO Employee
		VALUES (:SSN, :First_Name, :Last_Name, :DOB, :Phone_No, :Email, :Address_Line_1, :Address_Line_2, :City, :Prov_State, :Country, :Postal_Zip, :Job_Type)
	";

	$sales_q = "
		INSERT INTO Regions (Sales_SSN, Sales_Region)
		VALUES (:SSN, :Sales_Region)
	";

	$eng_q = "
		INSERT INTO Eng_Specialties (Eng_SSN, Eng_Specialty)
		VALUES (:SSN, :Eng_Specialty)
	";

	$lab_q = "
		INSERT INTO Lab_Specialties (Lab_SSN, Lab_Specialty)
		VALUES (:SSN, :Lab_Specialty)
	";

	if ($db->beginTransaction()) {
		try {
			// insert designs
			$query = $db->prepare($emp_q);
			$query->execute([':SSN' => $SSN, ':First_Name' => $First_Name, ':Last_Name' => $Last_Name, ':DOB' => $DOB, ':Phone_No' => $Phone_No, ':Email' => $Email, ':Address_Line_1' => $Address_Line_1, ':Address_Line_2' => $Address_Line_2, ':City' => $City, ':Prov_State' => $Prov_State, ':Country' => $Country, ':Postal_Zip' => $Postal_Zip, ':Job_Type' => $Job_Type]);

			if(!empty($Sales_Region)){
				$query = $db->prepare($sales_q);
				$query->execute([':SSN' => $SSN, ':Sales_Region' => $Sales_Region]);
			}

			if(!empty($Eng_Specialty)){
				$query = $db->prepare($eng_q);
				$query->execute([':SSN' => $SSN, ':Eng_Specialty' => $Eng_Specialty]);
			}

			if(!empty($Lab_Specialty)){
				$query = $db->prepare($lab_q);
				$query->execute([':SSN' => $SSN, ':Lab_Specialty' => $Lab_Specialty]);
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

function get_employees($db) {
	$q = "
		SELECT Employee.*
		FROM Employee, User
		WHERE SSN = ESSN
		GROUP BY SSN
		";
	return $db->query($q);
}

function search_employees($db, $search_term) {
	$q = "
		SELECT Employee.*
		FROM Employee, User
		WHERE SSN = ESSN AND
		(
			Employee.SSN LIKE :search_term OR
			Employee.First_Name LIKE :search_term OR
			Employee.Last_Name LIKE :search_term OR
			Employee.Job_Type LIKE :search_term OR
			User.username LIKE :search_term
		)
		GROUP BY SSN
	";

	$query = $db->prepare($q);
	$query->execute([':search_term' => "%$search_term%"]);
	return $query;

}