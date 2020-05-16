<?php include 'includes/header.php'; 

	if(!isset($_SESSION['maxfiles'])) {
	$_SESSION['maxfiles'] = ini_get('max_file_uploads');
	$_SESSION['postmax'] = UploadFile::convertToBytes(ini_get('post_max_size'));
	$_SESSION['displaymax'] = UploadFile::convertFromBytes($_SESSION['postmax']);	
	}
	$max = 2000 * 1024;
	$filename = '';
	$res = array();
	$uploadResult = false;
	
	// Check if the submit button is set
	if(isset($_POST['submit_project'])) {
		@$project_title = $database->escape_value(trim($_POST['title']));
		@$description_of_activities = $database->escape_value(trim($_POST['description']));
		@$province = $_POST['province'];
		@$district = $_POST['district'];
		@$organization = $database->escape_value(trim($_POST['organization']));
		@$client_name = $database->escape_value(trim($_POST['client_name']));
		@$client_phone = $database->escape_value(trim($_POST['client_phone']));
		@$cost_in_usd = $database->escape_value(trim($_POST['cost_in_usd']));
		@$start_date = date("Y/m/d", $_POST['start_date']);
		@$end_date = date("Y/m/d", $_POST['end_date']);
		@$completed = $database->escape_value(trim($_POST['completed']));
		@$sub_contructor = $database->escape_value($_POST['sub_contructor']);
		@$department = $database->escape_value($_POST['department']);
		@$unit = $database->escape_value($_POST['unit']);
		@$taxation = $database->escape_value($_POST['taxation']);
		@$ascc_employee = $database->escape_value($_POST['ascc_employee']);
		@$invoice_afs = $database->escape_value($_POST['invoice_afs']);
		@$rate = $database->escape_value($_POST['rate']);
		@$invoice_usd = $database->escape_value($_POST['invoice_usd']);
		@$recieve_date = date("Y/m/d", $_POST['recieve_date']);
		@$total_amount_spent = $database->escape_value($_POST['total_amount_spent']);
		@$total_amount_shared = $database->escape_value($_POST['total_amount_shared']);
		@$net_profit_afs = $database->escape_value($_POST['net_profit_afs']);
		@$net_profit_usd = $database->escape_value($_POST['net_profit_usd']);
		@$project_file = $database->escape_value($_POST['project_file']);
		@$client_id = $database->escape_value($_POST['clients']);
		$date_added = date("d/m/Y", time());
		$status = 'Active';
		$destination = 'project_files';
		try {
			$upload = new UploadFile($destination);	
			$upload->setMaxSize($max);
			$upload->allowAllTypes();
			
			$uploadResult = $upload->upload();
			$project_file = $upload->getFileName();
			$res = $upload->getMessages();
		} catch(Exception $e) {
			$res[] = $e->getMessage();	
		}
		/*
		echo "Project Title: " . $project_title . 
			"<br /> Description of Activities: " . $description_of_activities . 
			"<br /> Province: " . $province . 
			"<br /> District: " . $district . 
			"<br /> Organization: " . $organization . 
			"<br /> Client Name: " . $client_name . 
			"<br /> Client Phone: " . $client_phone . 
			"<br /> Cost in USD: " . $cost_in_usd . 
			"<br /> Start Date: " . $start_date . 
			"<br /> End Date: " . $end_date . 
			"<br /> Completed: " . $completed . 
			"<br /> Sub-Contructor: " . $sub_contructor . 
			"<br /> Department: " . $department . 
			"<br /> Unit: " . $unit . 
			"<br /> Taxation: " . $taxation . 
			"<br /> ASCC Employee: " . $ascc_employee . 
			"<br /> Invoice AFS: " . $invoice_afs . 
			"<br /> Rate: " . $rate . 
			"<br /> Invoice USD: " . $invoice_usd . 
			"<br /> Recieve Date: " . $recieve_date . 
			"<br /> Total Amount Spent: " . $total_amount_spent . 
			"<br /> Total Amount Shared: " . $total_amount_shared . 
			"<br /> Net Profit AFS: " . $net_profit_afs . 
			"<br /> Net Profit USD: " . $net_profit_usd . 
			"<br /> Project File: " . $project_file; 
			*/
			$sql = "INSERT INTO `project`(`project_title`, `description_of_activities`, `province`, `district`, `organization`, `client_name`, `client_phone`, `cost_in_usd`, `start_date`, `end_date`, `completed`, `subcontractor`, `department`, `unit`, `taxation`, `project_by_ascc_employee`, `invoice_afs`, `rate`, `invoice_usd`, `received_date`, `total_amount_spent`, `total_amount_shared`, `net_profit_afs`, `net_profit_usd`, `project_file`, `client_id`, `date_added`, `status`)  ";
			$sql .= "VALUES ('$project_title','$description_of_activities','$province','$district','$organization','$client_name',$client_phone,$cost_in_usd,'$start_date','$end_date','$completed','$sub_contructor','$department',$unit,'$taxation','$ascc_employee',$invoice_afs,$rate,$invoice_usd,'$recieve_date',$total_amount_spent,$total_amount_shared,$net_profit_afs,$net_profit_usd,'$project_file', $client_id, '$date_added','$status')";
			if($database->query($sql)) {
				$result = true;
			} else {
				$result = false;
			}
	} // End of if
