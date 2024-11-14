<?php
include("auth_session.php");
include 'header.php'; // Include the header
?>

<body>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
// passing the itemID to this page as a parameter
$var = $_GET['id'];
?>
<!-- Displaying the description of the item -->
  <div class="w3-row-padding w3-padding-16 w3-center" id="food">
    <div class="style-quarter">
	<h1><?php echo $var; ?></h1>
	<?php 
	error_reporting(0);
		require('db.php');
		$query = "SELECT * FROM products WHERE ItemName = '$var'";
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_array($result)) {
				$stock = $row["Stock"];
		?>
	<div class="w3-row-padding">
	<div class="w3-display-container">
	<div class ="styling">			
	<div class="pic"><?php echo "<img src='img/".$row['Image']."' id='myimage' height='490' width ='490'>"; ?> </div>  
	<div style="text-transform:uppercase; font-size: 20px;" class="w3-display-bottom w3-white w3-padding"><?php echo $row["Brand"]; ?>  </div>					
	<div style="font-weight: 700;" class="w3-display-bottom w3-white w3-padding"><p>£<?php echo $row["Price"]; ?> </p></div>
	<p>Tax Included.</p>
	<ol>
	<div class="w3-display-bottom w3-white w3-padding"><p>• <?php echo $row["ItemName"]; ?> </p> </div>
	<div class="w3-display-bottom w3-white w3-padding"><p>• Colour: <?php echo $row["Colour"]; ?> </p> </div>
	<div class="w3-display-bottom w3-white w3-padding"><p>• Size: <?php echo $row["Size"]; ?>  </p></div>
	<div class="w3-display-bottom w3-white w3-padding"><p>• Stock: <?php echo $stock; ?> </p> </div>
	<div class="w3-display-bottom w3-white w3-padding"><p>• Condition: <?php echo $row["Condition"]; ?>  </p></div>
	</ol>
    </div>
	</div>
	</div>
<?php
	}
?>
    </div>
	
	<?php 
	// quantity function
	require('db.php');
	// checks if the selected quantity that the user has chose is valid by checking the items stock in the database
	$query = "SELECT * FROM products WHERE ItemName = '$var'";
	$result = mysqli_query($con, $query);
	while ($item = mysqli_fetch_array($result)){
		if(isset($_POST['quantity']) && $_REQUEST['quantity'] > 0 && $_REQUEST['quantity'] <= $stock) {
			$quantity=$_REQUEST['quantity'] ;
			if(isset($_SESSION['cart'][$var])) {
				$_SESSION['cart'][$var]['Quantity'] += $quantity;
			}else{
				if ($_SESSION['cart'][$var]['Quantity'] + $quantity > $stock){
					echo "<div style='font-size:12px; font-family:sans-serif; text-align:center; padding: 40px; position:fixed; background-color:white; border-style: solid; border-color:black; margin-left:460px; margin-top:-300px;' class='mes'>
						  <h3>Invalid Quantity</h3>
						  <p>Click <a style='text-decoration:underline; 'href=''>Here</a> to return</p>
						  </div>";
				}else{
					$_SESSION['cart'][$var] = array('ID' => $item["ItemID"], 'Quantity' => $quantity, 'Price' => $item["Price"]);
				}
			}
		}else{
		}
	}
?>

<!-- Add to basket button, and quantity box-->
<form action="" style="cursor: pointer; font-color:#606060;" method="post" name="addtobasket">
	 <input  style="display:block; margin-left: 560px; margin-bottom:35px;" type="integer" name="quantity" value="1" size="2"/>	
	 <a style="text-decoration: none; font-weight: 700; letter-spacing:.08em; color: #606060; display: inline-block;"><input class="summary-checkout checkout-cta" type="submit" value="add to cart"/></a>
</form>  

<!-- Buy it now button-->
<div style="cursor: pointer;"class="summary-checkout">
<button type="submit" value="Checkout" class="checkout-ctar"><a style="text-decoration: none; font-weight: 700;letter-spacing:.08em; color: white;" href="checkout.php">Buy It Now</a></button>
</div>	
<p>&nbsp;</p>
<p>&nbsp;</p>
<!-- Back to shop button -->
<div style="cursor: pointer;">
<button class="backtoshop"><center><a style="text-decoration: none; font-weight: 700;letter-spacing:.08em; color: #3a3a3a;" href="shop.php" ><i class="arrow left"></i> Back To Shop</button><center></a>
</div>


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