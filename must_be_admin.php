<?php
/**
 * Simply require this file in a page if you want that page to only be 
 * accessible by admin users.
 */

require_once('init.php');

/**
 * Checks if a user is an admin.
 * Relies on the session being set with user role data.
 * @return boolean
 */
function is_admin() {
	$role = $_SESSION['user']['User_Type'] ?? '';

	return !empty($role) && $role == user_types()['admin'];
}

/**
 * only show unauthorized page if not admin otherwise
 * let code under this execute.
 */
if(!is_admin()) {
	include_once('templates/401.php');
	die();
}