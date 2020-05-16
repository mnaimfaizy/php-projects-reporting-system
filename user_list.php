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
    <?php if(isset($_SESSION['group'])) { 
			if($_SESSION['group'] == 'Administrator') { ?>
    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Registered User List</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <div class="alert alert-info">This list provides information about users registered in the database which are having access to insert, update and delete projects according to their group </div>
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>No.</th>
        <th>Username</th>
        <th>Email</th>
        <th>Group Member</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php $no = 1; 
		$sql = "SELECT * FROM members"; 
		$sql_result = $database->query($sql);
		while($users = $database->fetch_array($sql_result)) { ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td class="center"><?php echo $users['username']; ?></td>
        <td class="center"><?php echo $users['email']; ?></td>
        <td class="center"><?php echo $users['member_group']; ?></td>
        <td class="center">
            <a class="btn btn-success" href="change_password.php?user_id=<?php echo $users['user_id']; ?>"> 
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                Change Password
            </a>
            <a class="btn btn-info" href="#">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Edit
            </a>
            <a class="btn btn-danger" href="#">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->
	<?php } else { ?>
	<div class="row">
    	<div class="col-md-12">
        	<h3 style="text-align:center;"> Dear <strong> <?php echo $_SESSION['username']; ?> </strong>, You don't have access to this page. </h3>
        </div>
    </div>
	<?php } } ?>
    <!-- content ends -->
    </div><!--/#content.col-md-0-->

</div><!--/fluid-row-->
    <hr>
<?php include 'includes/footer.php'; ?>