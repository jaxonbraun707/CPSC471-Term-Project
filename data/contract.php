<?php
function get_contracts($db) {
	$q = "
		SELECT  
			    C.*, P.Title
		FROM Contract AS C, Proposal AS P
        WHERE 
            C.Proposal_No = P.Proposal_No
		";
	return $db->query($q);
}
?>