?>
<script type="text/javascript">
	$(document).ready(function() {
        // Load districts when province is selected
		$('#province').change(function() {
			$.get('ajax/load_district.php?province_id=' +$(this).val(), function(data) {
				$("#district").html(data);
				$("#district").prepend('<option value="" disabled="disabled" selected="selected"> -- Select District -- </option>');	
			});
		});
		var output = '<option value="" disabled="disabled" selected="selected"> -- Select Province First -- </option>';
		$("#district").html(output);
    });
</script>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
                <ul class="breadcrumb">
                   <?php echo breadcrumb(); ?>
                </ul>
            </div>

	<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Add New Project </h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i
                            class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div> <!-- /box-header -->
            <div class="box-content">
            <?php if(isset($result)) { ?>
                <div class="row">
                	<div class="col-md-10">
                    	<?php if($result == true) { ?>
                    	<div class="alert alert-success">
                        	<p> One project has been added successfully </p>
                        </div>
                        <?php } elseif($result == false) { ?>
                        <div class="alert alert-danger">
                        	<p> There seems to be problem, please try again later </p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
             <?php } ?>
             <?php if(!empty($error_msg)) { ?>
            	<div class="row">
                	<div class="col-md-10">
                    	<div class="alert alert-info">
								<?php echo $error_msg; ?>
                         </div>
                    </div>
                </div>
              <?php } ?>
              <?php if($res) {
						foreach($res as $message) { ?>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="alert alert-danger">
                                    <?php echo "<li> $message </li>"; ?>
                             </div>
                        </div>
                    </div>			
			  <?php	} 
					} ?>
            	<div class="row">
                	<div class="col-md-12">
                        <div class="alert alert-info">
                            <h3> New project registration form </h3>
                        </div>
                    </div>
                </div>
                        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                                                    method="post" 
                                                    name="projects" id="projects" enctype="multipart/form-data">
            	<div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="title">Project Title</label>
                    <input type="text" class="form-control" tabindex="1" name="title" id="title" placeholder="Enter Project Title" autofocus>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Description of activities</label>
                    <textarea class="form-control" id="description" name="description" rows="5" tabindex="2"> </textarea>
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="province">Province</label>
                    <select class="form-control" name="province" id="province" tabindex="3">
                    	<option value="" selected disabled> -- Select Province -- </option>
                        <?php $query = $database->query("SELECT * FROM province");
							while($province = $database->fetch_array($query)) { ?>
                        <option value="<?php echo $province['province_id']; ?>"> <?php echo $province['province_name']; ?> </option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                        <label for="district">District</label>
                        <select class="form-control" name="district" id="district" tabindex="4">
                    </select>
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="organization">Organization</label>
                    <input type="text" class="form-control" tabindex="5" name="organization" id="organization" placeholder="Enter Organization Name">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="client_name">Client Name</label>
                    <input type="text" class="form-control" tabindex="5" name="client_name" id="client_name" placeholder="Enter Client Name">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="client_phone">Client Phone</label>
                    <input type="text" class="form-control" tabindex="6" name="client_phone" id="client_phone" placeholder="Enter Client Phone Number">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="cost_in_usd">Cost in USD</label>
                    <input type="text" class="form-control" tabindex="7" name="cost_in_usd" id="cost_in_usd" placeholder="Enter Cost of project in USD $">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="text" class="form-control" tabindex="8" name="start_date" id="start_date" placeholder="2015/03/01">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="text" class="form-control" tabindex="9" name="end_date" id="end_date" placeholder="2015/05/01">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="completed" class="col-md-5">Completed</label>
            <span class="col-md-2">
            <input type="radio" class="radio-inline" tabindex="10" name="completed" id="completed" value="Yes" /> Yes
            </span>
            <span class="col-md-2">
            <input type="radio" class="radio-inline" tabindex="11" name="completed" id="completed" value="No" /> No
            </span>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="sub_contructor">Sub-contructor</label>
                    <input type="text" class="form-control" tabindex="12" name="sub_contructor" id="sub_contructor" placeholder="Enter Sub-contructor Name">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" class="form-control" tabindex="13" name="department" id="department" placeholder="Enter Department Name">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="unit">Tax Payment</label>
                    <input type="text" class="form-control" tabindex="14" name="unit" id="unit" placeholder="Enter Unit">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="taxation" class="col-md-5">Tax Reciept Recieved</label>
            <span class="col-md-2">
            <input type="radio" class="radio-inline" tabindex="15" name="taxation" id="taxation" value="Yes" /> Yes
            </span>
            <span class="col-md-2">
            <input type="radio" class="radio-inline" tabindex="16" name="taxation" id="taxation" value="No" /> No
            </span>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="ascc_employee">Project By ASCC Employee</label>
                    <input type="text" class="form-control" tabindex="17" name="ascc_employee" id="ascc_employee" placeholder="Enter ASCC Employee">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="invoice_afs">Invoice AFS</label>
                    <input type="text" class="form-control" tabindex="18" name="invoice_afs" id="invoice_afs" placeholder="Invoice in Afghani">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="rate">Rate</label>
                    <input type="text" class="form-control" tabindex="19" name="rate" id="rate" placeholder="Enter Rate">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="invoice_usd">Invoice USD</label>
                    <input type="text" class="form-control" tabindex="20" name="invoice_usd" id="invoice_usd" placeholder="Invoice in USD">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="recieve_date">Invoice Clearing Date</label>
                    <input type="text" class="form-control" tabindex="21" name="recieve_date" id="recieve_date" placeholder="2015/03/01">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="total_amount_spent">Total Amount Spent</label>
                    <input type="text" class="form-control" tabindex="22" name="total_amount_spent" id="total_amount_spent" placeholder="Enter total amount spent">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="total_amount_shared">Total Amount Shared</label>
                    <input type="text" class="form-control" tabindex="23" name="total_amount_shared" id="total_amount_shared" placeholder="Enter Total Amount Shared">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="net_profit_afs">Net Profit AFs</label>
                    <input type="text" class="form-control" tabindex="24" name="net_profit_afs" id="net_profit_afs" placeholder="Enter Net Profit in Afghanistan">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="net_profit_usd">Net Profit USD</label>
                    <input type="text" class="form-control" tabindex="25" name="net_profit_usd" id="net_profit_usd" placeholder="Enter Net Profit in USD">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="project_file">Project File</label>
                    <input type="file" class="form-inline" tabindex="26" name="project_file" id="project_file" 
                    					data-maxfiles="<?php echo $_SESSION['maxfiles']; ?>" 
                                        data-postmax="<?php echo $_SESSION['postmax']; ?>" 
                                        data-displaymax="<?php echo $_SESSION['displaymax']; ?>">
                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max; ?>">
                    <ul>
                        <li>Each file should be no more than <?php echo UploadFile::convertFromBytes($max); ?>.</li>
                    </ul>
                    </div>
                </div>
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="clients">Clients</label>
                    <select name="clients" id="clients" class="form-control">
                    	<option value="" selected disabled> -- Select Clients -- </option>
                        <?php $sql = "SELECT * FROM clients"; 
							$sql_result = $database->query($sql);
							while($row = $database->fetch_array($sql_result)) { ?>
                        <option value="<?php echo $row['client_id']; ?>"> 
                        	<?php echo $row['client_organization']; ?> 
                        </option>
                       <?php } ?>
                    </select>
                    </div>
                </div>
            </div>
			<div class="row">
                <div class="col-md-6">
                    	<input type="submit" name="submit_project"
                               value="ADD"
                               class="btn btn-primary btn-lg" tabindex="27" />
                    </div>
                </div>
                </form>
            </div> <!-- /box-content -->
         </div> <!-- /box-inner -->
      </div> <!-- col-md-12 -->
     </div> <!-- /row -->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
    <hr>
<script type="text/javascript">
	$(document).ready(function() {
        // Validate projects form 
		$("#projects").validate({
			rules: {
				title: "required",
				description: "required",
				province: "required",
				district: "required",
				organization: "required",
				client_name: "required",
				client_phone: "required",
				cost_in_usd: "required",
				start_date: "required",
				end_date: "required",
				completed: "required",
				taxation: "required",
				clients: "required"
			},
			messages: {
				title: "Please Enter project title, This filed is requiried",
				description: "Please provide some description regarding project",
				province: "Please select one province from the list",
				district: "Please select one district from the list",
				organization: "Please enter organization name",
				client_name: "Please enter client's name",
				client_phone: "client phone number is required",
				cost_in_usd: "Please enter cost in USD",
				start_date: "Please enter starting date of project",
				end_date: "Please enter ending date of project",
				completed: "This field is required",
				taxation: "This field is required",
				clients: "Please select client from the above list"
			},
			highlight:function(element, errorClass, validClass) {
				$(element).parents('.input-group').addClass('has-error');
				$(element).parents('.form-group').addClass('has-error');
			},
			unhighlight:function(element, errorClass, validClass) {
				$(element).parents('.input-group').removeClass('has-error');
				$(element).parents('.input-group').addClass('has-success');
				$(element).parents('.form-group').removeClass('has-error');
				$(element).parents('.form-group').addClass('has-success');	
			}
		});
    });
</script>
<?php include 'includes/footer.php'; ?>