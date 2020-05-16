<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<?php // Process the Login information

sec_session_start(); // Our custom secure way of starting a PHP session.

if (isset($_POST['email']) && isset($_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.

    if (login($email, $password, $mysqli) == true) {
        // Login success 
        header('Location: index.php');
    } else {
        // Login failed 
        header('Location: login.php?error=1');
    }
}
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
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>

<body>
<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Welcome to Afghan Skils Projects DB</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
        	<?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger">
                    <?php echo '<p>Error Logging In!</p>';
						  echo '<p> Please type correct email/password </p>'; ?>
                </div>
			<?php } ?> 
            <div class="alert alert-info">
                Please login with your Username and Password.
            </div>
            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="login_form">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="email" class="form-control" placeholder="Email Address" name="email" required>
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                    </div>
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <input type="button" class="btn btn-primary" onclick="formhash(this.form, this.form.password);" value="Logion">
                    </p>
                </fieldset>
            </form>
            
            <?php
        if (login_check($mysqli) == true) {
				echo '<p>Currently logged ' . $logged . ' as <strong> ' . htmlentities($_SESSION['username']) . '</strong>.</p>';
				echo '<p>Do you want to change user? <a href="includes/logout.php">Log out</a>.</p>';
		} else {
				echo '<p>Currently logged ' . $logged . '.</p>';
		}
		?> 
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->

<!-- jQuery -->
<script src="bower_components/jquery/jquery.min.js"></script>
<script type="text/JavaScript" src="js/sha512.js"></script> 
<script type="text/JavaScript" src="js/forms.js"></script>

<!-- external javascript -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>
<script>
    // console.log(hex_sha512('password'));
</script>
    
</body>
</html>
