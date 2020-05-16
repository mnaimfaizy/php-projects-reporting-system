<?php include_once '../includes/database.php';

	if(isset($_GET['province_id'])) {
		$province_id = $_GET['province_id'];
		$query = "SELECT * FROM district WHERE province_id=$province_id";
		$result = $database->query($query);
		while($row = $database->fetch_array($result)) {
			echo '<option value="'.$row['district_id'].'">'.$row['district_name'].'</option>';	
		}
	}