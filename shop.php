<?php
include("auth_session.php");
include 'header.php'; // Include the header
?>

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
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
  $search = "%" . trim($_GET['search']) . "%";
  $query = "SELECT * FROM products WHERE ItemName LIKE ?";
    $stmt = $con -> prepare($query);
    $stmt -> bind_param("s", $search);
    $stmt -> execute();
    $result = $stmt -> get_result();
  } else {
    $result = $con -> query($query);
  }
	while($row = mysqli_fetch_array($result)) {	
?>
<!-- Displaying the items in 3 rows -->
<div style="height:315px; width:280px; "class="table">
<div class="w3-row-padding">
<div style ="text-align: center;" class="w3-display-container">
<div class="w3-display-bottom w3-white w300-padding"><a href="item.php?id=<?php echo htmlspecialchars($row["ItemName"], ENT_QUOTES, 'UTF-8'); ?>"><?php echo "<img src='img/" . htmlspecialchars($row['Image'], ENT_QUOTES, 'UTF-8') . "'height='235' width ='230'>"; ?></a> </div>
<div><a style="font-size:12px; color:#696969; text-decoration:none; margin-bottom:-15px" href="item.php?id=<?php echo htmlspecialchars($row["ItemName"], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($row["Brand"], ENT_QUOTES, 'UTF-8'); ?></a></div>
<div><a style="font-size:14px; color: black; text-decoration:none; " href="item.php?id=<?php echo htmlspecialchars($row["ItemName"], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($row["ItemName"], ENT_QUOTES, 'UTF-8'); ?></a></div>
<div style ="text-align: center; margin-top:-15px; padding-bottom:0px; font-size:17px; margin-bottom:0px;" class="w3-display-bottom w3-white w300-padding"><p>£<?php echo htmlspecialchars($row["Price"], ENT_QUOTES, 'UTF-8'); ?>  </p></div>
</div>
</div>
</div>
	
<?php
	}
?>
<!-- End page content -->
</div>

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