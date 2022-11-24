<?php
require_once('data/user.php');

/**
 * Checks if a user has logged in.
 * Pretty much relies on the session set with a user.
 * @return boolean
 */
function is_logged_in() {
	$username = $_SESSION['user']['Username'] ?? '';

	return !empty($username);
}