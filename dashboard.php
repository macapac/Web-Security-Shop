<?php
include("auth_session.php");
?>
<?php
include 'header.php'; // Include header
?>

<a class="word" href="shop.php" style="padding:5px;" >VIEW COLLECTION</a></span>
</div>
</header>
<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px"></div>

<!-- Featured items -->
<div class="w3-container" id="featured items">
<h3 class="w3-border-bottom w3-border-light-grey w3-padding-15" style="text-align: center; fontfamily: sans-serif;">Featured Items</h3>
</div>
</div>
</div>
<?php
require('db.php');
$query = "SELECT * FROM Products LIMIT 8 OFFSET 10";
$result = mysqli_query($con, $query);
while($row = mysqli_fetch_array($result)) {
?>
<div style="height:315px; width:270px; "class="table">
<div class="w3-row-padding">
<div style ="text-align: center;" class="w3-display-container">
<div class="w3-display-bottom w3-white w300-padding"><a href="item.php?id=<?php echo
$row["ItemName"]; ?>"><?php echo "<img src='img/".$row['Image']."'height='235' width ='230'>";
?></a> </div>
<div><a style="font-size:12px; color:#696969; text-decoration:none; margin-bottom:-15px"
href="item.php?id=<?php echo $row["ItemName"]; ?>"><?php echo $row["Brand"]; ?></a></div>
<div><a style="font-size:14px; color:black; text-decoration:none; " href="item.php?id=<?php echo
$row["ItemName"]; ?>"><?php echo $row["ItemName"]; ?></a></div>
<div style ="text-align: center; margin-top:-15px; padding-bottom:15px; font-size:17px; marginbottom:0px;" class="w3-display-bottom w3-white w300-padding"><p>£<?php echo $row["Price"];?> </p></div>
</div>
</div>
</div>
<?php
}
?>
<p>&nbsp;</p>

<!-- Description boxes -->
<div class="w3-row-padding">
 <div class="w3-col l3 m6 w3-margin-bottom">
 <img src="img/et.jpg" alt="John" style="width:100%">
 <h3>Spring Summer 2021 Fabrics</h3>
 <p>SS21 continues efforts towards producing sustainable clothing, with the use of natural dyeing
processes and organic fabrics without the use of harmful pesticides, as well as utilising fabrics 100%
recycled from waste material.</p>
 </div>
 <div class="w3-col l3 m6 w3-margin-bottom">
 <img src="img/pharrell.jpg" alt="Jane" style="width:100%;">
 <h3>Pharrell Williams Billionaire Boys Club</h3>
 <p>In 2005, Pharrell partnered with Japanese fashion icon Nigo to create the streetwear brands
Billionaire Boys Club and Ice Cream footwear. In 2008, Pharrell co-designed a series of eyewear and
jewellery for Louis Vuitton and had a collaboration with Takashi Murakami.</p>
 </div>
 <div class="w3-col l3 m6 w3-margin-bottom">
 <img src="img/er.jpg" alt="Mike" style="width:100%">
 <h3>New Arrivals On The Way SS21</h3>
 <p>Shop Our New Range Of Items Online - Explore the Collection Now at AJ-Garments! New items
are rolling in, Create an account to get notified when new items are in stock. With Free Shipping to
the UK!</p>
 </div>
 <div class="w3-col l3 m6 w3-margin-bottom">
 <img src="img/fabric.jpg" alt="Dan" style="width:100%">
 <h3>Quality Guarentee</h3>
 <p>Quality is at the heart of everything we do. We ensure that your standards are met and
exceeded all the time, every time. Because we pride ourselves on our extremely high standards of
service, we are continually monitoring our performance and updating our knowledge to ensure we
are on top of all the latest developments in our industry.</p>
 </div>
 </div>
 <!—About us Section -->
 <div class="w10-container w3-padding-32" id="about">
 <h3 class="w3-border-bottom w3-border-light-grey w12-padding-16" >OUR MISSION</h3>
 <p>AJ-Garments exists for the love of fashion. We believe in spreading fashion culture. Our
mission is to be the global platform for High-end fashion, connecting creators, curators and
consumers. </p>
 </div>

 <div class="image-container">
 <span class="helper"></span>
 <img src="img/ter.jpg" alt="PHOTO">
 </div>
 <body>
<?php
//connect to db using the db script
 require('db.php');
 // When web page form submitted, insert values into the database.
