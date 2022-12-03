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
?>