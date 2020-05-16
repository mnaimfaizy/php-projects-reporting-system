<?php include_once '../includes/database.php';
	
	if(isset($_POST['query']) === true && empty($_POST['query']) === false) {
		$searchQuery = $database->escape_value($_POST['query']);
		$output = '';
		$query = "SELECT * FROM project WHERE project_title LIKE '%". $searchQuery . "%' LIMIT 10";
		$result = $database->query($query);
		if($database->num_rows($result) > 0) {
			while($row = $database->fetch_array($result)) {
				$output .= 	'<ul class="searchresults">';
				$output .= '<a href="search.php?project_id='.$row['project_id'].'">';
				$output .= '<li>';
				$output .= '<h2> ' . $row['project_title'];
				$output .= ' &nbsp; &nbsp;<span style="color: red;">('. $row['organization'] . ')</span>';
				$output .= '</h2>';
				$output .= '</li>';
				$output .= '</a>';
				$output .= '</ul>';
				echo $output;
			}
		} elseif($database->num_rows($result) <= 0) {
			
		}
	}
	if(isset($_POST['query']) && $_POST['query'] == "") {
		$output .= '<ul class="searchresults">';
		$output .= '<li>';
		$output .= '<h2> No record Found </h2>';
		$output .= '</li>';
		$output .= '</ul>';	
	}