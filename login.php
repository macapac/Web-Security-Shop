<?php
session_start();
include 'header.php'; // Include the header
require('db.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    // Sanitize and escape input to prevent SQL Injection
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = md5($password); // Encrypt password

    // Check for valid user credentials
    $query = "SELECT * FROM `customers` WHERE username=? AND password=?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $username, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Process login result
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $username;
        $_SESSION['cust_id'] = $row['CustomerID'];

        echo "<div class='form'>
                <span>Welcome, <b>" . htmlspecialchars($_SESSION['username']) . "</b>!</span>
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
    // Display login form
?>
    <div class="center">
        <p>SIGN IN</p>
    </div>
    <div class="form">
        <form method="post" name="login">
            <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true" required />
            <input type="password" class="login-input" name="password" placeholder="Password" required />
            <input type="submit" value="Login" name="submit" class="login-button" />
            <p class="link"><a href="registration.php">Register Account</a></p>
        </form>
    </div>
<?php
}
?>
