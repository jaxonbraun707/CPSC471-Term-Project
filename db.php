<?php
/**
 * Establishes connection to the worc database.
 * Also, gives you a $db variable which you can use to perform actions on the db.
 */

$dbname = 'worc';
try {
	$db = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');
} catch(Exception $e) {
	echo 'Could not connect to the database.';
	die();
}
?>