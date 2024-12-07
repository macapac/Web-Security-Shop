<?php 
session_start();
?>
<?php
include 'header.php'; // Include header
?>
<div style="cursor: pointer;" class="content">
<p><a class="word" href="wallet.php">Your Wallet</a></p></div>
<div style="font-size: 16px; " class="footer">

<!-- Sign in button + text -->
<div style="cursor: pointer;" class="content">
<p><a class="word" href="login.php">SIGN IN</a></p></div>
<div style="font-size: 16px; " class="footer">
<p>You must be signed in your account to access the shop and to be able to purchase items.<p></div>
<!-- Create account button + text -->
<div style="cursor: pointer;" class="content">
<p><a  class="word" href="registration.php">CREATE ACCOUNT</a></p>
</div>
<div style="font-size: 16px; " class="footer">
  <p><a class="mini">New to AJ-Garments? Register an account with AJ-Garments today. Why create an account with us? Be the first in line to recieve special discounts and notified about exclusive sales in just a few taps. Creating an account is free! Create your account now by clicking option above.</a> </p>
  <p>&nbsp;</p>

</div>
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
* {
  box-sizing: border-box;
}
body {
  margin: 0;
  font-family: Arial;
  line-height: 1.5;
}
.footer {
  background-color: white;
  width: 750px;
}
.dropdown {
  position: relative;
  display: inline-block;
  margin: 20px;
  padding: 5px 10px;
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
.contwor {
	color: white;
	display: inline-block;
	font-size: 15px;
	font-family: Arial;
	text-decoration: none;
}
.content {
  background-color: black;
  width:  750px;
  padding: 5px 15px;
  text-align: center;
  margin-top: 30px;
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
  font-family: Arial;
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
  padding-left: 5px;
  background-color: black;
  margin: auto;
  font-size: 14px;
  line-height: 1.5;
  font-family: arial;
}
.center {
  background-color: white;
  text-align: center;
  font-size: 2.75em;
  font-family: Arial;
  margin-bottom: 50px;
}
</style>
