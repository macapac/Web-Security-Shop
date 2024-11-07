<?php 
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<body>
<!-- Navbar (sit on top) -->
	<ul class="nav">
	  <li><b><a href="logout.php">LOGOUT</a></b></li>
	  <li><b><a href="faq.php">FAQ</a></b></li>
	  <li><b><a href="basket.php">BASKET</a></b></li>
	  <li><b><a href="account.php">ACCOUNT</a></b></li>
	  <li><b><a href="shop.php">SHOP</a></b></li>
	  <li><b><a href="dashboard.php">HOME</a></b></li>
	  <li><a href="dashboard.php" style="padding:0px;"><img class="header-logo" src="img/logo.png" style="cursor:pointer; float:left; width:25%; padding-top: 3px; padding-bottom: 8px;"> </a> </li>
	</ul>
</body>
<body>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AJ-Garments l Shop</title>
<style>
body,h1,h2,h3,h4,h5,h6,p {font-family: "Raleway", sans-serif}
</style>
<head>
<!-- Stylesheets -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
</style>
<!-- Sidebar/menu -->
<nav class="sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:1;  position:absolute; bottom:10px;  width:200px; margin-top:125px; " id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
   <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
  </div>
 <!-- Filters -->
<td>
	<select class="dropdown" >
	<option selected disabled>Clothing</option>
	<option onclick="filterSelection('t-shirt')" value="t-shirt">T-shirt</option>
	<option onclick="filterSelection('hoodie')" value="hoodie">Hoodie</option>
	<option onclick="filterSelection('sweatshirt')" value="sweatshirt">Sweatshirt</option>
	<option onclick="filterSelection('jeans')" value="jeans">Jeans</option>
	<option onclick="filterSelection('accessories')" value="accessories">Accessories</option>
	</select>
</td>	
	<td>
	<select class="dropdown" >
    <option selected disabled>Brand</option>
	<option onclick="filterSelection('bape')" value="Bape">Bape</option>
	<option onclick="filterSelection('evisu')" value="Evisu">Evisu</option>
	<option onclick="filterSelection('dior')" value="Dior">Christian Dior</option>
	<option onclick="filterSelection('chrome')" value="Chrome">Chrome Hearts</option>
	<option onclick="filterSelection('billionaire boys club')" value="BBC">Billionaire Boys Club</option>
	<option onclick="filterSelection('prada')" value="prada">Prada</option>
	<option onclick="filterSelection('Comme Des Garçons')" value="Comme Des Garçons">Comme Des Garçons</option>
	</select>
	</td>		
	<td>
	<select class="dropdown" >
	<option selected disabled>Size</option>
	<option value="Onesize">One-Size</option>
	<option value="extrasmall">Extra Small</option>
	<option value="small">Small</option>
	<option value="medium">Medium</option>
    <option value="large">Large</option>
	<option value="extralarge">Extra Large</option>
	</select>
    </td>					
	<td>
	<select class="dropdown" >
	<option selected disabled>Price</option>
	<option value="0-100">£0-£100</option>
	<option value="100-200">£100-£200</option>
	<option value="200-300">£200-£300</option>
	<option value="300-350">£300-£350</option>
	</select>
	</td>				
  </div>
</nav>

<!-- Top header -->
<header class="w3-container w3-xlarge">
    <p style="font-family: sans-serif; font-size: 24px;"class="w3-left">Products</p>
	<div class="topnav">
  <div class="search-container">
    <form action="" method="GET" name="">
      <input type="text" placeholder="Search.." name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?> " style="width: 80%; ">
      <button type="submit" name="" ><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
    <p class="w3-right">
	 <!-- Basket icon redirect to basket page if clicked on -->
      <i><a href="basket.php" style="text-decoration: none; font-size: 25px;" class="fa fa-shopping-cart w3-margin-right"></a></i>
    </p>
  </header>
