<?php
require_once('../init.php');
require_once('../db.php');
require_once('../login_functions.php');
require_once('../data/user.php');

// logged in users don't have to access this page.
if(is_logged_in()) {
	header("Location: /", 200);
	die();
}

// immediately return error message when logging in w/ incomplete credentials
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
if(empty($username) || empty($password)) {
	$error = 'Username and password are required.';
	$_SESSION['error'] = $error;
	header("Location: /login", 200);
	die();
}

// validate credentials
$user = find_user($db, $username, $password)->fetch();
if(!$user) {
	$error = 'Invalid username or password was entered.';
	$_SESSION['error'] = $error;
	header("Location: /login", 200);
	die();
}

// retrieve employee data
require_once('../data/employee.php');
$employee = find_employee($db, $user['ESSN']);
if(empty($employee)) {
	$error = 'User does not have associated employee data.';
	$_SESSION['error'] = $error;
	header("Location: /login", 200);
	die();
}


// store user and employee data to the session
$_SESSION['user'] = $user;
$_SESSION['user']['employee'] = $employee->fetch();

header("Location: ../", 200);
die();
?>