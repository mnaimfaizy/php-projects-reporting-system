<?php // Functions that will be used in this project

include_once 'config.ini.php';

// This function is used for security purpose of using session in the website
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id(true);    // regenerated the session, delete the old one. 
} // End of sec_session_start()


/* ---- This function will check the email and password against the database. 
	It will return true if there is a match. 
 * --- login() ----
 */
function login($email, $password, $mysqli) {
    // Using prepared statements means that SQL injection is not possible. 
    if ($stmt = $mysqli->prepare("SELECT id, username, password, salt, member_group 
        FROM members
       WHERE email = ?
        LIMIT 1")) {
        $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($user_id, $username, $db_password, $salt, $group);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (checkbrute($user_id, $mysqli) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                return false;
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($db_password == $password) {
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
					// XSS protection as we might print this value
                    $group = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $group);
                    $_SESSION['group'] = $group;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                    return false;
                }
            }
        } else {
            // No user exists.
            return false;
        }
    }
} // End of login()


// ------ To disable brute force attacks -------
// This will lock the user's account after five failed login attempts. --
function checkbrute($user_id, $mysqli) {
	
	// Get timestamp of current time
	$now = time();
	
	// All login attempts are counted from the past 2 hours
	$valid_attempts = $now - (2 * 60 * 60);
	
	if($stmt = $mysqli->prepare("SELECT time
								FROM login_attempts
								WHERE user_id = ?
								AND time > '$valid_attempts'")) {
	
		$stmt->bind_param('i', $user_id);
		
		// Execute the prepared query.
		$stmt->execute();
		$stmt->store_result();
		
		// If there have been more than 5 failed logins
		if($stmt->num_rows > 5) {
			return true;	
		} else {
			return false;
		}
									
	}
	
} // End of checkbrute()

// ----- Check logged in status -----
// We do this by checking the "user_id" and the "login_string" SESSION variables. The "login_string" SESSION variable
// has the user's browser information hashed together with the password. 
// We user the browser information because it is very nlikely that the user will change their browser mid-session.
// Doing this helps prevent session hijacking.
function login_check($mysqli) {
    // Check if all session variables are set 
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        // Get the user-agent string of the user.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password 
                                      FROM members 
                                      WHERE id = ? LIMIT 1")) {
            // Bind "$user_id" to parameter. 
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // If the user exists get variables from result.
                $stmt->bind_result($password);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string) {
                    // Logged In!!!! 
                    return true;
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    } else {
        // Not logged in 
        return false;
    }
} // End of login_check()

// ------------------------------ Sanitize URL from PHP_SELF --------------------------------------
// This function sanitizes the output from the PHP_SELF server variable. 
// It is a modification of a function of the same name used by the WordPress Content Management System
function esc_url($url) {
	
	if('' == $url) {
		return $url;
	}
	
	$url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
	
	$strip = array('%0d', '%0a', '%0D', '%0A');
	$url = (string) $url;
	
	$count = 1;
	while($count) {
		$url = str_replace($strip, '', $url, $count);	
	}
	
	$url = str_replace(';//', '://', $url);
	
	$url = htmlentities($url);
	
	$url = str_replace('&amp;', '&#038', $url);
	$url = str_replace("'", '&#039', $url);
	
	if($url[0] !== '/') {
		// We're only interested in relative links from $_SERVER['PHP_SELF']
		return '';	
	} else {
		return $url;
	}
	
} // End of esc_url()

// -------------------------------------- Get Page Name ----------------------------------
// Get the loaded page name from the browser's URL
function get_page_name() {
	return basename($_SERVER['PHP_SELF']);	
}

// Breadcrumb function ----------------------------------------------------------------
// To display breadcrumb for the related page
function breadcrumb() {
	$page_name = get_page_name();
	$output = '';
	if($page_name == 'index.php') {
		$output .= '<li>';
            $output .= '<a href="index.php">Home</a>';
        $output .= '</li>';
        $output .= '<li>';
            $output .= '<span> Dashboard </span>';
        $output .= '</li>';
	}
	elseif($page_name == 'projects.php') {
		$output .= '<li>';
            $output .= '<a href="index.php">Home</a>';
        $output .= '</li>';
        $output .= '<li>';
            $output .= '<span> Projects </span>';
        $output .= '</li>';
	}
	elseif($page_name == 'register.php') {
		$output .= '<li>';
            $output .= '<a href="index.php">Home</a>';
        $output .= '</li>';
        $output .= '<li>';
            $output .= '<span> Register </span>';
        $output .= '</li>';
	}
	elseif($page_name == 'reports.php') {
		$output .= '<li>';
            $output .= '<a href="index.php">Home</a>';
        $output .= '</li>';
        $output .= '<li>';
            $output .= '<span> Reports </span>';
        $output .= '</li>';
	}
	elseif($page_name == 'user_list.php') {
		$output .= '<li>';
            $output .= '<a href="index.php">Home</a>';
        $output .= '</li>';
        $output .= '<li>';
            $output .= '<span> User List </span>';
        $output .= '</li>';
	}
	elseif($page_name == 'project_list.php') {
		$output .= '<li>';
            $output .= '<a href="index.php">Home</a>';
        $output .= '</li>';
		$output .= '<li>';
            $output .= '<a href="prjects.php">Projects</a>';
        $output .= '</li>';
        $output .= '<li>';
            $output .= '<span> Project List </span>';
        $output .= '</li>';
	}
	elseif($page_name == 'vendors.php') {
		$output .= '<li>';
            $output .= '<a href="index.php">Home</a>';
        $output .= '</li>';
        $output .= '<li>';
            $output .= '<span> Vendors </span>';
        $output .= '</li>';
	}
	elseif($page_name == 'vendor_list.php') {
		$output .= '<li>';
            $output .= '<a href="index.php">Home</a>';
        $output .= '</li>';
		$output .= '<li>';
            $output .= '<a href="vendors.php">Vendors</a>';
        $output .= '</li>';
        $output .= '<li>';
            $output .= '<span> Vendor List </span>';
        $output .= '</li>';
	}
	elseif($page_name == 'clients.php') {
		$output .= '<li>';
            $output .= '<a href="index.php">Home</a>';
        $output .= '</li>';
        $output .= '<li>';
            $output .= '<span> Clients </span>';
        $output .= '</li>';
	}
	elseif($page_name == 'clients_list.php') {
		$output .= '<li>';
            $output .= '<a href="index.php">Home</a>';
        $output .= '</li>';
		$output .= '<li>';
            $output .= '<a href="clients.php">Clients</a>';
        $output .= '</li>';
        $output .= '<li>';
            $output .= '<span> Clients List </span>';
        $output .= '</li>';
	}
	return $output;
} // End of breadcrumb()