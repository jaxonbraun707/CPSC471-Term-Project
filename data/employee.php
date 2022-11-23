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

function add_employee($db, $SSN, $First_Name, $Last_Name, $DOB, $Phone_No, $Email, $Address_Line_1, $Address_Line_2, $City, $Prov_State, $Country, $Postal_Zip, $Job_Type) {
	$q = "
		INSERT INTO Employee
		VALUES (:SSN, :First_Name, :Last_Name, :DOB, :Phone_No, :Email, :Address_Line_1, :Address_Line_2, :City, :Prov_State, :Country, :Postal_Zip, :Job_Type)
	";
	$query = $db->prepare($q);
	$query->execute([':SSN' => $SSN, ':First_Name' => $First_Name, ':Last_Name' => $Last_Name, ':DOB' => $DOB, ':Phone_No' => $Phone_No, ':Email' => $Email, ':Address_Line_1' => $Address_Line_1, ':Address_Line_2' => $Address_Line_2, ':City' => $City, ':Prov_State' => $Prov_State, ':Country' => $Country, ':Postal_Zip' => $Postal_Zip, ':Job_Type' => $Job_Type]);
}