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

<div class="center">
  <p>CREATE ACCOUNT</p>
</div>	
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
		
		$name = $_REQUEST['name'];
        $name = mysqli_real_escape_string($con, $name);
		
		$address  = $_REQUEST['address'];
        $address  = mysqli_real_escape_string($con, $address);
		
		$postcode = $_REQUEST['postcode'];
        $postcode = mysqli_real_escape_string($con, $postcode);
		
		$countryregion = $_REQUEST['countryregion'];
        $countryregion = mysqli_real_escape_string($con, $countryregion);
		
		$towncity = $_REQUEST['towncity'];
        $towncity = mysqli_real_escape_string($con, $towncity);
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
			$insertquery    = "INSERT into `customers` (username, password, email, name, address, postcode, countryregion, towncity)
						 VALUES ('$username', '" . md5($password) . "', '$email', '$name', '$address', '$postcode', '$countryregion', '$towncity')";
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

<!-- Registering form -->
    <form class="form" action="" method="post">
        <input type="text" class="register-input" name="username" placeholder="Username" required />
		<input type="password" class="register-input" name="password" placeholder="Password" required> 
        <input type="text" class="register-input" name="email" placeholder="Email Adress" required>
		<input type="text" class="register-input" name="name" placeholder="Full Name" required />
		<input type="text" class="register-input" name="address" placeholder="Address" required>
		<input type="text" class="register-input" name="postcode" placeholder="Postcode" required>
		<input type="text" class="register-input" name="countryregion" placeholder="Country/Region" required>
		<input type="text" class="register-input" name="towncity" placeholder="Town/City" required>
		<input type="submit" name="submit" value="Register" class="register-button">
		<p class="link"><a href="login.php">Login</a></p>
		<p style="color: white" class="padding2">.</p>
    </form>
<?php
    }
?>
<style>
.header-logo {
    padding-top: 3px;
	padding-bottom: 8px;
}
.nav li {
  display: inline-block;
  font-size: 15px;
  padding-top: 10px;
  padding-bottom: 10px;
  background-color: #f4f4f4;
  letter-spacing: 0.5px;
}
h3{
	text-align: center;
	margin-left: 400px;
}
.header-logoe {
	color: white;
	display: inline-block;
	font-size: 25px;
	padding-left: 20px;
	padding-top: 70px;
	background-color: black;
	text-decoration: none;
	font-family: arial;
}
.header-logoee {
	color: white;
	display: inline-block;
	font-size: 10px;
	padding-bottom: 0px;
	padding-top: 0px;
	padding-left: 20px;
	background-color: black;
	float: left;
	text-decoration: none;
	font-family: arial;
}
.w10-padding-100 {
	padding-top: 0px;
	padding-bottom: 0px;
	background-color: black;
}
.word {
	color: white;
	display: inline-block;
	font-size: 30px;
	text-decoration: none;
	text-align: center;
	letter-spacing: 2px;
}
.imag {
  display: block;
  margin-left: auto;
  padding-top: 0px;
  padding-left: 60px;
  padding-right: 0px;
}
div{
  padding-top: 10px;
  padding-right: 5px;
  padding-bottom: 10px;
  padding-left: 5px;
  background-color: black;
  margin: auto;
  font-size: 14px;
  font-family: verdana;
}
.form {
    margin: 50px auto;
    width: 1000px;
    padding: 0px 25px;
    background: white;
}
.register-input {
    font-size: 15px;
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 25px;
    height: 25px;
    width: calc(100% - 23px);
}
.register-button {
    color: #fff;
    background: black;
    border: 0;
    outline: 0;
    width: 100%;
    height: 50px;
    font-size: 16px;
    text-align: centre;
    cursor: pointer;
}
.link {
    color: #666;
	font-family: verdana;
    font-size: 13px;
    font-weight: 125;
    text-align: center;
    margin-bottom: 0px;
	padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
	
}	
ul {
  list-style-type: none;
  text-align: center;
  margin: 0;
  padding: 0;
  overflow: hidden;
  border: 1px #f4f4f4;
  background-color: #f4f4f4;
}
ol {
  width: 650px;
  padding-top: 10px;
  padding-right: 135px;
  padding-bottom: 10px;
  padding-left: 10px;
  background-color: white;
  margin: auto;
  font-family: verdana;
  font-weight: 400;
  font-size: 14px;
  line-height: 1.5;
}
li {
  float: right;
}
li a {
  display: block;
  color: black;
  text-align: center;
  padding: 8px 25px;
  text-decoration: none;
  background-color: rgba(244, 244, 244, 1);
  font-family: arial;
  font-weight: 0;
  font-size: 12px;
}
.center {
  padding: 0px;
  background-color: white;
  text-align: center;
  font-size: 2.75em;
  font-family: Arial;
}
body {
  margin: 0;
  line-height: 1.5;
}
.helpbutton {
	color: #fff;
    background: black;
    border: 0;
    outline: 0;
    width: 13%;
    height: 50px;
    font-size: 16px;
    text-align: center;
    cursor: pointer;
	float: right;
	border-radius: 30px;
}
.contwor {
	color: white;
	display: inline-block;
	font-size: 15px;
	font-family: sans-serif;
	text-decoration: none;
}
</style>