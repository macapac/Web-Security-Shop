<?php
session_start();
include 'header.php';
require('db.php');

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$login_attempt_delay = 8; // seconds

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {
        if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die('Invalid CSRF token');
        }

        if (isset($_SESSION['last_login_attempt']) && time() - $_SESSION['last_login_attempt'] < $login_attempt_delay) {
            $remaining_time = $login_attempt_delay - (time() - $_SESSION['last_login_attempt']);
            echo "<script>alert('Please wait $remaining_time more seconds before trying again.');</script>";
        } else {
            $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
            $password = $_POST['password'];

            // Fetch user details from the database
            $stmt = $con->prepare("SELECT CustomerID, password FROM `customers` WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    // Store CustomerID and username in session
                    $_SESSION['CustomerID'] = $row['CustomerID'];
                    $_SESSION['username'] = $username;

                    echo "<script>window.location = 'dashboard.php';</script>"; // Redirect on successful login
                    exit;
                } else {
                    $_SESSION['last_login_attempt'] = time();
                    $remaining_time = $login_attempt_delay;
                }
            } else {
                $_SESSION['last_login_attempt'] = time();
                $remaining_time = $login_attempt_delay;
            }
        }
    }
}
?>


<div class="center">
    <p>SIGN IN</p>
</div>
<div class="form">
    <form method="post" name="login" id="login-form"> 
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true" required />
        <input type="password" class="login-input" name="password" placeholder="Password" required />
        <input type="submit" value="Login" name="submit" class="login-button" id="submit-button"/>
        <p class="link"><a href="registration.php">Register Account</a></p>
    </form>
    <?php if (isset($remaining_time) && $remaining_time > 0): ?>
        <p id="error-message">Incorrect Username/Password. Please wait <span id="countdown"><?php echo $remaining_time; ?></span> seconds before trying again.</p>
    <?php endif; ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var countdownElement = document.getElementById("countdown");
    var submitButton = document.getElementById("submit-button");
    if (countdownElement) {
        submitButton.disabled = true;
        var timeLeft = parseInt(countdownElement.textContent, 10);
        var timerId = setInterval(function() {
            timeLeft--;
            countdownElement.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(timerId);
                var errorMessage = document.getElementById("error-message");
                if (errorMessage) errorMessage.parentNode.removeChild(errorMessage);
                submitButton.disabled = false;
            }
        }, 1000);
    }
});
</script>



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
	
