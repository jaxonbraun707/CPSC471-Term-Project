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