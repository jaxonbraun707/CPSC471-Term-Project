<?php
$dbname = 'worc';
$db = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');

function add_design($db, $design_no, $budget) {
	$q = "
		INSERT INTO Design
		VALUES (:design_no, :budget)
	";
	$query = $db->prepare($q);
	$query->execute([':design_no' => $design_no, ':budget' => $budget]);
}

add_design($db, $_POST['design_no'], $_POST['budget']);

// TODO: handle errors

// successfully redirect back to designs listing
// return status code 201 as a sign that the post request was successful
header("Location: /designs", TRUE, 201);
die();
?>