<!DOCTYPE html>
<html>
<title>AJ-Garments l Login</title>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style1.css" />
</head>
<body>
<!-- Navbar (sit on top) -->
	<ul class="nav">
    <li><b><a href="logout.php">LOGOUT</a></b></li>
	<li><b><a href="faq.php">FAQ</a></b></li>
	<li><b><a href="basket.php">BASKET</a></b></li>
	<li><b><a href="account.php">ACCOUNT</a></b></li>
	<li><b><a href="shop.php">SHOP</a></b></li>
	<li><b><a href="dashboard.php">HOME</a></b></li>
	<li><a href="dashboard.php" style="padding:0px;"><img class="header-logo" src="img/logo.png" style="padding-top: 3px;
	padding-bottom: 8px; cursor:pointer; float:left; width:25%;"> </a> </li>
	</ul>
<!-- Sign in title -->
<div class="center">
  <p>SIGN IN</p>
</div>
<body>

<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = $_REQUEST['username'];
        $username = mysqli_real_escape_string($con, $username);
        $password = $_REQUEST['password'];
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query = "SELECT * FROM `customers` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
			$row = mysqli_fetch_array ($result);
            $_SESSION['username'] = $username;
			$_SESSION['cust_id'] = $row["CustomerID"];

            // Redirect to user dashboard page
			echo "<div class='form'>
                  <h3>Signed In Successfully</h3><br/>
                  <p class='link'><a href='dashboard.php'>Return To Home</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/Password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
<!-- Form for entering username and password, register account button -->
    <form class="form" method="post" name="login">
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true" required />
        <input type="password" class="login-input" name="password" placeholder="Password" required />
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">Register Account</a></p>
		<p>&nbsp;</p>
  </form>

  <!-- contact button -->
<button class="helpbutton">
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
<i class="fas fa-question" style="font-size:13px;color: white;"></i>
	<span><a href="dashboard.php #contact" class="contwor">Contact</a></span>
</button>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
  <!-- End page content -->
</div>
<!-- Footer -->
<footer class="w3-bottomleft w3-black w10-padding-100">
  <td>
  <!-- Currency dropdown in footer -->
	<select class="dropdown" >
	<option value="GBP">GBP £</option>
	<option value="EUR">EUR €</option>
	<option value="USD">USD $</option>
	<option value="CAD">CAD $</option>
</select>
</td>
  <p><a class="header-logoe">AJ-GARMENTS</a></p>
    <p><a class="header-logoee">© 2021 </a></p>
	<!-- Payment methods image -->
	<img src="img/bank.png" style="width:20%" class="imag" >
</footer>
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
	

