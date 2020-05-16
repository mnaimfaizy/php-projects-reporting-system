<?php 
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<?php include 'includes/header.php'; ?>
<?php
	if(isset($_GET['res'])) {
		if($_GET['res'] == true) { $_SESSION['delMessage'] = true; }
		else if($_GET['res'] == false) { $_SESSION['delMessage'] = false; }
		
		$location = "http://localhost/projects/vendor_list.php";
		echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
		exit;	
	} else if(isset($_GET['res1'])) {
		if($_GET['res1'] == true) { $_SESSION['delMessage1'] = true; }
		else if($_GET['res1'] == false) { $_SESSION['delMessage1'] = false; }
		
		$location = "http://localhost/projects/vendor_list.php";
		echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
		exit;	
	} else if(isset($_GET['res2'])) {
		if($_GET['res2'] == true) { $_SESSION['delMessage2'] = true; }
		else if($_GET['res2'] == false) { $_SESSION['delMessage2'] = false; }
		
		$location = "http://localhost/projects/vendor_list.php";
		echo '<META HTTP-EQUIV="refresh" CONTENT="0;URL='.$location.'">';
		exit;	
	} else {
		// Something
	}
?>
<script type="text/javascript">
	function conf(id) {
		var value = window.confirm("Are You Sure, You want to DELETE selected Item?");
		if(value == true) {
			window.location = "includes/delete_items.php?vendor_id="+id+"&task=delete";	
		} else {
			alert("Deletion can not be done now, please try again later");
		}
	}
	function del_prod(id) {
		var value = window.confirm("Are You Sure, You want to DELETE selected Item?");
		if(value == true) {
			window.location = "includes/delete_items.php?product_id="+id+"&task=delete";	
		} else {
			alert("Deletion can not be done now, please try again later");
		}
	}
	function del_contact(id) {
		var value = window.confirm("Are You Sure, You want to DELETE selected Item?");
		if(value == true) {
			window.location = "includes/delete_items.php?contact_id="+id+"&task=delete";	
		} else {
			alert("Deletion can not be done now, please try again later");
		}
	}
	
