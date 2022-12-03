<?php

function get_orders($db){
    $q = "
		SELECT Orders.*
		FROM Orders 
		GROUP BY Order_No
		";
    return $db->query($q);
}

function search_orders($db, $search_term){
    $q = "
		SELECT Orders.*
		FROM Orders
		WHERE
		    Orders.Order_No LIKE :search_term OR
		    Orders.Project_No LIKE :search_term
		GROUP BY Order_No
	";

    $query = $db->prepare($q);
    $query->execute([':search_term' => "%$search_term%"]);
    return $query;
}

function find_order($db, $order_no){
	$q = "
		SELECT Orders.*
		FROM Orders
		WHERE Orders.Order_No = :order_no
		";
	$query = $db->prepare($q);
	$query->execute([':order_no' => $order_no]);
	return $query;
}

function find_order_labours($db, $order_no){
	$q = "
		SELECT Employee.*, Labour_Order.Start_Date, Labour_Order.Hours
		FROM Orders, Employee, Labour_Order
		WHERE
			Orders.Order_No = :order_no AND
			Orders.Order_No = Labour_Order.Order_No AND
			Labour_Order.Labour_SSN = Employee.SSN
		";
	$query = $db->prepare($q);
	$query->execute([':order_no' => $order_no]);
	return $query;
}

function find_order_parts($db, $order_no){
	$q = "
		SELECT Parts_Inventory.*
		FROM Orders, Part, Parts_Inventory
		WHERE
			Orders.Order_No = :order_no AND
			Orders.Order_No = Parts_Inventory.Order_No AND
			Parts_Inventory.Order_No = Part.Part_No
		";
	$query = $db->prepare($q);
	$query->execute([':order_no' => $order_no]);
	return $query;
}

function get_new_order_labours($db, $order_no, $job) {
	$q = "
		SELECT Employee.*
		FROM Employee
		WHERE
			Employee.Job_Type = :job AND
			Employee.SSN NOT IN (
				SELECT Labour_SSN FROM Labour_Order
				WHERE Order_No = :order_no
			)
		";
	$query = $db->prepare($q);
	$query->execute([':order_no' => $order_no, ':job' => $job]);
	return $query;
}

function add_order($db, $order_no, $project_no, $ship_date, $labours, $labour_date, $labour_hours){
	$order_q = "
		INSERT INTO Orders (Order_No, Ship_Date, Project_No)
		VALUES(:order_no, :ship_date, project_no)
	";
	$labour_q = "
		INSERT INTO Labour_Order (Labour_SSN, Order_No, Start_Date, Hours)
		VALUES (:labour, :order_no, :start_date, :hours)
	";
	if ($db->beginTransaction()) {
		try {
			// insert order
	    	$query = $db->prepare($order_q);
			$query->execute([':order_no' => $order_no, ':ship_date' => $ship_date, ':project_no' => $project_no]);

			// associate order with labours
			foreach($labours as $labour) {
				$query = $db->prepare($labour_q);
				$query->execute([':order_no' => $order_no, ':labour' => $labour, ':start_date' => $labour_date, ':hours' => $labour_hours]);
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

function add_order_labour($db, $order_no, $labour, $labour_date, $labour_hours){
	$q = "
		INSERT INTO Labour_Order (Labour_SSN, Order_No, Start_Date, Hours)
		VALUES (:labour, :order_no, :start_date, :hours)
	";
	$query = $db->prepare($q);
	$query->execute([':order_no' => $order_no, ':labour' => $labour, ':start_date' => $labour_date, ':hours' => $labour_hours]);
	return $query;
}

function add_order_part($db, $order_no, $part_no, $qty){
	$q = "
		INSERT INTO Parts_Inventory (Order_No, Part_No, Qty)
		VALUES (:order_no, :part_no, :qty)
	";
	$query = $db->prepare($q);
	$query->execute([':order_no' => $order_no,':part_no' => $part_no, ':qty' => $qty]);
	return $query;
}

function update_order($db, $order_no, $new_order_no, $project_no, $ship_date){
	$q = "
		UPDATE Orders
		SET Order_No = :new_order_no, Ship_Date = :ship_date, Project_No = :project_no
		WHERE Order_No = :order_no;
	";
	$query = $db->prepare($q);
	$query->execute([':order_no' => $order_no, ':ship_date' => $ship_date, ':new_order_no' => $new_order_no, ':project_no' => $project_no]);
	return $query;
}

function delete_order_labour($db, $order_no, $labour){
	$q = "
		DELETE FROM Labour_Order 
		WHERE Order_No = :order_no AND Labour_SSN = :labour
	";
	$query = $db->prepare($q);
	$query->execute(['order_no' => $order_no, 'labour' => $labour]);
	return $query;
}

function delete_order_part($db, $order_no, $part_no){
	$q = "
		DELETE FROM Parts_Inventory 
		WHERE Order_No = :order_no AND Part_No = :part_no
	";
	$query = $db->prepare($q);
	$query->execute(['order_no' => $order_no, 'part_no' => $part_no]);
	return $query;
}

function delete_order($db, $order_no){
	
	$q = "
		DELETE FROM Orders WHERE Order_No = :order_no
	";
	$query = $db->prepare($q);
	$query->execute(['order_no' => $order_no]);
	return $query;
}


?>