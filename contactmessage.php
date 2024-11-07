<?php 
session_start();
?> 
<!DOCTYPE html>
<html>
<title>AJ-Garments l HomePage</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<!-- Navbar (sit on top) -->
	<ul class="nav">
	  <li><b><a href="logout.php">LOGOUT</a></b></li>
	  <li><b><a href="faq.php">FAQ</a></b></li>
	  <li><b><a href="basket.php">BASKET</a></b></li>
	  <li><b><a href="account.php">ACCOUNT</a></b></li>
	  <li><b><a href="shop.php">SHOP</a></b></li>
	  <li><b><a href="dashboard.php">HOME</a></b></li>
	<li><a href="dashboard.php" style="padding:0px;"><img class="header-logo" src="img/logo.png" style="cursor:pointer; float:left; width:25%;"> </a> </li>
	</ul>	
	<!-- Message -->
	<p><div style="text-align: center; padding-top: 20px;" class='form'>
	<h3>Your message was received. Our staff will review and reply within 24 hours.</h3><br/>
	<p class='link'>Click here to <a href='shop.php'>Shop</a></p>
	</div>	
</html>
<style>
body{
	line-height:1.5;
}
#logo{
	padding-top: 3px;
	padding-bottom: 8px;
	cursor:pointer;
	float:left;
	width:25%;
}
.nav li {
  display: inline-block;
  font-size: 15px;
  padding-top: 10px;
  padding-bottom: 10px;
  background-color: #f4f4f4;
  letter-spacing: 0.5px;
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
.img {
	display: inline-block;
vertical-align: middle;
	}
</style>