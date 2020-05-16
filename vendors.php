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
	if(isset($_POST['submit_vendors'])) {
		@$vendor_name = $database->escape_value(trim($_POST['vendor_name']));
		@$address = $database->escape_value(trim($_POST['address']));
		@$profile = $database->escape_value($_POST['profile']);
		
		$date_added = time();
		$destination = 'project_files';
		$error_message = '';
		try {
			$upload = new UploadFile($destination);	
			$upload->setMaxSize($max);
			$upload->allowAllTypes();
			
			$uploadResult = $upload->upload();
			$profile_file = $upload->getFileName();
			$res = $upload->getMessages();
		} catch(Exception $e) {
			$res[] = $e->getMessage();	
		}
		
		/*echo "Vendor Name: " . $vendor_name . 
			"<br /> Address: " . $address . 
			"<br /> Profile: " . $profile . 
			"<br /> File Name: " . $file_name . 
			"<br /> File Size: " . $file_size . 
			"<br /> File Type: " . $file_type . 
			"<br /> Contact Person: "; 
			echo $name[0];
				for($i=0; $i <= count($name)-1; $i++) { echo $name[$i]; }  
		echo "<br /> Phone: " . $phone . 
			"<br /> Email: " . $email . 
			"<br /> Skype: " . $skype . 
			"<br /> Viber: " . $viber . 
			"<br /> Product: " . $product . 
			"<br /> POC: " . $poc . 
			"<br /> Email: " . $prod_email . 
			"<br /> Telephone: " . $prod_tel . 
			"<br /> Skype: " . $prod_skype ;*/
			
			// Insert fetched data from user to vendor table
			$sql = "INSERT INTO `vendor`(`vendor_name`, `address`, `profile`, `profile_file`, `date_added`) 
				VALUES ('$vendor_name','$address','$profile','$profile_file',$date_added)";
			if($database->query($sql)) {
				// Get the last id from vendor table
				$query = "SELECT vendor_id FROM vendor ORDER BY vendor_id DESC LIMIT 1";
				$query_result = $database->query($query);
				$vendor = $database->fetch_array($query_result);
				$vendor_id = $vendor['vendor_id'];
				
				// Add Contact Person to the database
				if(isset($_POST['name']) || isset($_POST['phone']) 
				|| isset($_POST['email']) || isset($_POST['skpe']) || isset($_POST['viber'])) {
					$count_result = count($_POST['name']);
					for($i = 0; $i <= $count_result-1; $i++) {
						$name = $database->escape_value($_POST['name'][$i]);	
						$phone = $database->escape_value($_POST['phone'][$i]);
						$email = $database->escape_value($_POST['email'][$i]);
						$skype = $database->escape_value($_POST['skype'][$i]);
						$viber = $database->escape_value($_POST['viber'][$i]);
						$date_added = time();
						
						$cont_sql = "INSERT INTO `contact_person`(`name`, `phone`, `email`, `skype`, `viber`, `vendor_id`, `date_added`) 
						VALUES ('$name','$phone','$email','$skype','$viber',$vendor_id,$date_added)";
						if($database->query($cont_sql)) {
							// Do nothing	
						} else {
							$error_message .= '<p> Contact Person detail insertion was unsuccessfull, please try again!</p>';
						}
					}
				}
				
				// Add Contact Person to the database
				if(isset($_POST['product']) || isset($_POST['poc']) 
				|| isset($_POST['prod_email']) || isset($_POST['prod_tel']) || isset($_POST['prod_skype'])) {
					$count = count($_POST['product']);
					for($i = 0; $i <= $count-1; $i++) {
						$product = $database->escape_value($_POST['product'][$i]);
						$poc = $database->escape_value($_POST['poc'][$i]);
						$prod_email = $database->escape_value($_POST['prod_email'][$i]);
						$prod_tel = $database->escape_value($_POST['prod_tel'][$i]);
						$prod_skype = $database->escape_value($_POST['prod_skype'][$i]);
						$date_added = time();
						
			$cont_sql = "INSERT INTO `products`(`product_name`,`poc`,`email`,`tel`,`skype`,`vendor_id`, `date_added`) 
						VALUES ('$product','$poc','$prod_email','$prod_tel','$prod_skype',$vendor_id,$date_added)";
						if($database->query($cont_sql)) {
							// Do nothing	
						} else {
							$error_message .= '<p> Product\'s detail insertion was unsuccessfull, please try again!</p>';	
						}
					}
				}
				$result = true;
			} else {
				$result = false;
			}
	} // End of if
