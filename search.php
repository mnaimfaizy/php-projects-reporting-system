<?php 
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<?php include 'includes/header.php'; ?>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
        
            <div>
                <ul class="breadcrumb">
                    <?php echo breadcrumb(); ?>
                </ul>
            </div>
     <?php if(isset($_GET['project_id']) && !empty($_GET['project_id'])) { ?>
     <?php $project_id = $_GET['project_id']; 
		$project_result = $database->query("SELECT * FROM project WHERE project_id=$project_id LIMIT 1");
		$project = $database->fetch_array($project_result);
	?>
    <div class="row">
    <div class="col-md-9">
    <div class="alert alert-info">You searched for <strong> <?php echo $project['project_title']; ?> </strong> project and the result is bellow. 
    </div>
    </div>
    
    <div class="col-md-3">
    	<div class="center">
        <a href="generate_pdf.php?page=search_query&project_id=<?php echo $project_id; ?>" target="_blank" class="btn btn-primary">
        <i class="whitespace"></i><i class="glyphicon glyphicon-file"></i> Generate Report </a>
        </div>
    </div>
    </div>
    <div class="row">
    
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>#<?php echo $project['project_id'] . " - " . $project['project_title']; ?> </h2>

                    
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
                    <div class="col-sm-6"><p><strong> Unit: </strong>
                    <span class="pull-right"> <?php echo $project['unit']; ?> </span></p> 
                    </div>
                    <div class="col-sm-6"><p><strong> Taxation: &nbsp;</strong> 
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
                    <div class="col-sm-6"><p><strong> Recived Date: </strong><span class="pull-right"> <?php echo $project['received_date']; ?></span> </p></div>
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
                    </div>
                </div>
            </div>
        </div>
        <!--/span-->
    </div><!--/row-->
    <?php } else { ?>
    <div class="row">
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
    <div class="alert alert-danger">Please Search for a project in the search box, we haven't find anything yet. </div>
    </div>
    </div>
    </div>
    </div>
    <?php } ?>
    <!-- content ends -->
    </div><!--/#content.col-md-0-->

</div><!--/fluid-row-->
    <hr>
<?php include 'includes/footer.php'; ?>