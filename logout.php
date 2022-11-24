<?php
/**
 * Contains code that logs the user out.
 */

require_once('init.php');
require_once('login_functions.php');

if(is_logged_in())
	session_destroy();

header("Location: /login", TRUE, 200);
die();