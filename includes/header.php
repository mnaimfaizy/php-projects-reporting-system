<?php date_default_timezone_set('Asia/Kabul'); ?>
<?php // Include database connection and functions here.  See 3.1. 
	include_once 'includes/db_connect.php';
	include_once 'includes/database.php';
	include_once 'includes/functions.php';
	include_once 'includes/UploadFile.php';
	
sec_session_start(); 
if(login_check($mysqli) != true) {
        // Redirect the user to login page
		header('Location: login.php');
		exit();
}
$page_name = $_SERVER['PHP_SELF'];
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--
        ===
        This comment should NOT be removed.

        Charisma v2.0.0

        Copyright 2012-2014 Muhammad Usman
        Licensed under the Apache License v2.0
        http://www.apache.org/licenses/LICENSE-2.0

        http://usman.it
        http://twitter.com/halalit_usman
        ===
    -->
    <meta charset="utf-8">
    <title>Afghan Skills</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>
    <link href='css/search_style.css' rel="stylesheet">
    
    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
	<script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>
    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">
	<style type="text/css">
		.error {
			display: block;
			color: #FF0004;
			padding-top: 3px;
		}
	</style>
</head>

<body>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"> <img alt="Charisma Logo" src="img/logo20.png" class="hidden-xs"/>
                <span>Charisma</span></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?php echo $_SESSION['username']; ?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="includes/logout.php">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-tint"></i><span
                        class="hidden-sm hidden-xs"> Change Theme / Skin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
                </ul>
            </div>
            <!-- theme selector ends -->

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="tour.php"><i class="glyphicon glyphicon-globe"></i> Get Tour</a></li>
                <li>
                    <input placeholder="Search projects by title" id="searchQuery" class="search-query form-control col-md-12" type="text" style="width:300px" />
                    <script type="text/javascript">
						$('input#searchQuery').on('keyup', function() {
							var query = $('input#searchQuery').val();
							var myExp = new RegExp(query, "i");
							if($.trim(query) != '') {
								$.post('ajax/search_result.php', {query: query}, function(data) {
									$('div#update').html(data);
								});	
							} else {
								$('div#update').html(null);
							}
						});
					</script>
                </li>
            </ul>

        </div>
        <div id="update"> </div>
    </div>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="index.php"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                        </li>
                        <li class="accordion">
                         <a href="#" id="project"><i class="glyphicon glyphicon-user"></i><span> Clients </span></a>
                         <ul class="nav nav-pills nav-stacked">
                         <li><a class="ajax-link" href="clients.php"><i class="glyphicon glyphicon-plus"></i><span> Add New Client</span></a></li>
                         <li><a class="ajax-link" href="clients_list.php"><i class="glyphicon glyphicon-eye-open"></i><span> View Clients</span></a></li>
                         </ul>
                         </li>
                         <li class="accordion">
                         <a href="#" id="project"><i class="glyphicon glyphicon-list"></i><span> Vendors </span></a>
                         <ul class="nav nav-pills nav-stacked">
                         <li><a class="ajax-link" href="vendors.php"><i class="glyphicon glyphicon-plus"></i><span> Add New Vendor</span></a></li>
                         <li><a class="ajax-link" href="vendor_list.php"><i class="glyphicon glyphicon-eye-open"></i><span> View Vendors</span></a></li>
                         </ul>
                         </li>
                         <li class="accordion">
                         <a href="#" id="project"><i class="glyphicon glyphicon-plus-sign"></i><span> Projects</span></a>
                         <ul class="nav nav-pills nav-stacked">
                         <li><a class="ajax-link" href="projects.php"><i class="glyphicon glyphicon-plus"></i><span> Add New Project</span></a></li>
                         <li><a class="ajax-link" href="project_list.php"><i class="glyphicon glyphicon-eye-open"></i><span> View Projects</span></a></li>
                         </ul>
                         </li>
                        <li><a class="ajax-link" id="report" href="reports.php"><i class="glyphicon glyphicon-list-alt"></i>
                        	<span> Reports</span></a>
                        </li>
                        <?php if(isset($_SESSION['group'])) { 
							if($_SESSION['group'] == 'Administrator') { ?>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i><span> Users</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a class="ajax-link" href="register.php">Register User</a></li>
                                <li><a class="ajax-link" href="user_list.php">User List</a></li>
                            </ul>
                        </li>
                        <?php } } ?>
                        <li><a href="includes/logout.php"><i class="glyphicon glyphicon-lock"></i><span> Log Out</span></a>
                        </li>
                    </ul>
                    <label id="for-is-ajax" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>
