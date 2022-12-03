<?php

function get_vendors($db){
    $q = "
		SELECT *
		FROM Vendor
		GROUP BY Vendor.Vendor_Id
		";
	return $db->query($q);
}

function get_vendor($db, $vendor_id){
	$q = "
		SELECT  
			Vendor.*
		FROM Vendor
		WHERE Vendor.Vendor_Id = :vendor_id
		";
    $query = $db->prepare($q);
    $query->execute([':vendor_id' => $vendor_id]);
    return $query;
}

function search_vendors($db, $search_term){
	$q = "
		SELECT Vendor.*
		FROM Vendor
		WHERE
			Vendor.Vendor_Name LIKE :search_term
		GROUP BY Vendor.Vendor_Id
	";
	$query = $db->prepare($q);
	$query->execute([':search_term' => "%$search_term%"]);
	return $query;
}

function get_parts_vendor($db, $vendor_id){
	$q = "
		SELECT Part.*, Vendors_Provides_Parts.Price
		FROM Part, Vendor, Vendors_Provides_Parts
		WHERE
			Vendor.Vendor_Id = :vendor_id AND
			Vendor.Vendor_Id = Vendors_Provides_Parts.Vendor_Id AND
			Vendors_Provides_Parts.Part_No = Part.Part_No
		";
	$query = $db->prepare($q);
	$query->execute([':vendor_id' => $vendor_id]);
	return $query;
}

function get_new_parts_vendor($db, $vendor_id){
	$q = "
		SELECT Part.*
		FROM Part
		WHERE
			Part.Part_No NOT IN (
				SELECT Part_No FROM Vendors_Provides_Parts
				WHERE Vendor_Id = :vendor_id
			)
		";
	$query = $db->prepare($q);
	$query->execute([':vendor_id' => $vendor_id]);
	return $query;
}

function add_vendor($db, $vendor_id, $vendor_name, $vendor_phone_no, $parts, $price){
	$vendor_q = "
		INSERT INTO Vendor (Vendor_Id, Vendor_Name, Phone_No)
		VALUES(:vendor_id, :vendor_name, :phone_no)
	";
	$part_vendor_q = "
		INSERT INTO Vendors_Provides_Parts(`Vendor_Id`, `Part_No`, `Price`)
		VALUES (:vendor_id, :part_no, :price)
	";
	if ($db->beginTransaction()) {
		try {
	    	$query = $db->prepare($vendor_q);
			$query->execute([':vendor_id' => $vendor_id, 'vendor_name' => $vendor_name, 'phone_no' => $vendor_phone_no]);

			foreach($parts as $part) {
				$query = $db->prepare($part_vendor_q);
				$query->execute([':vendor_id' => $vendor_id, ':part_no' => $part, ':price' => $price]);
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


function update_vendor($db, $vendor_id, $vendor_name, $vendor_phone_no, $new_vendor_id){
	$q = "
		UPDATE Vendor
		SET Vendor_Id = :new_vendor_id, Vendor_Name = :name, Phone_No = :phone
		WHERE Vendor_Id = :vendor_id;
	";
	$query = $db->prepare($q);
	$query->execute([':vendor_id' => $vendor_id, ':new_vendor_id' => $new_vendor_id, ':name' => $vendor_name, ':phone' => $vendor_phone_no]);
	return $query;
}

function add_part_vendor($db, $vendor_id, $part, $vendor_price){
	$q = "
		INSERT INTO Vendors_Provides_Parts (Vendor_Id, Part_No, Price)
		VALUES (:vendor, :part_no, :price)
	";
	$query = $db->prepare($q);
	$query->execute([':vendor' => $vendor_id, ':part_no' => $part, ':price' => $vendor_price]);
	return $query;
}

function delete_vendor($db, $vendor_id){
	$q = "
		DELETE FROM Vendor WHERE Vendor_Id = :vendor_id
	";
	$query = $db->prepare($q);
	$query->execute(['vendor_id' => $vendor_id]);
	return $query;
}

function delete_part_vendor($db, $vendor_id, $part){
	$q = "
		DELETE FROM Vendors_Provides_Parts 
		WHERE Vendor_Id = :vendor AND Part_No = :part_no
	";
	$query = $db->prepare($q);
	$query->execute(['vendor' => $vendor_id, 'part_no' => $part]);
	return $query;
}

?>