if (isset($_REQUEST['name'])) {
 $name = $_REQUEST['name'];
 $name = mysqli_real_escape_string($con, $name);
 $email = $_REQUEST['email'];
 $email = mysqli_real_escape_string($con, $email);
 $message = $_REQUEST['message'];
 $message = mysqli_real_escape_string($con, $message);
$insertquery = "INSERT into `contact` (name, email, message)
VALUES ('$name', '$email', '$message')";
$result = mysqli_query($con, $insertquery); //execute the query
echo'<script> window.location="contactmessage.php"; </script> ';
}else{?>
	<p>&nbsp;</p>
	 <!-- Contact Section -->
	 <form class="form" action="" method="post">
	 <div class="w3-container w3-padding-32" id="contact">
	 <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16" style="font-family: sansserif;">Contact Us</h3>
	 <p style="color: rgba(122, 122, 122, 1)" class="padding2">If you have any queries or if we can be of
	any further assistance please contact us. We will respond within 24 hours.</p>
	 <input class="w3-input w3-section w3-border" type="text" name="name" placeholder="Name"
	required>
	 <input class="w3-input w3-section w3-border" type="text" name="email" placeholder="Email"
	required>
	 <input class="w3-input w3-section w3-border" type="text" name="message"
	placeholder="Message" required>
	 <input type="submit" name="submit" value="Send" class="send-button">
	 </div>
	 </form>
	<p>&nbsp;</p>
	<?php
	}
	?>

</body>
</html>

<style>
.style-quarter{
  padding-left: 20px;
  padding-right: 20px;
  padding-top: 5px;
  padding-bottom: 20px;
  margin-left: 500px;
  margin-right: 0px;
}
.mes{
	margin-left:100px
}
.img-magnifier-glass {
  position: absolute;
  border-radius: 50%;
  cursor: none;
  width: 100px;
  height: 100px;
}
.left {
  transform: rotate(135deg);
  -webkit-transform: rotate(135deg);
}
.arrow {
  border: solid black;
  border-width: 0 2px 2px 0;
  display: inline-block;
  padding: 3px;
}
body{
	line-height:1.5;
}
.pic{
	left: 0px;
    width: 100px;
    height: 120px;
	position: absolute;
	margin-top: -50px;
}
.styling {
    font-family: sans-serif;
	font-size: 17px;
	font-weight: 400;
	line-height: 1.5;
	margin-left:30px;
	color:black;
}
ol {
  padding-right: 5px;
  padding-left: 5px;
  background-color: white;
  margin-left: 0px;
  font-family: sans-serif;
  font-weight: 400;
  font-size: 15px;
  line-height: 1.5;
}
.backtoshop{
  display: block;
  float: none;
  font-size: 13px;
  font-family:Amiri,serif;
  text-align: center;
  text-transform: uppercase;
  padding: 15px 10px;
  width: 20%;
  background-color:#fff;
  border-color#3a3a3a;
  border-radius: 2px; 
  border-width: 1px;
  cursor: pointer;
  margin-left:450px;	
}
.summary-checkout {
  display: block;
  width:42%;
  padding-left: 5px;
  padding-right: 5px;
  line-height:1.4;
  margin-left: 550px;
  margin-right: 250px;
  margin-bottom:10px;
  cursor: pointer;
}
.checkout-cta {
  display: block;
  float: none;
  font-size: 15px;
  color:#606060;
  font-family:Amiri,serif;
  text-align: center;
  text-transform: uppercase;
  padding: 15px 10px;
  width: 100%;
  background-color:#fff;
  border-color:#606060;
  border-radius: 2px; 
  border-width: 1px;
  cursor: pointer;
  font-weight: 700;
  width:48%;
  padding-left: 10px;
}
.checkout-ctar {
  display: block;
  float: none;
  font-size: 15px;
  font-family:Amiri,serif;
  text-align: center;
  text-transform: uppercase;
  padding: 15px 10px;
  width: 100%;
  background-color: #606060;
  border-color#3a3a3a;
  border-radius: 2px;  
  border: 1px solid transparent;
  cursor: pointer;
  margin-left:-5px;
}
body{
	margin: 0px;
}
#logo{
	padding-top: 3px;
	padding-bottom: 8px;
	cursor:pointer;
	float:left;
	width:25%;
}
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 5px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}
.dropdown {
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
	padding-left: 20px;
	padding-top: 0px;
	background-color: black;
	float: left;
	text-decoration: none;
	font-family: arial;
}
.w3-padding-50 {
	padding-top: 50px;
	padding-bottom: 50px;
}	
.w3-padding-100 {
	padding-top: 0px;
	padding-bottom: 250px;
}
.w3-padding-15{
	padding-top: 30px;
	padding-bottom: 16px;
}
.w4-padding {
	padding-top:0px ;
	padding-bottom:0px;
	padding-left: 15px;
}	
.w10-container {
	text-align: center;
	padding-bottom: 26px;
	padding-left: 100px;
	padding-right: 100px;
}
.w12-padding-16 {
	padding: 48px;
	font-size:40px;
	font-weight: 400;
	margin-bottom: 0px;
	font-family: sans-serif;
	line-height: 1;
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
h1 {
	font-family: sans-serif;
	font-size:28px;
	color: black;
	font-weight: 300;
	margin-left:30px;
}		
.header-logo {
    padding-top: 3px;
	padding-bottom: 8px;
}
.word {
	color: white;
	display: inline-block;
	font-size: 20px;
	text-decoration: none;
	text-align: center;
	letter-spacing: 2px;
	cursor: pointer;
}
.imag {
  display: block;
  margin-left: auto;
  padding-top: 0px;
  padding-left: 60px;
  padding-right: 0px;
}

</style>
</body>