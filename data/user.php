<?php
/**
 * Find a user by username and password
 * @param  PDO $db
 * @param  string $username
 * @param  string $password
 * @return PDO query object
 */
function find_user($db, $username, $password) {
	$q = "
		SELECT * FROM User
		WHERE username = :username AND password = :password
	";

	$query = $db->prepare($q);
	$query->execute([':username' => $username, ':password' => $password]);

	return $query;
}

function add_user($db, $ssn, $username, $password, $user_type) {
	$q = "
		INSERT INTO User (ESSN, Username, Password, User_Type)
		VALUES(:ssn, :username, :password, :user_type);
	";

	$query = $db->prepare($q);
	$query->execute([
		':ssn' => $ssn,
		':username' => $username, 
		':password' => $password,
		':user_type' => $user_type
	]);

	return $query;
}
?>