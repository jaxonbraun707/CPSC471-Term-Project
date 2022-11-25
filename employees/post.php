<?php
$dbname = 'worc';
$db = new PDO("mysql:host=localhost;dbname=$dbname", 'root', '');

function add_employee($db, $SSN, $First_Name, $Last_Name, $DOB, $Phone_No, $Email, $Address_Line_1, $Address_Line_2, $City, $Prov_State, $Country, $Postal_Zip, $Job_Type) {
	$q = "
		INSERT INTO Employee
		VALUES (:SSN, :First_Name, :Last_Name, :DOB, :Phone_No, :Email, :Address_Line_1, :Address_Line_2, :City, :Prov_State, :Country, :Postal_Zip, :Job_Type)
	";
	$query = $db->prepare($q);
	$query->execute([':SSN' => $SSN, ':First_Name' => $First_Name, ':Last_Name' => $Last_Name, ':DOB' => $DOB, ':Phone_No' => $Phone_No, ':Email' => $Email, ':Address_Line_1' => $Address_Line_1, ':Address_Line_2' => $Address_Line_2, ':City' => $City, ':Prov_State' => $Prov_State, ':Country' => $Country, ':Postal_Zip' => $Postal_Zip, ':Job_Type' => $Job_Type]);
}

add_employee($db, $_POST['SSN'], $_POST['First_Name'], $_POST['Last_Name'], $_POST['DOB'], $_POST['Phone_No'], $_POST['Email'], $_POST['Address_Line_1'], $_POST['Address_Line_2'], $_POST['City'], $_POST['Prov_State'], $_POST['Country'], $_POST['Postal_Zip'], $_POST['Job_Type']);

// TODO: handle errors

// successfully redirect back to employee listing
// return status code 201 as a sign that the post request was successful
header("Location: ../employees");
die();
?>