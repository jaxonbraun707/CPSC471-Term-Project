<?php

function get_part($db, $part_no){
    $q = "
		SELECT  
			Part.*
		FROM Part
		WHERE Part.Part_No = :part_no
		";
    $query = $db->prepare($q);
    $query->execute([':part_no' => $part_no]);
    return $query;
}

function get_parts($db){
	$q = "
		SELECT Part.*
		FROM Part
		GROUP BY Part.Part_No
		";
	return $db->query($q);
}

function search_parts($db, $search_term){
	$q = "
		SELECT Part.*
		FROM Part
		WHERE
			Part.Part_No LIKE :search_term
		GROUP BY Part.Part_No
	";
	$query = $db->prepare($q);
	$query->execute([':search_term' => "%$search_term%"]);
	return $query;
}

function get_vendors_part($db, $part_no){
	$q = "
		SELECT Vendor.*, Vendors_Provides_Parts.Price
		FROM Part, Vendor, Vendors_Provides_Parts
		WHERE
			Part.Part_No = :part_no AND
			Part.Part_No = Vendors_Provides_Parts.Part_No AND
			Vendors_Provides_Parts.Vendor_Id = Vendor.Vendor_Id
		";
	$query = $db->prepare($q);
	$query->execute([':part_no' => $part_no]);
	return $query;
}

function get_new_vendors_part($db, $part_no){
	$q = "
		SELECT Vendor.*
		FROM Vendor
		WHERE
			Vendor.Vendor_Id NOT IN (
				SELECT Vendor_Id FROM Vendors_Provides_Parts
				WHERE Part_No = :part_no
			)
		";
	$query = $db->prepare($q);
	$query->execute([':part_no' => $part_no]);
	return $query;
}

function add_part($db, $part_no, $vendors, $price){
	$part_q = "
		INSERT INTO Part (Part_No)
		VALUES(:part_no)
	";
	$part_vendor_q = "
		INSERT INTO Vendors_Provides_Parts(`Vendor_Id`, `Part_No`, `Price`)
		VALUES (:vendor_id, :part_no, :price)
	";
	if ($db->beginTransaction()) {
		try {
			// insert order
	    	$query = $db->prepare($part_q);
			$query->execute([':part_no' => $part_no]);

			// associate order with labours
			foreach($vendors as $vendor) {
				$query = $db->prepare($part_vendor_q);
				$query->execute([':vendor_id' => $vendor, ':part_no' => $part_no, ':price' => $price]);
			}

	    	return $db->commit();
	  	} catch (Exception $e) {
	    	if ($db->inTransaction()) {
	       		$db->rollBack();

	       		throw $e;
	      	}        
	  	}
	}
}

function update_part($db, $part_no, $new_part_no){
	$q = "
		UPDATE Part
		SET Part_No = :new_part_no
		WHERE Part_No = :part_no;
	";
	$query = $db->prepare($q);
	$query->execute([':part_no' => $part_no, ':new_part_no' => $new_part_no]);
	return $query;
}

function add_vendor_part($db, $part_no, $vendor, $vendor_price){
	$q = "
		INSERT INTO Vendors_Provides_Parts (Vendor_Id, Part_No, Price)
		VALUES (:vendor, :part_no, :price)
	";
	$query = $db->prepare($q);
	$query->execute([':vendor' => $vendor, ':part_no' => $part_no, ':price' => $vendor_price]);
	return $query;
}

function delete_part($db, $part_no){
	$q = "
		DELETE FROM Part WHERE Part_No = :part_no
	";
	$query = $db->prepare($q);
	$query->execute(['part_no' => $part_no]);
	return $query;
}

function delete_vendor_part($db, $part_no, $vendor){
	$q = "
		DELETE FROM Vendors_Provides_Parts 
		WHERE Vendor_Id = :vendor AND Part_No = :part_no
	";
	$query = $db->prepare($q);
	$query->execute(['vendor' => $vendor, 'part_no' => $part_no]);
	return $query;
}


?>