<?php
/**
 * Must be in every page that uses sessions; including but not limited to:
 * - pages that require log in
 *
 * also contains helper functions and easily accessible configuration variables.
 */

session_start();

/**
 * returns value of error in SESSION global and the SESSION.
 * @return array array containing the error
 */
function get_error_in_session() {
	if (!isset($_SESSION['error'])) {
		return '';
	}

	$error = $_SESSION['error'];
	$_SESSION['error'] = '';
	return $error;
}

// config
$_job_types = [
	'sales' => 'Sales',
	'engineering' => 'Engineering'
];

function user_types() {
	return [
		'admin' => 'Admin',
		'regular' => 'Regular'
	];
}