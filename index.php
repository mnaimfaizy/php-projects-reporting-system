<?php include 'includes/header.php'; ?>

<script type="application/javascript">
$(document).ready(function() {
	$("#taxation").change(function(){
		var taxation = $('#taxation').val();
		var project_id = $('#project_id').val();
		//alert(taxation);
		$.get('ajax/change_taxation.php?taxation='+taxation+'&project_id='+project_id, function(data) {
			if(data == 'true') {
				alert('Taxation has been changed successfully!');
			}
			else if(data == 'false') {
				alert('Oops! There seems to be problem, please try again.');	
			}
		});
	});
});
</script>
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
                <ul class="breadcrumb">
                    <?php echo breadcrumb(); ?>
                </ul>
            </div>
<div class=" row">
	<div class="col-md-3 col-sm-3 col-xs-6">
    </div>
	<?php $sql = "SELECT COUNT(*) as total FROM members"; 
		$membersResult = $database->query($sql);
		$members = $database->fetch_array($membersResult); ?>
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?php if(count($members['total']) > 0) { echo $members['total']; } else { echo '0'; } ?> members." class="well top-block" href="#">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Total Members</div>
            <?php if($database->num_rows($membersResult) > 0) { ?>
            <div><?php echo $members['total']; ?></div>
            <span class="notification"><?php echo $members['total']; ?></span>
            <?php } else { ?>
            <div>0</div>
            <span class="notification">0</span>
            <?php } ?>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
    <?php $sql = "SELECT COUNT(*) as total FROM project WHERE status='Active'"; 
		$projectResult = $database->query($sql);
		$projects = $database->fetch_array($projectResult); ?>
        <a data-toggle="tooltip" title="<?php if(count($projects['total']) > 0) { echo $projects['total']; } else { echo '0'; } ?> projects." class="well top-block" href="#">
            <i class="glyphicon glyphicon-list green"></i>
			<?php if($database->num_rows($projectResult) > 0) { ?>
            <div>Total Projects</div>
            <div><?php echo $projects['total']; ?></div>
            <span class="notification green"><?php echo $projects['total']; ?></span>
            <?php } else { ?>
            <div>0</div>
            <span class="notification green">0</span>
            <?php } ?>
        </a>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6">
    </div>
</div>
<div class="row">
	<div class="box col-md-6">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Taxation Quick Report </h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                	
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Taxation</th>
                        </tr>
                        </thead>
                        <?php $no = 1;
							$sql = "SELECT project_id, project_title, description_of_activities, taxation FROM project WHERE taxation='No'";
							$project_result = $database->query($sql);
							if($database->num_rows($project_result) > 0) {
							while($project = $database->fetch_array($project_result)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td class="center"><?php echo $project['project_title']; ?></td>
                            <td class="center col-md-7"><?php echo $project['description_of_activities']; ?></td>
                            <td class="center">
                                <input type="hidden" id="project_id" value="<?php echo $project['project_id']; ?>" />
                                <select name="taxation" id="taxation" class="bg-info">
                                	<option value="Yes" 
									<?php if($project['taxation'] == 'Yes') { echo 'selected="selected"'; } ?>> Yes </option>
                                    <option value="No" 
									<?php if($project['taxation'] == 'No') { echo 'selected="selected"'; } ?>> No </option>
                                </select>
                            </td>
                        </tr>
                        <?php } } else { ?>
                        <tr>
                        	<td colspan="4"> <h3> No available record for projects with no taxation. </h3> </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <!--/span-->
        <div class="box col-md-6">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Completed Projects Quick Report </h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                	
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Completed</th>
                        </tr>
                        </thead>
                        <?php $no = 1;
							$sql = "SELECT project_id, project_title, description_of_activities, completed FROM project ORDER BY project_id DESC";
							$project_result = $database->query($sql);
							if($database->num_rows($project_result) > 0) {
							while($project = $database->fetch_array($project_result)) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td class="center"><?php echo $project['project_title']; ?></td>
                            <td class="center col-md-7"><?php echo $project['description_of_activities']; ?></td>
                            <td class="center">
                                <input type="hidden" id="project_id" value="<?php echo $project['project_id']; ?>" />
                                <select name="completed" id="completed" class="bg-info">
                                	<option value="Yes" 
									<?php if($project['completed'] == 'Yes') { echo 'selected="selected"'; } ?>> Yes </option>
                                    <option value="No" 
									<?php if($project['completed'] == 'No') { echo 'selected="selected"'; } ?>> No </option>
                                </select>
                            </td>
                        </tr>
                        <?php } } else { ?>
                        <tr>
                        	<td colspan="4"> <h3> No available record for projects with no taxation. </h3> </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <!--/span-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->
    <div class="row">
    	<div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-th"></i> Projects Renewal Report </h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                	<table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Organization</th>
                            <th>Client Name</th>
                            <th>End Date </th>
                            <th> Status </th>
                        </tr>
                        </thead>
                        <tbody>
                    <?php $sql = "SELECT project_id, project_title, organization, client_name, end_date FROM project";
							$sql_result = $database->query($sql);
							while($rows = $database->fetch_array($sql_result)) {
							$end_date = $rows['end_date'];
							
							$end_date1 = date('Y-m-d', $end_date);
							$notify_date = date('Y-m-d', strtotime(date('Y-m-d', strtotime($end_date1)) . " -30 days"));
							//echo 'Notification Date: ' . $notification_date = date('Y-m-d', strtotime('today - 10 days'));
							//$date = date_create('2015-09-13');
							//echo 'End Date: ' . date_format($date, 'Y-m-d');
							//date_sub($date, date_interval_create_from_date_string('30 days'));
							//echo 'End Date: ' . $end_date = date_format($date, 'Y-m-d');
							//echo strtotime(date('Y-m-d', strtotime('today -30 days')));
						if($end_date1 >= $notify_date) { ?> 
                        	<tr>
                                <td> <?php echo $rows['project_id']; ?> </td>
                                <td> <?php echo $rows['project_title']; ?> </td>
                                <td> <?php echo $rows['organization']; ?> </td>
                                <td> <?php echo $rows['client_name']; ?> </td>
                                <td> <?php echo $rows['end_date']; ?> </td>
                                <td> Status <?php ?></td>
                            </tr>
                    <?php 
						} else { ?>
							<tr>
                                <td colspan="6"> <h2> No project for this section. </td>
                            </tr>
						<?php }
							} ?>
                        </tbody>
                    </table>
                </div>
             </div>
          </div>
    </div>
</div><!--/fluid-row-->
    <hr>

<?php include 'includes/footer.php'; ?>