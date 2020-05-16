<?php 
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>
<?php include 'includes/header.php'; ?>
<?php
	if(isset($_GET['res'])) {
		if($_GET['res'] == true) { $_SESSION['delMessage'] = true; }
		else if($_GET['res'] == false) { $_SESSION['delMessage'] = false; }
		
		$location = "http://localhost/projects/clients_list.php";
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
			window.location = "includes/delete_items.php?client_id="+id+"&task=delete";	
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
                <strong> Oh Snap! </strong> client deletion was not completed successfully! Please try again.
            </div>
        </div>
    <?php } else if($_SESSION['delMessage'] == true) { ?>
    	<div class="col-md-8">
        	<div class="alert alert-success">
            	<button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong> Well done! </strong> You have successfully deleted one client form the database.
            </div>
        </div>
    <?php } unset($_SESSION['delMessage']); } ?>
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2><i class="glyphicon glyphicon-user"></i> Clients List</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                    class="glyphicon glyphicon-chevron-up"></i></a>
            <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
        </div>
    </div>
    <div class="box-content">
    <div class="alert alert-info">This list provides information about clients which are entered in the database </div>
    </div>
    </div>
    </div>
    </div>
    <div class="row">
   
            <div class="box-inner"> 
        	<div class="box col-md-12">               
            <div class="box-content">
                    <div class="row">
                    	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        	<thead>
                            <tr>
                                <th> No. </th>
                                <th> Client / Organization </th>
                                <th> Organization Type </th>
                                <th> Address </th>
                                <th> Telephone </th>
                                <th> Email </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                             <?php $no = 1;
							 	$client_result = $database->query("SELECT * FROM clients ORDER BY client_id DESC");
								while($client = $database->fetch_array($client_result)) {
							?>
                            <tr>
                            	<td> <?php echo $no++; ?> </td>
                            	<td> <?php echo $client['client_organization']; ?> </td>
                                <td> <?php echo $client['organization_type']; ?> </td>
                                <td> <?php echo $client['address']; ?> </td>
                                <td> <?php echo $client['telephone']; ?> </td>
                                <td> <?php echo $client['email']; ?> </td>
                                <td> 
                                	<a class="btn btn-info" href="#">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Edit
                                    </a>
                                    <button name="delete_client" id="<?php echo $client['client_id']; ?>" onClick="conf(this.id)" class="btn btn-danger"> <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Delete </button>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/span-->
		
    </div><!--/row-->
    <!-- content ends -->
    </div><!--/#content.col-md-0-->

</div><!--/fluid-row-->
    <hr>
<?php include 'includes/footer.php'; ?>