<?php 
	require('db.php');
	$query = "SELECT * FROM products";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_array($result)) {	
?>
<!-- Displaying the items in 3 rows -->
<div style="height:315px; width:280px; "class="table">
<div class="w3-row-padding">
<div style ="text-align: center;" class="w3-display-container">
<div class="w3-display-bottom w3-white w300-padding"><a href="item.php?id=<?php echo $row["ItemName"]; ?>"><?php echo "<img src='img/".$row['Image']."'height='235' width ='230'>"; ?></a> </div>
<div><a style="font-size:12px; color:#696969; text-decoration:none; margin-bottom:-15px" href="item.php?id=<?php echo $row["ItemName"]; ?>"><?php echo $row["Brand"]; ?></a></div>
<div><a style="font-size:14px; color: black; text-decoration:none; " href="item.php?id=<?php echo $row["ItemName"]; ?>"><?php echo $row["ItemName"]; ?></a></div>
<div style ="text-align: center; margin-top:-15px; padding-bottom:0px; font-size:17px; margin-bottom:0px;" class="w3-display-bottom w3-white w300-padding"><p>£<?php echo $row["Price"]; ?>  </p></div>
</div>
</div>
</div>
	
<?php
	}
?>
<!-- End page content -->
</div>
<p>&nbsp;</p>
<!-- Footer -->
<footer style =" margin: 0; padding: 0; text-align: left; width: 100%; list-style: none; height: 250px; float: left;" class="w3-bottomleft w3-black w10-padding-100">
<td>
<!-- Currency dropdown in footer -->
	<select class="dropdownfoot" >
	<option value="GBP">GBP £</option>
	<option value="EUR">EUR €</option>
	<option value="USD">USD $</option>
	<option value="CAD">CAD $</option>
	</select>
</td>
  <p><a class="header-logoe">AJ-GARMENTS</a></p>
    <p><a class="header-logoee">© 2021 </a></p>
<!-- Payment methods image -->
	<img src="img/bank.png" style="width:25%" class="imag" >
</footer>
</body>
</html>
<style>
.w300-padding{
	padding:0px;
}
.table{
	float: left;
	background: white;
	margin-bottom:40px;
}
.sidebar {
	padding-left: 0px;
	padding-right: 0px;
	padding-top: 0px;
	padding-bottom: 0px;
}
.topnav{
	float: right;
    position: absolute;
    left: 550px;
	font-size: 18px;
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
.search-container {
    padding-top: 25px;
	padding-bottom: 0px;
	padding-left: 5px;
	padding-right: 5px;
	width: 150%;
}
ul {
  list-style-type: none;
  text-align: center;
  margin: 0;
  overflow: hidden;
  border: 1px #f4f4f4;
  background-color: #f4f4f4;
  padding: 0;
}
ol {
  width: 650px;
  padding-top: 10px;
  padding-right: 135px;
  padding-bottom: 10px;
  padding-left: 10px;
  background-color: white;
  margin: auto;
  font-family: Amiri,serif;
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
li a:hover:not(.active) {
  background-color: #f4f4f4;
}
li a.active {
  color: black;
  background-color: rgba(244, 244, 244, 1);
}
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  line-height: 1.5;
}
.w3-padding-side { 
	padding-left: 30px;
	padding-right: 0px;
	padding-top: 55px;
	padding-bottom: 0px;
	text-align: left;
}
.dropbtn {
  background-color: #f4f4f4;
  color: black;
  padding: 5px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
  margin: 30px;
  padding: 10px 20px;
  border-color: white;
  border-width: 1px;
}
.dropdownfoot {
  position: relative;
  display: inline-block;
  margin: 20px;
  padding: 5px 10px;
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.dropdown-content a {
  color: black;
  padding: 5px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-content a:hover {background-color: #f1f1f1;}
.dropdown:hover .dropdown-content {
  display: block;
}
.dropdown:hover .dropbtn {
  background-color: #f1f1f1;
}
.w10-padding-100 {
	padding-top: 0px;
	padding-bottom: 0px;
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
.img {
	display: inline-block;
	vertical-align: middle;
}	
.w3-row-padding {
	padding: 12px;
}
.imag {
  display: block;
  margin-left: auto;
  padding-top: 0px;
  padding-left: 60px;
  padding-right: 0px;
}
</style>