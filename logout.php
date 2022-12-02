<?php
/**
 * Contains code that logs the user out.
 */

require_once('init.php');
require_once('login_functions.php');

if(is_logged_in())
	session_destroy();

<<<<<<< HEAD
header("Location:/" . BASE_URL . "/login");
=======
header("Location: " . BASE_URL . "/login");
>>>>>>> 0b16f903d7b3e48248f609294f7558b29f0106b7
die();