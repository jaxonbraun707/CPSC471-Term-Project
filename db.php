<?php
$dbname = 'worc';
try {
	$db = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');
} catch(Exception $e) {
	echo 'Could not connect to the database.';
	die();
}
?>