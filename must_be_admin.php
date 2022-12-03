<?php
/**
 * Simply require this file in a page if you want that page to only be 
 * accessible by admin users.
 */

require_once('init.php');
require_once('login_functions.php');

/**
 * only show unauthorized page if not admin otherwise
 * let code under this execute.
 */
if(!is_admin()) {
	include_once(BASE_PATH . '/templates/401.php');
	die();
}