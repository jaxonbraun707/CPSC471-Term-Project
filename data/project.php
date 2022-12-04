<?php
function add_project($db, $design, $contract, $start_date, $end_date) {
	$project_q = "
		INSERT INTO Project (Design_No, Contract_No, Start_Date, End_Date)
		VALUES (:design_no, :contract_no, :start_date, :end_date);
	";

	if ($db->beginTransaction()) {
		try {
			// insert designs
	    	$query = $db->prepare($project_q);
			$query->execute([
				':design_no' => $design,
				':contract_no' => $contract,
				':start_date' => $start_date,
				':end_date' => $end_date
			]);

	    	return $db->commit();
	  	} catch (Exception $e) {
	    	if ($db->inTransaction()) {
	       		$db->rollBack();

	       		throw $e;
	      	}        
	  	}
	}
}

function get_projects($db) {
	$q = "
		SELECT 
			Project.*, Client.*, Design.*
		FROM
			Project, Contract, Design, Client, Orders
		WHERE 
			Project.Contract_No = Contract.Contract_No AND
			Contract.Client_Id = Client.Client_Id AND
			Orders.Project_No = Project.Project_No AND
			Design.Design_No = Project.Design_No
	";

	return $db->query($q);
}

function search_projects($db, $search_term) {
	$q = "
		SELECT 
			Project.*, Client.*, Design.*
		FROM
			Project, Contract, Design, Client, Orders
		WHERE 
			Project.Contract_No = Contract.Contract_No AND
			Contract.Client_Id = Client.Client_Id AND
			Orders.Project_No = Project.Project_No AND
			Design.Design_No = Project.Design_No AND (
				Project.Project_No LIKE :search_term OR
				Client.Company_Name LIKE :search_term OR
				Client.Contact_Name LIKE :search_term
			)
	";

	$query = $db->prepare($q);
	$query->execute([':search_term' => "%$search_term%"]);

	return $query;
}

function find_project($db, $project_no) {
	$q = "
		SELECT 
			Project.*, Client.*, Design.*, Contract.*, Orders.*
		FROM
			Project, Contract, Design, Client, Orders
		WHERE 
			Project.Contract_No = Contract.Contract_No AND
			Contract.Client_Id = Client.Client_Id AND
			Orders.Project_No = Project.Project_No AND
			Design.Design_No = Project.Design_No AND
			Project.Project_No = :project_no
	";
	$query = $db->prepare($q);
	$query->execute([':project_no' => $project_no]);
	return $query;
}

function get_project_employees($db, $project_no) {
	$q = "
		(SELECT
			Employee.*
		FROM
			Orders, Employee, Labour_Order
		WHERE
			Orders.Project_No = :project_no AND
			Labour_Order.Order_No = Orders.Order_NO AND
			Employee.SSN = Labour_Order.Labour_SSN
		)
		UNION
		(SELECT
			Employee.*
		FROM
			Sales_Proposals, Contract, Proposal, Employee, Project
		WHERE
			Project.Project_No = :project_no AND
			Project.Contract_No = Contract.Contract_No AND
			Contract.Proposal_No = Sales_Proposals.Proposal_No AND
			Employee.SSN = Sales_Proposals.Sales_SSN
		)
		UNION
		(
		SELECT 
			Employee.*
		FROM 
			Project, Engineering_Designs, Employee
		WHERE
			Project.Project_No = :project_no AND
			Project.Design_No = Engineering_Designs.Design_No AND
			Employee.SSN = Engineering_Designs.Eng_SSN
		)
	";

	$query = $db->prepare($q);
	$query->execute([':project_no' => $project_no]);
	return $query;
}

function update_project($db, $project_no, $start_date, $end_date) {
	$q = "
		UPDATE Project
		SET Start_Date = :start_date, End_Date = :end_date
		WHERE Project_No = :project_no;
	";
	$query = $db->prepare($q);
	$query->execute([':project_no' => $project_no,':start_date' => $start_date, ':end_date' => $end_date]);
	return $query;
}
?>