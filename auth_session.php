<?php
    //this to make cookies accessable only in sever
    ini_set('session.cookie_httponly', 1); 
    //this to prevent sending the cookies with the cross site request (for CSRF)
    ini_set('session.cookie_samesite', 'Strict');
    session_start();

    // adding these headers to prevent chaching
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
	
    if(!isset($_SESSION["username"]) || !preg_match('/^[a-zA-Z0-9_]+$/', $_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }
    // I added session time out here for 30 minutes inactivity
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
    $_SESSION['last_activity'] = time();

?>
