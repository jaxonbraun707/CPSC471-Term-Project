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