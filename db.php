<?php
	//connect to database using the correct credentials
    $con = mysqli_connect("localhost","root", "", "mysql");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
