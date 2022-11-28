<?php
/**
 * query for retrieving employees by a job
 * @param  PDO $db
 * @param  string $job
 * @return PDO query object object
 */
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

/**
 * Find an employee by an SSN
 * @param  PDO $db
 * @param  string $ssn
 * @return PDO query object
 */
function find_employee($db, $ssn) {
	$q = "
		SELECT * FROM Employee
		WHERE SSN = :ssn
	";
	$query = $db->prepare($q);
	$query->execute([':ssn' => $ssn]);
  
	return $query;
}

function find_regions($db, $ssn) {
	$q = "
		SELECT Sales_Region 
		FROM Regions
		WHERE Sales_SSN = :ssn
	";
	$query = $db->prepare($q);
	$query->execute(['ssn' => $ssn]);
	return $query;
}

function find_eng($db, $ssn){
	$q = "
		SELECT Eng_Specialty 
		FROM Eng_Specialties
		WHERE Eng_SSN = :ssn
	";
	$query = $db->prepare($q);
	$query->execute(['ssn' => $ssn]);
	return $query;
}

function find_lab($db, $ssn){
	$q = "
		SELECT Lab_Specialty 
		FROM Lab_Specialties
		WHERE Lab_SSN = :ssn
	";
	$query = $db->prepare($q);
	$query->execute(['ssn' => $ssn]);
	return $query;
}

function update_employee($db, $SSN, $first_name, $last_name, $DOB, $phone_no, $email, $address_line_1, $address_line_2, $city, $prov_state, $country, $postal_zip, $job_type, $sales_region, $eng_specialty, $lab_specialty, $new_SSN) {
	$emp_q = "
		UPDATE Employee
		SET SSN = :new_ssn, First_Name = :first_name, Last_Name = :last_name, DOB = :dob, Phone_No = :phone_no, Email = :email, Address_Line_1 = :address_line_1, Address_Line_2 = :address_line_2, City = :city, Prov_State = :prov_state, Country = :country, Postal_Zip = :postal_zip, Job_Type = :job_type
		WHERE SSN = :ssn
	";
	$sales_q = "
		UPDATE Regions
		SET Sales_SSN = :new_ssn, Sales_Region = :sales_region
		WHERE Sales_SSN = :ssn
	";
	$eng_q = "
		UPDATE Eng_Specialties
		SET Eng_SSN = :new_ssn, Eng_Specialty = :eng_specialty
		WHERE Eng_SSN = :ssn
	";
	$lab_q = "
		UPDATE Lab_Specialties
		SET Lab_SSN = :new_ssn, Lab_Specialty = :lab_specialty
		WHERE Lab_SSN = :ssn
	";
	$query = $db->prepare($emp_q);
			$query->execute([':ssn' => $SSN, ':first_name' => $first_name, ':last_name' => $last_name, ':dob' => $DOB, ':phone_no' => $phone_no, ':email' => $email, ':address_line_1' => $address_line_1, ':address_line_2' => $address_line_2, ':city' => $city, ':prov_state' => $prov_state, ':country' => $country, ':postal_zip' => $postal_zip, ':job_type' => $job_type, ':new_ssn' => $new_SSN]);

			if(!empty($sales_region)){
				$query = $db->prepare($sales_q);
				$query->execute([':ssn' => $SSN, ':sales_region' => $sales_region, ':new_ssn' => $new_SSN]);
			}
			else{
				delete_sales($db, $SSN);
			}

			if(!empty($eng_specialty)){
				$query = $db->prepare($eng_q);
				$query->execute([':ssn' => $SSN, ':eng_specialty' => $eng_specialty, ':new_ssn' => $new_SSN]);
			}
			else{
				delete_eng($db, $SSN);
			}

			if(!empty($lab_specialty)){
				$query = $db->prepare($lab_q);
				$query->execute([':ssn' => $SSN, ':lab_specialty' => $lab_specialty, ':new_snn' => $new_SSN]);
			}
			else{
				delete_lab($db, $SSN);
			}
	return $query;
}

function delete_sales($db, $SSN){
	$q = "
		DELETE FROM Regions WHERE Sales_SSN = :ssn
	";
	$query = $db->prepare($q);
	$query->execute([':ssn' => $SSN]);
	return $query;
}

function delete_eng($db, $SSN){
	$q = "
		DELETE FROM Eng_Specialties WHERE Eng_SSN = :ssn
	";
	$query = $db->prepare($q);
	$query->execute([':ssn' => $SSN]);
	return $query;
}

function delete_lab($db, $SSN){
	$q = "
		DELETE FROM Lab_Specialties WHERE Lab_SSN = :ssn
	";
	$query = $db->prepare($q);
	$query->execute([':ssn' => $SSN]);
	return $query;
}

function delete_employee($db, $SSN){
	delete_sales($db, $SSN);
	delete_eng($db, $SSN);
	delete_lab($db, $SSN);
	$q = "
		DELETE FROM Employee WHERE SSN = :ssn
	";
	$query = $db->prepare($q);
	$query->execute([':ssn' => $SSN]);
	return $query;
}
