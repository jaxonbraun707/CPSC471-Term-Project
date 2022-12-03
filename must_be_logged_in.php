<?php
/**
 * Simply require this file in a page if you want that page to only be 
 * accessible by logged-in users.
 */

require_once('init.php');
require_once('login_functions.php');

/**
 * redirects to log-in page if no user is logged in
 */
if(!is_logged_in()) {
	$login = BASE_URL . "/login/";
	header("Location: $login", TRUE, 200);
	die();
}