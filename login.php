<?php
session_start();
include 'header.php'; // Include the header

require('db.php'); // Include the database connection

// When form submitted, check and create user session
if (isset($_POST['username'])) {
    // Escape special characters in username and password to prevent SQL Injection
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    // Check if user exists in the database with the correct password
    $query = "SELECT * FROM `customers` WHERE username='$username' AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query);

    switch (mysqli_num_rows($result)) {
        case 1:
            $row = mysqli_fetch_array($result);
            $_SESSION['username'] = $username; // Store username in session
            $_SESSION['cust_id'] = $row['CustomerID']; // Store customer ID in session

            // Success message and redirection link
            echo "<div class='form'>
              <span>Welcome, <b>" . htmlspecialchars($_SESSION['username']) . "</b>!</span>
                    <h3>Signed In Successfully</h3><br/>
                    <p class='link'><a href='dashboard.php'>Return To Home</a></p>
                  </div>";
            break;
        default:
            // Error message for incorrect login
            echo "<div class='form'>
                    <h3>Incorrect Username/Password.</h3><br/>
                    <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
            break;
    }
} else {
?>

<!-- Sign In Form -->
<div class="center">
  <p>SIGN IN</p>
</div>
<div class="form">
    <form method="post" name="login">
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true" required />
        <input type="password" class="login-input" name="password" placeholder="Password" required />
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">Register Account</a></p>
    </form>
</div>

<?php
}
?>



<style>
body{
	line-height:1.5;
}
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
.imag {
  display: block;
  margin-left: auto;
  padding-top: 0px;
  padding-left: 60px;
  padding-right: 0px;
}
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  line-height: 1.5;
}
h3 {
	text-align: center;
}
.form {
    margin: 50px auto;
    width: 1000px;
    padding: 0px 25px;
    background: white;
}
.login-input {
    font-size: 15px;
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 25px;
    height: 25px;
    width: calc(100% - 23px);
}
.login-button {
    color: #fff;
    background: black;
    border: 0;
    outline: 0;
    width: 100%;
    height: 50px;
    font-size: 16px;
    text-align: center;
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
.center {
  padding: 0px;
  background-color: white;
  text-align: center;
  font-size: 2.75em;
  font-family: Arial;
}
</style>
	

