<?php
	//starts a session to store info about our specific user
    session_start();
	//if a username has not been given to the session then redirect to login page
    if(!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }
?>
