<?php include 'includes/header.php'; 
	
	// Check if the submit button is set
	if(isset($_POST['submit_client'])) {
		@$client_name = $database->escape_value(trim($_POST['client_name']));
		@$organization_type = $database->escape_value(trim($_POST['organization_type']));
		@$address = $database->escape_value(trim($_POST['address']));
		@$telephone = $database->escape_value(trim($_POST['telephone']));
		@$email = $database->escape_value(trim($_POST['email']));
		$date_added = time();
		
		// Check the client is availbale in the database or not
		$sql = "SELECT COUNT(*) AS total FROM clients WHERE 
					client_organization = '$client_name' 
					AND organization_type = '$organization_type' 
					AND address = '$address' 
					AND telephone = '$telephone' 
					AND email = '$email'";
		$sql_result = $database->query($sql);
		$total = $database->fetch_array($sql_result);
		if($total['total'] > 0) {
			$error_msg = '<p> '.$client_name .' is available, please try to insert another client! </p>';
		} else {
		//echo $client_name . " - " . $organization_type . " - " . $address . " - " .  $telephone . " - " . $email;
			$sql = "INSERT INTO `clients`(`client_organization`, `organization_type`, `address`, `telephone`, `email`, `date_added`) VALUES ('$client_name','$organization_type','$address','$telephone','$email',$date_added)";

			if($database->query($sql)) {
				$result = true;
				unset($_POST);
			} else {
				$result = false;
			}
		} // End of IF-ELse
	} // End of if
?>
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
                <h2><i class="glyphicon glyphicon-edit"></i> Add New Client </h2>

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
                        	<p> One client has been added successfully </p>
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
                    	<div class="alert alert-danger">
								<?php echo $error_msg; ?>
                         </div>
                    </div>
                </div>
              <?php } ?>
            	<div class="row">
                	<div class="col-md-12">
                        <div class="alert alert-info">
                            <h3> New client registration form </h3>
                        </div>
                    </div>
                </div>
                        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                                                    method="post" 
                                                    name="clients" id="clients" enctype="multipart/form-data">
            	<div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="client_name">Client / Organization</label>
                    <input type="text" class="form-control" tabindex="1" name="client_name" id="client_name" placeholder="Enter Client's Name" autofocus>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="organization_type">Organization Type</label>
                    <input type="text" class="form-control" tabindex="2" name="organization_type" id="organization_type" placeholder="Enter Organization's Type">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" tabindex="3" name="address" id="address" placeholder="Enter Client's Address">
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                        <label for="telephone">Telephone</label>
                        <input type="text" class="form-control" tabindex="4" name="telephone" id="telephone" placeholder="Enter Telephone Number">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" tabindex="5" name="email" id="email" placeholder="Enter Email Address">
                    </div>
                </div>
                </div> <br />  
                <div class="row">
                <div class="col-md-6">
                    	<input type="submit" name="submit_client" id="submit_client"
                               value="ADD"
                               class="btn btn-primary btn-lg" tabindex="6" />
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
		$("#clients").validate({
			rules: {
				client_name: "required",
				organization_type: "required",
				address: "required",
				telephone: "required",
				email: {
					required: true,
					email: true
				}
			},
			messages: {
				client_name: "Please Enter client name, This filed is requiried",
				organization_type: "Please Enter organization type, This field is required",
				address: "Please Enter valid address, this field is required",
				telephone: "Please Enter telephone, this field is required",
				email: {
					required: "Please Enter valid email address, this field is required",
					email: "Please provide vaild email address!"
				}
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