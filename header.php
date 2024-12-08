<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web-Shop</title>
</head>
<body>
<header>
    <div class="navbar">
        <a href="dashboard.php"><img src="img/logoo.avif" alt="Logo" class="logo"></a> <!-- Link back to home and add logo -->
        <ul class="nav">
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="basket.php">Basket</a></li>
            <li><a href="Wallet.php">Wallet</a></li>
            <li><a href="account.php">Account</a></li>
        </ul>
    </div>
</header>



<?php
// Database configuration
$host = 'localhost';
$user = 'root'; // Default username for XAMPP
$password = ''; // Default password for XAMPP is empty
$database = 'mysql'; // Replace with your actual database name

// Create a connection
$con = mysqli_connect($host, $user, $password, $database);

?>

<style>

.navbar, .nav a, .dropdown-content a, h1, .backtoshop, .checkout-cta, .checkout-ctar, .summary-checkout, .header-logoee, .header-logoe, .word, .styling, .mes, .arrow, .pic {
    font-family: Arial, sans-serif;
}

  body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif !important; /* Using !important to override other styles */
    background-color: #f4f4f4; /* Light grey background for slight contrast */
}

.navbar {
    background-color: #ffffff; /* White background for the navbar */
    color: #000000; /* Black text for good contrast */
    display: flex;
    justify-content: space-between; /* Keeps logo on the left and nav items on the right */
    align-items: center;
    padding: 0px 15px; /* Adequate padding for spacing */
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow for a slight 3D effect */
}

.navbar .logo {
    width: 70px; /* Ensures the logo is not too large */
    height: auto;
    display: block;
}

.nav {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.nav li {
    margin-left: 20px; /* Ensures adequate spacing between navigation items */
}

.nav a {
    color: #000000; /* Black text for visibility */
    text-decoration: none; /* No underlines on links */
    padding: 8px 15px;
    font-size: 16px;
    letter-spacing: 1px; /* Stylish letter-spacing */
    transition: background-color 0.3s; /* Smooth transition for hover effects */
}

.nav a:hover {
    background-color: #e0e0e0; /* Light grey background on hover for subtle effect */
    color: #000000; /* Keeps text black on hover */
}

/* Responsive adjustments for mobile views */
@media (max-width: 768px) {
    .navbar {
        flex-direction: column;
        padding: 20px;
    }

    .nav {
        flex-direction: column;
        align-items: center;
        width: 100%;
    }

    .nav li {
        padding: 10px 0; /* Vertical padding when stacked in mobile view */
    }
}

/* footer section start */
*{
  -webkit-box-sizing:border-box;
  -moz-box-sizing:border-box;
  -o-box-sizing:border-box;
  -ms-box-sizing:border-box;
  box-sizing:border-box;
}
body{
  font-size:14px;
  background: #fff;
    max-width:1920px;
    margin:0 auto;
  overflow-x:hidden;
  font-family: poppins;
  

}
#footer{
  background: #f7f7f7;
    padding: 3rem;
  /* padding-top: 5rem; */
  padding-top: 7rem;
    padding-bottom: 80px;
  background-image: url(https://arena.km.ua/wp-content/uploads/3538533.jpg);
}
#footer2{
  background: #f7f7f7;
    padding: 3rem;
    margin-top: 0px;
  /* padding-top: 5rem; */
  padding-top: 7rem;
    padding-bottom: 80px;
  background-image: url(../images/cards/v748-toon-111.png);
}
.logo-footer{
  /* max-width: 300px; */
}
.social-links{
  /* display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center; */

}
.social-links h2{
  padding-bottom: 15px;
  font-size: 20px;
    font-weight: 600;
}
.social-links img{
  padding-bottom: 25px;
}
.social-icons{
  /* display: flex;
    gap: 3rem; */
  display: flex;
    flex-direction: column;
    gap: 1rem;
  color: #777777;
}
.social-icons a{
  /* font-size: 18px; */
    /* background: #ffffff; */
    /* box-shadow: rgb(0 0 0 / 8%) 0px 4px 12px;
    padding: 0.4rem 1rem 0.4rem 1rem;
    border-radius: 3px;
  color: #82074a; */
  /* margin-right: 18px; */
  color: #777777;
}
.social-icons a:hover{
  color: #000;
}
.social-icons a i{
  box-shadow: rgb(0 0 0 / 8%) 0px 4px 12px;
    padding: 0.4rem 1rem 0.4rem 1rem;
    border-radius: 3px;
    color: #82074a;
  font-size: 16px;
  margin-right: 12px;
}
li{
  list-style: none;
}
.useful-link h2{
  padding-bottom: 15px;
  font-size: 20px;
    font-weight: 600;
}
.useful-link img{
  padding-bottom: 15px;
}
.use-links{
  line-height: 32px;
}
.use-links li i{
  font-size: 14px;
    padding-right: 8px;
    color: #898989;
}
.use-links li a{
  color: #303030;
    font-size: 15px;
    font-weight: 500;
  color: #777777;
}
.use-links li a:hover{
  color: #000;
}
.address h2{
  padding-bottom: 15px;
  font-size: 20px;
    font-weight: 600;
}
.address img{
  padding-bottom: 15px;
}
.address-links li a{
  color: #303030;
    font-size: 15px;
    font-weight: 500;
  color: #777777;

}
.address-links li i{
  font-size: 16px;
    padding-right: 8px;
  color: #82074a;

}
.address-links li i:nth-child(1){
  padding-top: 9px;
}
.address-links .address1{
  font-weight: 500;
    font-size: 15px;
  display: flex;
}
.address-links{
      line-height: 32px;
    color: #777777;
}
.copy-right-sec{
  padding: 1.8rem;
    background: #82074a;
    color: #fff;
    text-align: center;
}
.copy-right-sec a{
  color: #fcd462;
    font-weight: 500;
}
a{
  text-decoration:none;
}

/* footer section end */


</style>