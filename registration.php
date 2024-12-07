<?php
include 'header.php';

//csrf token
if (!isset($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
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
    //if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if (isset($_REQUEST['username'])) {
      $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
      $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
      $address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
      $postcode = htmlspecialchars($_POST['postcode'], ENT_QUOTES, 'UTF-8');
      $countryregion = htmlspecialchars($_POST['countryregion'], ENT_QUOTES, 'UTF-8');
      $towncity = htmlspecialchars($_POST['towncity'], ENT_QUOTES, 'UTF-8');
        
      $stmt_check = $con->prepare("SELECT * FROM customers WHERE username = ?");
      $stmt_check -> bind_param("s", $username);
      $stmt_check->execute();
      $result_check = $stmt_check -> get_result();

      if ($result_check->num_rows > 0){
        echo "<div class='form'>
                    <h3>Username already exists</h3><br/>
                    <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
                    </div>";
      } else {
        $stmt_insert = $con->prepare("INSERT INTO `customers` (username, password, email, name, address, postcode, countryregion, towncity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $hashed_password = hash('sha256', $password);
        $stmt_insert->bind_param("ssssssss", $username, $hashed_password, $email, $name, $address, $postcode, $countryregion, $towncity);
        
        if ($stmt_insert->execute()) {		
          echo "<div class='form'>
              <h3>You are registered successfully.</h3><br/>
              <p class='link'>Click here to <a href='login.php'>Login</a></p>
              </div>";
        } else {
            die("Error inserting data: " . $stmt_insert->error);
        }
      }
    } else {
?>

<!-- Registering form -->
    <form class="form" action="" method="post">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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