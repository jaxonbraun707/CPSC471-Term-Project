<?php
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