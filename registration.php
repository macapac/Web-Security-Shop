<?php
include 'header.php'; // Include header
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
	//connect to db using the db script
    require('db.php');
    // When web page form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {		//checks if username has been filled in
        $username = $_REQUEST['username'];
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = $_REQUEST['email'];
        $email    = mysqli_real_escape_string($con, $email);
        $password = $_REQUEST['password'];
        $password = mysqli_real_escape_string($con, $password);
        
		//check if username already exists
		$checkquery = "SELECT * FROM customers WHERE username = '$username'";
		$result1 = mysqli_query($con, $checkquery);		//execute the query
		if (mysqli_num_rows($result1) > 0){
			echo "<div class='form'>
                  <h3>Username already exists</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
                  </div>";
		}else{
		//if username doesnt exist then add to DB
			$insertquery    = "INSERT into `customers` (username, password, email)
						 VALUES ('$username', '" . md5($password) . "', '$email')";
			//.md5 is a function which hashes the password
			$result   = mysqli_query($con, $insertquery);	//execute the query
			if ($result) {		//checking if query executed
				echo "<div class='form'>
					  <h3>You are registered successfully.</h3><br/>
					  <p class='link'>Click here to <a href='login.php'>Login</a></p>
					  </div>";
			} else {
				echo "<div class='form'>
					  <h3>Required fields are missing.</h3><br/>
					  <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
					  </div>";
			}
		}
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress" required>
        <input type="password" class="login-input" name="password" placeholder="Password" required>
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>