?>
<script>
	$(document).ready(function() {
		var max_fields			= 10;	// maximum input boxes allowed
		var wrapper				= $(".input_fields_wrap"); // Files wrapper
		var add_button			= $(".add_field_button");	// Add button ID
		
		var x = 1;	// initial text box count
		$(add_button).click(function(e){ // on add input button click
			e.preventDefault();
			if(x < max_fields){ // max input box allowed
				x++;	// text box increment
				$(wrapper).append('<div><input type="text" class="form-control" name="product[]" placeholder="Product Name" style="width:180px; display:inline;"><input type="text" class="form-control" name="poc[]" placeholder="POC" style="width:180px; display:inline;"><input type="text" class="form-control" name="prod_email[]" placeholder="E-mail Address" style="width:180px; display:inline;"><input type="text" class="form-control" name="prod_tel[]" placeholder="Telephone" style="width:180px; display:inline;"><input type="text" class="form-control" name="prod_skype[]" placeholder="Skype" style="width:180px; display:inline;"><a href="#" class="remove_field"> Remove</a></div>'); // add input box
			}
		});
		
		$(wrapper).on("click",".remove_field", function(e){ // user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
    });
</script>

<script>
	$(document).ready(function() {
		var max_fields			= 10;	// maximum input boxes allowed
		var wrapper				= $(".input_fields_wrap1"); // Files wrapper
		var add_button			= $(".add_field_button1");	// Add button ID
		
		var x = 1;	// initial text box count
		$(add_button).click(function(e){ // on add input button click
			e.preventDefault();
			if(x < max_fields){ // max input box allowed
				x++;	// text box increment
				$(wrapper).append('<div><input type="text" class="form-control" name="name[]" placeholder="Contact Name" style="width: 180px; display:inline;"><input type="text" class="form-control" name="phone[]" placeholder="Phone Number" style="width: 180px; display:inline;"><input type="text" class="form-control" name="email[]" placeholder="E-Mail Address" style="width: 180px; display:inline;"><input type="text" class="form-control" name="skype[]" placeholder="Skype" style="width: 180px; display:inline;"><input type="text" class="form-control" name="viber[]" placeholder="Viber" style="width: 180px; display:inline;"><a href="#" class="remove_field1"> Remove</a></div>'); // add input box
			}
		});
		
		$(wrapper).on("click",".remove_field1", function(e){ // user click on remove text
			e.preventDefault(); $(this).parent('div').remove(); x--;
		})
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
                <h2><i class="glyphicon glyphicon-edit"></i> Add New Vendor </h2>

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
                        	<p> One vendor has been added successfully </p>
                        </div>
                        <?php } elseif($result == false) { ?>
                        <div class="alert alert-danger">
                        	<p> There seems to be problem, please try again later </p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
             <?php } ?>
             <?php if(!empty($error_message)) { ?>
            	<div class="row">
                	<div class="col-md-10">
                    	<div class="alert alert-info">
								<?php echo $error_message; ?>
                         </div>
                    </div>
                </div>
              <?php } ?>
              <?php if(@$res) {
						foreach($res as $message) { ?>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="alert alert-info">
                                    <?php echo "<li> $message </li>"; ?>
                             </div>
                        </div>
                    </div>			
			  <?php	} 
					} ?>
            	<div class="row">
                	<div class="col-md-12">
                        <div class="alert alert-info">
                            <h3> New Vendor registration form </h3>
                        </div>
                    </div>
                </div>
                        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                                                    method="post" 
                                                    name="vendors" id="vendors" enctype="multipart/form-data">
            	<div class="row">
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="vendor_name">Vendor Name</label>
                    <input type="text" class="form-control" tabindex="1" name="vendor_name" id="vendor_name" placeholder="Enter Vendor's Name" autofocus>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" tabindex="3" name="address" id="address" placeholder="Enter Vendor's Address">
                    </div>
                </div>
                </div> <br />
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                        <label for="profile">Profile</label>
                        <input type="text" class="form-control" tabindex="4" name="profile" id="profile" placeholder="Enter Organization Profile">
                    </div>
                </div>
                <div class="col-md-6">
            	<div class="form-group">
                    <label for="profile_file">Profile File</label>
                    <input type="file" class="form-inline" tabindex="26" name="profile_file" id="profile_file" 
                    					data-maxfiles="<?php echo $_SESSION['maxfiles']; ?>" 
                                        data-postmax="<?php echo $_SESSION['postmax']; ?>" 
                                        data-displaymax="<?php echo $_SESSION['displaymax']; ?>">
                    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max; ?>">
                    <ul>
                        <li>Each file should be no more than <?php echo UploadFile::convertFromBytes($max); ?>.</li>
                    </ul>
                    </div>
                </div>

                </div> <br />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                    	<h3> Add Contact Person </h3> 
                        <div class="input_fields_wrap1">
                         <button class="add_field_button1 btn btn-sm btn-success"> Add More Fields</button><br /><br />
        				<div> 
  <input type="text" class="form-control" name="name[]" placeholder="Contact Name" style="width:180px; display:inline;">
  <input type="text" class="form-control" name="phone[]" placeholder="Phone Number" style="width:180px; display:inline;">
  <input type="text" class="form-control" name="email[]" placeholder="E-Mail Address" style="width:180px; display:inline;">
  <input type="text" class="form-control" name="skype[]" placeholder="Skype" style="width:180px; display:inline;">
  <input type="text" class="form-control" name="viber[]" placeholder="Viber" style="width:180px; display:inline;">
                        </div> 
                        </div>                       
                        </div>
                    </div>
                </div> <br />
                <div class="row">	
                    <div class="col-md-12">
                        <div class="form-group">
                    	<h3> Add products </h3>
                        <div class="input_fields_wrap">
                         <button class="add_field_button btn btn-sm btn-success"> Add More Fields</button><br /><br />
        				<div> <input type="text" class="form-control" name="product[]" placeholder="Product Name" style="width:200px; display:inline;">
                        <input type="text" class="form-control" name="poc[]" placeholder="POC" style="width:200px; display:inline;">
                        <input type="text" class="form-control" name="prod_email[]" placeholder="E-mail Address" style="width:200px; display:inline;">
                        <input type="text" class="form-control" name="prod_tel[]" placeholder="Telephone" style="width:200px; display:inline;">
                        <input type="text" class="form-control" name="prod_skype[]" placeholder="Skype" style="width:200px; display:inline;"></div> 
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">                
                <div class="col-md-6">
                   	<input type="submit" name="submit_vendors"
                               value="ADD"
                               class="btn btn-primary btn-lg" tabindex="27" />
                    </div>
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
		$("#vendors").validate({
			rules: {
				vendor_name: "required",
				address: "required",
				profile: "required"
			},
			messages: {
				vendor_name: "Please Enter Vendor Name, This filed is required",
				address: "Please Enter valid address, This field is required",
				profile: "Please provide vendor profile, This field is required"
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