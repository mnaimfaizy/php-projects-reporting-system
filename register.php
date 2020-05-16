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
                <h2><i class="glyphicon glyphicon-edit"></i> New User Registration Form</h2>

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
            <?php if(isset($_GET['reg_result'])) { ?>
                <div class="row">
                	<div class="col-md-10">
                    	<?php if($_GET['reg_result'] == 'success') { ?>
                    	<div class="alert alert-success">
                        	<p> One user has been registered successfully </p>
                        </div>
                        <?php } elseif($_GET['reg_result'] == 'failed') { ?>
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
                            <h3> New User Registration Form </h3>
                            <ul>
                                <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
                                <li>Emails must have a valid email format</li>
                                <li>Passwords must be at least 6 characters long</li>
                                <li>Passwords must contain
                                    <ul>
                                        <li>At least one uppercase letter (A..Z)</li>
                                        <li>At least one lower case letter (a..z)</li>
                                        <li>At least one number (0..9)</li>
                                    </ul>
                                </li>
                                <li>Your password and confirmation must match exactly</li>
                            </ul>
                        </div>
                    </div>
                </div>
                        <form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                                                    method="post" 
                                                    name="registration_form">
            	<div class="row">
                <div class="col-md-5">
            	<div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>
                </div>
                <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope red"></i></span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address">
                </div>
                </div>
                </div> <br /><br />
                <div class="row">
                <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                </div>
                <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-repeat red"></i></span>
                    <input type="password" name="confirmpwd" id="confirmpwd" class="form-control" placeholder="Confirm Password">
                </div>
                </div>
                </div> <br /><br />
                <div class="row">
                <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-briefcase red"></i></span>
                    <select name="group" id="group" class="form-control">
                    	<option value="Administrator" selected> Administrator </option>
                        <option value="Manager"> Manager </option>
                    </select>
                </div>
                </div>
                	<div class="col-md-6">
                    	<input type="button" 
                               value="Register" 
                               onclick="return regformhash(this.form,
                                               this.form.username,
                                               this.form.email,
                                               this.form.password,
                                               this.form.confirmpwd,
                                               this.form.group);"
                               class="btn btn-primary btn-sm pull-left" />
                    </div>
                </div>	
                </form>
            </div> <!-- /box-content -->
         </div> <!-- /box-inner -->
      </div> <!-- col-md-12 -->
     </div> <!-- /row -->
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