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
            
	<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Reports to Generate</h2>

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
            <div class="row">
            	<div class="col-md-4">
            	<a href="budget_report.php" target="quick_report" class="btn btn-primary btn-sm"> 
                <i class="glyphicon glyphicon-signal"></i> Budget Report 
                </a>
                </div>
                <div class="col-md-4">
                <a href="projects_report.php" target="quick_report" class="btn btn-primary btn-sm"> 
                <i class="glyphicon glyphicon-briefcase"></i> Projects Report 
                </a>
                </div>
                <div class="col-md-4">
                <a href="taxation_report.php" target="quick_report" class="btn btn-primary btn-sm"> 
                <i class="glyphicon glyphicon-filter"></i> Taxation Report 
                </a>
                </div>
                
            </div> <br />
            <div class="row">
            	<div class="col-md-4">
                <a href="completed_report.php" target="quick_report" class="btn btn-primary btn-sm"> 
                <i class="glyphicon glyphicon-check"></i> Completed Projects Report 
                </a>
                </div>
            	<div class="col-md-4">
            	<a href="clients_report.php" target="quick_report" class="btn btn-primary btn-sm"> 
                <i class="glyphicon glyphicon-signal"></i> Clients List 
                </a>
                </div>
                <div class="col-md-4">
                <a href="vendors_report.php" target="quick_report" class="btn btn-primary btn-sm"> 
                <i class="glyphicon glyphicon-briefcase"></i> Vendors 
                </a>
                </div>
            </div>
            </div> <!-- /box-content -->
         </div> <!-- /box-inner -->
      </div> <!-- col-md-12 -->
     </div> <!-- /row -->
     
     <div class="row">
     	<div class="col-md-12">
        	<iframe src="for_iframe.php" name="quick_report" class="col-md-12" scrolling="yes" style="height:500px;"></iframe>
        </div>
     </div>

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->
    <hr>
<?php include 'includes/footer.php'; ?>