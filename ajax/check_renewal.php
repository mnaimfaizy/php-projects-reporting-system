<?php 	date_default_timezone_set('Asia/Kabul');
		include_once '../includes/db_connect.php';
		include_once '../includes/database.php'; ?>

<?php $query = "SELECT end_date, project_title FROM project";
$query_result = $database->query($query);
while($row = $database->fetch_array($query_result)) {
	$end_date = $row['end_date'];
	$project_title = $row['project_title'];						
	$end_date1 = date('Y-m-d', $end_date);
	//$end_date1 = '2015-09-13';
	$notify_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($end_date1)) . " -30 days"));
	//$notify_date = '2015-09-13';
	if($end_date1 == $notify_date) {
		$file = 'email_log.txt';
		$handle = fopen($file, 'w') or die('Cannot open file: '.$file); // implicitly creates file
		$data = date('Y-m-d | h:i:s', time()) . ' - Email Send successfuly of ' . $project_title . ' Project';
		$data .= "\n";
		fwrite($handle, $data);
		fclose($handle);
		echo 'Email Sent Successfully - ';
		/*$to = 'mnaimfaizy@gmail.com';
		$subject  = 'Project Renewal';
		$message = 'The '. $project_title .' project has 30 days to expire, please visit the project for enewal.';
		$headers = 'From: mnaimfaizy@mnfprofile.com' . "\r\n" .
				'Reply-To: mnaimfaizy@mnfprofile.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);*/	
	} else {
		$file = 'email_log.txt';
		$handle = fopen($file, 'w') or die('Cannot open file: '.$file); // implicitly creates file
		$data = date('Y-m-d | h:i:s', time()) . ' - Email was not Send successfuly of ' . $project_title . ' Project';
		$data .= "\n";
		fwrite($handle, $data);
		fclose($handle);
	}
} ?>