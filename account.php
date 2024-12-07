<?php 
session_start();
include 'header.php'; // Include header
$username = $_SESSION['username'] ?? 'Guest'; // Default to 'Guest' if not set
?>

<div class="container">
  <div class="avatar-flip">
    <img src="img/user.webp" height="150" width="150">
    <img src="img/user.webp" height="150" width="150">
  </div>
  <h2><?php echo htmlspecialchars($username); ?></h2>
  <h4>Account</h4>
  <div class="button-container"><a href="wallet.php">Your wallet</a></div>
  <div class="button-container"><a href="logout.php">Logout</a></div>
</div>




<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:900,300);
body {
  background-color: #f0f0f0;
  font-family: roboto;
}
.container {
  width: 400px;
  margin: 20px auto 120px;
  background-color: #fff;
  padding: 0 20px 20px;
  border-radius: 6px;
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  -webkit-box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  -moz-box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  text-align: center;
}
.container:hover .avatar-flip {
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
}
.container:hover .avatar-flip img:first-child {
  opacity: 0;
}
.container:hover .avatar-flip img:last-child {
  opacity: 1;
}
.avatar-flip {
  border-radius: 100px;
  overflow: hidden;
  height: 150px;
  width: 150px;
  position: relative;
  margin: auto;
  top: -10px; /* Reduced from -60px to -30px to decrease the gap */
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  box-shadow: 0 0 0 13px #f0f0f0;
  -webkit-box-shadow: 0 0 0 13px #f0f0f0;
  -moz-box-shadow: 0 0 0 13px #f0f0f0;
}
.avatar-flip img {
  position: absolute;
  left: 0;
  top: 0;
  border-radius: 100px;
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
}
.avatar-flip img:first-child {
  z-index: 1;
}
.avatar-flip img:last-child {
  z-index: 0;
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
  opacity: 0;
}
h2 {
  font-size: 32px;
  font-weight: 600;
  margin-bottom: 15px;
  color: #333;
}
h4 {
  font-size: 13px;
  color: #00baff;
  letter-spacing: 1px;
  margin-bottom: 25px
}
p {
  font-size: 16px;
  line-height: 26px;
  margin-bottom: 20px;
  color: #666;
}


.button-container a {
  display: inline-block;
  padding: 10px 20px;
  margin: 5px 0; /* Spacing between buttons */
  background-color: #007BFF; /* A nice blue shade for button background */
  color: #ffffff; /* White text */
  border-radius: 5px; /* Rounded corners */
  text-decoration: none; /* Remove underline from links */
  transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effects */
}

.button-container a:hover {
  background-color: #0056b3; /* Darker shade of blue on hover */
  color: #ffffff; /* Maintain white text on hover */
}

.container {
  width: 400px;
  margin: 20px auto;
  background-color: #fff;
  padding: 20px;
  border-radius: 6px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.075);
  text-align: center;
}

.avatar-flip {
  border-radius: 100px;
  overflow: hidden;
  height: 150px;
  width: 150px;
  position: relative;
  margin: auto;
  top: -10px;
  box-shadow: 0 0 0 13px #f0f0f0;
}

.avatar-flip img {
  position: absolute;
  left: 0;
  top: 0;
  border-radius: 100px;
}

h2, h4, p {
  margin-bottom: 15px;
  color: #333;
}

h4 {
  color: #00baff;
  letter-spacing: 1px;
}

p {
  font-size: 16px;
  line-height: 26px;
  color: #666;
}

</style>
