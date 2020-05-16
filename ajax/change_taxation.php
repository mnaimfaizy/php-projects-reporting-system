<?php include_once '../includes/database.php';

	if(isset($_GET['taxation'], $_GET['project_id'])) {
		$taxation = $_GET['taxation'];
		$project_id = $_GET['project_id'];
		$query = "UPDATE project SET taxation='$taxation' WHERE project_id=$project_id LIMIT 1";
		if($database->query($query)) {
			echo "true";	
		} else {
			echo "false";	
		}
		
	}