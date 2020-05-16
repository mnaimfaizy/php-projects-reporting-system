<?php include_once '../includes/database.php';
	  
	global $database;
	/* ----------------------------------- Delete project ----------------------------------- */
	// This will delete a project from the project table
	if(isset($_GET['project_id'], $_GET['task']) && ($_GET['task'] == 'delete')) {
		$project_id = $database->escape_value($_GET['project_id']);
		$sql = "UPDATE project SET status='De-Active' WHERE project_id=$project_id";
		if($database->query($sql)) {
			$res = true;	
			header("Location: ../project_list.php?res=$res");
		} else {
			$res = false;
			header("Location: ../project_list.php?res=$res");
		}
	} // End of if statement
	
	/* ----------------------------------- Delete client ----------------------------------- */
	// This will delete a project from the project table
	if(isset($_GET['client_id'], $_GET['task']) && ($_GET['task'] == 'delete')) {
		$client_id = $database->escape_value($_GET['client_id']);
		$sql = "DELETE FROM clients WHERE client_id=$client_id LIMIT 1";
		if($database->query($sql)) {
			$res = true;	
			header("Location: ../clients_list.php?res=$res");
		} else {
			$res = false;
			header("Location: ../clients_list.php?res=$res");
		}
	} // End of if statement
	
	/* ----------------------------------- Delete Products ----------------------------------- */
	// This will delete a project from the project table
	if(isset($_GET['product_id'], $_GET['task']) && ($_GET['task'] == 'delete')) {
		$product_id = $database->escape_value($_GET['product_id']);
		$sql = "DELETE FROM products WHERE product_id=$product_id LIMIT 1";
		if($database->query($sql)) {
			$res = true;	
			header("Location: ../vendor_list.php?res1=$res");
		} else {
			$res = false;
			header("Location: ../vendor_list.php?res1=$res");
		}
	} // End of if statement
	
	/* ----------------------------------- Delete Contact Person -------------------------------- */
	// This will delete a project from the project table
	if(isset($_GET['contact_id'], $_GET['task']) && ($_GET['task'] == 'delete')) {
		$contact_id = $database->escape_value($_GET['contact_id']);
		$sql = "DELETE FROM contact_person WHERE contact_person_id=$contact_id LIMIT 1";
		if($database->query($sql)) {
			$res = true;	
			header("Location: ../vendor_list.php?res2=$res");
		} else {
			$res = false;
			header("Location: ../vendor_list.php?res2=$res");
		}
	} // End of if statement
	
	/* ----------------------------------- Delete Vendors -------------------------------------- */
	// This will delete a project from the project table
	if(isset($_GET['vendor_id'], $_GET['task']) && ($_GET['task'] == 'delete')) {
		$vendor_id = $database->escape_value($_GET['vendor_id']);
		$sql = "DELETE FROM vendor WHERE vendor_id=$vendor_id LIMIT 1";
		if($database->query($sql)) {
			$sql_product = "DELETE FROM products WHERE vendor_id=$vendor_id";
			$product_result = $database->query($sql_product);
			$sql_contactP = "DELETE FROM contact_person WHERE vendor_id=$vendor_id";
			$contact_result = $database->query($sql_contactP);
			if($product_result || $contact_result) {
				$res = true;	
				header("Location: ../vendor_list.php?res=$res");
			} else {
				$res = false;
				header("Location: ../vendor_list.php?res=$res");	
			}
		} else {
			$res = false;
			header("Location: ../vendor_list.php?res=$res");
		}
	} // End of if statement