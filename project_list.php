<?php 
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<?php include 'includes/header.php'; ?>
<?php
	if(isset($_GET['res'])) {
		if($_GET['res'] == true) { $_SESSION['delMessage'] = true; }
		else if($_GET['res'] == false) { $_SESSION['delMessage'] = false; }
		
		$location = "http://localhost/projects/project_list.php";
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
			window.location = "includes/delete_items.php?project_id="+id+"&task=delete";	
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
                <strong> Oh Snap! </strong> project deletion was not completed successfully! Please try again.
            </div>
        </div>
    <?php } else if($_SESSION['delMessage'] == true) { ?>
    	<div class="col-md-8">
        	<div class="alert alert-success">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> Well done! </strong> You have successfully deleted one projet form the database.
            </div>
        </div>
    <?php } unset($_SESSION['delMessage']); } ?>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Projects List</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <div class="alert alert-info">This list provides information about projects which are entered in the database </div>
    </div>
    </div>
    </div>
    </div>
    <div class="row">
    <?php $project_result = $database->query("SELECT * FROM project WHERE status='Active' ORDER BY project_id DESC");
		while($project = $database->fetch_array($project_result)) {
	?>
        <div class="box col-md-6">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>#<?php echo $project['project_id'] . " - " . $project['project_title']; ?> </h2>

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
                    <?php $province_sql = $database->query("SELECT province_name FROM province WHERE province_id=" . $project['province'] . " LIMIT 1");
						$province_result = $database->fetch_array($province_sql);
						$province = $province_result['province_name']; ?>
                        <strong>Province: </strong> <span class="pull-right">
					<?php echo $province; ?> </span> </p>
                    </div>
                    <div class="col-sm-6 blue"> <p>
                    <?php $district_sql = $database->query("SELECT district_name FROM district WHERE district_id=" . $project['district'] . " LIMIT 1");
					$district_result = $database->fetch_array($district_sql);
					$district = $district_result['district_name']; ?>
                   <strong>District: </strong><span class="pull-right"> <?php echo $district; ?> </span></p>
                    </div>
                    <div class="col-sm-6"><p>
                    <strong> Start Date: </strong><span class="pull-right"> 
					<?php echo $project['start_date']; ?></span> </p>
                    </div>
                    <div class="col-sm-6"> <p>
					<strong> End Date:</strong><span class="pull-right"> 
					<?php echo $project['end_date']; ?> </span></p>
                    </div>
                    <div class="col-sm-6"> 
                    <p><span style="font-weight:bold; font-size: 15px; color: #00C3FF;"> <?php echo $project['organization']; ?> </span></p> 
                    </div>
                    <div class="col-sm-6"><p class="center"> 
                    <span style="font-weight:bold; font-size: 15px; color: #00C3FF;"> <?php echo $project['client_name']; ?></span> - 
                    <span style="font-weight:bold; font-size: 15px; color: #00C3FF;"><?php echo $project['client_phone']; ?></span></p> </div>
                    <div class="col-sm-6">
                    <p><strong> Cost in USD </strong>
                    	<span class="pull-right"> <?php echo '$'.$project['cost_in_usd']; ?></span></p>
                    </div>
                    <div class="col-sm-6">
                    <p><strong> Completed: </strong> 
                    <?php if($project['completed'] == 'Yes') { ?>
                        <span class="label label-success pull-right"> 
                        <?php echo $project['completed']; ?></span>
                    <?php } elseif($project['completed'] == 'No') { ?>
                        <span class="label label-danger pull-right"> 
                        <?php echo $project['completed']; ?></span>
                    <?php } ?>
                    </p> 
                    </div>
                    <div class="col-sm-6">
                    <p><strong> Sub-Contructor: </strong> 
					<span class="pull-right"><?php echo $project['subcontractor']; ?></span></p> 
                    </div>
                    <div class="col-sm-6"><p><strong> Department: </strong> 
					<span class="pull-right"><?php echo $project['department']; ?></span></p> 
                    </div>
                    <div class="col-sm-6"><p><strong> Tax Payment: </strong>
                    <span class="pull-right"> <?php echo $project['unit']; ?> </span></p> 
                    </div>
                    <div class="col-sm-6"><p><strong> Tax Reciept Recieved: &nbsp;</strong> 
                    <?php if($project['taxation'] == 'Yes') { ?>
                        <span class="label label-success pull-right"> 
                        <?php echo $project['taxation']; ?></span>
                    <?php } elseif($project['taxation'] == 'No') { ?>
                    	<span class="label label-danger pull-right"> 
					<?php echo $project['taxation']; ?></span>
                    <?php } ?>
                    </p> 
                    </div>
                    <div class="col-sm-6">
                    <p><strong> ASCC Employee: </strong> 
					<span class="pull-right"><?php echo $project['project_by_ascc_employee']; ?> </span>
                    </p></div>
                    <div class="col-sm-6">
                    <p><strong> Invoice: </strong> <?php echo $project['invoice_afs'] .' AF'; ?>, 
					<?php echo '$'.$project['invoice_usd']; ?> - 
                    <strong> Rate: </strong><span class="label label-primary"> <?php echo $project['rate']; ?></span></p> 
                    </div>
                    <div class="col-sm-6"><p><strong> Invoice Clearing Date: </strong><span class="pull-right"> <?php echo $project['received_date']; ?></span> </p></div>
                    <div class="col-sm-6"><p><strong> Total Amount Spent: </strong><span class="pull-right"> <?php echo '$'.$project['total_amount_spent']; ?> </span>
                    </p></div>
                    <div class="col-sm-6"><p>
					<strong> Total Amount Shared: </strong>
                    <span class="pull-right"><?php echo $project['total_amount_shared']; ?></span></p> 
                    </div>
                    <div class="col-sm-6"><p><strong> Net Profit in AFs: </strong> 
					<span class="pull-right"><?php echo $project['net_profit_afs'].' Afs'; ?></span> </p></div>
                    <div class="col-sm-6"><p> <strong> Net Profit in USD: </strong>
					<span class="pull-right"><?php echo '$'.$project['net_profit_usd']; ?></span></p> </div>
                    <div class="col-sm-6"><p> <a href="project_files/<?php echo $project['project_file']; ?>" class="btn btn-primary" target="_blank"> View File </a> </p></div>
                    <div class="col-md-12"> <hr /> </div>
                    <div class="col-md-6" style="margin: 5px 3px;"> <span style="text-align: center; font-weight:bold;"> Description of Activities </span></div>
                    <div class="col-sm-12"> 
                    	<?php echo $project['description_of_activities']; ?>
                    </div>
                    <div class="col-md-12"> <hr /> </div>
                    <div class="col-sm-12">
                    <a href="#" class="btn btn-primary"><i class="glyphicon glyphicon-edit icon-white"></i> Update </a>
                    <button id="<?php echo $project['project_id']; ?>" onClick="conf(this.id)" class="btn btn-danger" data-toggle="tooltip" title="Delete this item" data-placement="top">
                    <i class="glyphicon glyphicon-trash icon-white"></i> Delete </button>
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