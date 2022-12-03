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

/**
 * Checks if a user is an admin.
 * Relies on the session being set with user role data.
 * @return boolean
 */
function is_admin() {
	$role = $_SESSION['user']['User_Type'] ?? '';

	return !empty($role) && $role == user_types()['admin'];
}