</script>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
        
            <div>
                <ul class="breadcrumb">
                    <?php echo breadcrumb(); ?>
                </ul>
            </div>
    <div class="row">
    <?php if(isset($_SESSION['delMessage'])) { 
		if($_SESSION['delMessage'] == false) { ?>
     	<div class="col-md-8">
        	<div class="alert alert-danger">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> Oh Snap! </strong> vendor deletion was not completed successfully! Please try again.
            </div>
        </div>
    <?php } else if($_SESSION['delMessage'] == true) { ?>
    	<div class="col-md-8">
        	<div class="alert alert-success">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> Well done! </strong> You have successfully deleted one vendor form the database.
            </div>
        </div>
    <?php } 
		} else if(isset($_SESSION['delMessage1'])) { 
		if($_SESSION['delMessage1'] == false) { ?>
     	<div class="col-md-8">
        	<div class="alert alert-danger">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> Oh Snap! </strong> product deletion was not completed successfully! Please try again.
            </div>
        </div>
    <?php } else if($_SESSION['delMessage1'] == true) { ?>
    	<div class="col-md-8">
        	<div class="alert alert-success">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> Well done! </strong> You have successfully deleted one product form the database.
            </div>
        </div>
    <?php } 
		} else if(isset($_SESSION['delMessage2'])) { 
		if($_SESSION['delMessage2'] == false) { ?>
     	<div class="col-md-8">
        	<div class="alert alert-danger">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> Oh Snap! </strong> contact person deletion was not completed successfully! Please try again.
            </div>
        </div>
    <?php } else if($_SESSION['delMessage2'] == true) { ?>
    	<div class="col-md-8">
        	<div class="alert alert-success">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> Well done! </strong> You have successfully deleted one contact person form the database.
            </div>
        </div>
    <?php } unset($_SESSION['delMessage1'], $_SESSION['delMessage'], $_SESSION['delMessage2']); } ?>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Vendor List</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <div class="alert alert-info">This list provides information about vendor which are entered in the database </div>
    </div>
    </div>
    </div>
    </div>
    <div class="row">
    <?php $vendor_result = $database->query("SELECT * FROM vendor ORDER BY vendor_id DESC");
		while($vendor = $database->fetch_array($vendor_result)) {
	?>
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>#<?php echo $vendor['vendor_id'] . " - " . $vendor['vendor_name']; ?> </h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                <div class="row">
                	<div class="col-sm-6 blue"><p>
                        <strong>Vendor ID: </strong> 
                        <span> #<?php echo $vendor['vendor_id']; ?> </span> </p>
                    </div>
                    <div class="col-sm-6">
                    	<a href="#" class="btn btn-success btn-sm"> 
                        <i class="glyphicon glyphicon-edit icon-white"></i> Edit </a><br /><br />
                    </div>
                    <div class="col-sm-6"> <p>
                    <strong>Vendor Name: </strong><span> <?php echo $vendor['vendor_name']; ?></span></p>
                    </div>
                    <div class="col-sm-6">
                    	<button name="delete_vendor" id="<?php echo $vendor['vendor_id']; ?>" onClick="conf(this.id)" class="btn btn-danger btn-sm">
                        	<i class="glyphicon glyphicon-trash icon-white"></i> Delete
                        </button>
                    </div>
                    <div class="col-sm-6"><p>
                    <strong> Address: </strong><span> 
					<?php echo $vendor['address']; ?> </span> </p>
                    </div>
                    <div class="col-sm-12"> <p>
					<strong> Profile:</strong>
                    <span> <?php echo $vendor['profile']; ?> </span></p>
                    </div>
                    <div class="col-md-6"> 
                    <h3> Products </h3>
                    	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        	<thead>
                            <tr>
                                <th> No. </th>
                                <th> Name </th>
                                <th> POC </th>
                                <th> Email </th>
                                <th> Telephone </th>
                                <th> Skype </th>
                                <th>&nbsp;  </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
								$vendor_id = $vendor['vendor_id'];
								$sql = "SELECT * FROM products WHERE vendor_id=$vendor_id";
								$sql_result = $database->query($sql);
								while($products = $database->fetch_array($sql_result)) { ?>
                            <tr>
                                <td> <?php echo $no++; ?> </td>
                                <td> <?php echo $products['product_name']; ?> </td>
                                <td> <?php echo $products['poc']; ?> </td>
                                <td> <?php echo $products['email']; ?> </td>
                                <td> <?php echo $products['tel']; ?> </td>
                                <td> <?php echo $products['skype']; ?> </td>
                                <td> <button id="<?php echo $products['product_id']; ?>" class="btn btn-danger btn-sm" onClick="del_prod(this.id)"> <i class="glyphicon glyphicon-trash icon-white"></i> </button> </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                         </table> 
                    </div>
                    <div class="col-md-6">
                    	<h3> Contact Person </h3>
                    	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        	<thead>
                            <tr>
                                <th> No. </th>
                                <th> Name </th>
                                <th> Phone </th>
                                <th> Email </th>
                                <th> Skype </th>
                                <th> Viber </th>
                                <th>&nbsp;  </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1;
								$vendor_id = $vendor['vendor_id'];
								$sql = "SELECT * FROM contact_person WHERE vendor_id=$vendor_id";
								$sql_result = $database->query($sql);
								while($clients = $database->fetch_array($sql_result)) { ?>
                            <tr>
                                <td> <?php echo $no++; ?> </td>
                                <td> <?php echo $clients['name']; ?></td>
                                <td> <?php echo $clients['phone']; ?> </td>
                                <td> <?php echo $clients['email']; ?></td>
                                <td> <?php echo $clients['skype']; ?> </td>
                                <td> <?php echo $clients['viber']; ?> </td>
                                <td> <button id="<?php echo $clients['contact_person_id']; ?>" class="btn btn-sm btn-danger" onClick="del_contact(this.id)"> <i class="glyphicon glyphicon-trash icon-white"></i> </button> </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                         </table> 
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
        <!--/span-->
		<?php } ?>
    </div><!--/row-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->

</div><!--/fluid-row-->
    <hr>
<?php include 'includes/footer.php'; ?>