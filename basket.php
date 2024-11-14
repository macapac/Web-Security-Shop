<?php
include("auth_session.php");
include 'header.php'; // Include the header
?>

  <main>
  <!-- Row titles -->
        <ul>
          <li style="margin-left: 150px;" class="item item-heading">Item</li>
          <li style="margin-left: 250px;" class="price">Price</li>
        </ul>
      </div>

	<?php 
	//hides errors
	error_reporting(0);
	//removing items from the basket
    if(isset($_GET['remove']) && (!empty($_GET['remove'] || $_GET['remove'] ==0))){
		unset($_SESSION['cart'][$_GET['remove']]);
	}
	if(empty($_SESSION['cart'])) {
		//if cart is empty display the prices as 0
		$total = 0;
		$amount = 0;
		$no_items = 0;
		echo "<div class='messa'>
                  <h2>Your Basket Is Currently Empty</h2>
				  <p>&nbsp;</p>
				  <p>&nbsp;</p>
                  </div>";
	}else{
		//if not empty, intialising variables
		$total = 0;
		$amount = 0;
		$no_items = 0;
		foreach ($_SESSION['cart'] as $item => $x) {
			$amount = $x["Quantity"];
			$no_items += $amount;
			require('db.php');
			$query = "SELECT * FROM products WHERE ItemName = '$item'";
			$result = mysqli_query($con, $query);
			while($row = mysqli_fetch_array($result)) {
				$price = $row["Price"];
				$total = $total + ($price * $no_items);
		?>
		<!-- Displaying items in the basket -->
			<div class="w3-row-padding">
				<div class="w3-display-container">
					<div class ="styling">	
						<div class="basket-product" ><div class="item"><div class="product-image" >	
						<!-- Displaying item image -->						
						<div style="display: inline-block" class="pic"><?php echo "<img src='img/".$row['Image']."' id='myimage'  height='210' width ='220'>"; ?> </div>
						</div></div>
						<strong><div class="product-details item-quantity">
						<!-- Displaying item name -->	
						<div class="w3-display-bottom w3-white w3-padding"><p><?php echo $row["ItemName"]; ?> </p> </div>
						<!-- Displaying item size -->	
						<div class="w3-display-bottom w3-white w3-padding"><p>Size <?php echo $row["Size"]; ?>  </p></div>
						<!-- Displaying quantity -->
						<?php echo "<strong><div class='qua product-details'> <p>Quantity :</p>$amount</div></strong>";?>	
					<p>&nbsp;</p>
					<p>&nbsp;</p>
						<!-- Displaying remove button -->
						<?php echo '<div><a class="remov" href="?remove=' . $item . '">Remove</a></div>'; ?>
						</div>
						<div style="margin-left: 125px;" class="price"><p>£ <?php echo $row["Price"]* $amount; ?> </p></div></strong>
					</div>
				</div>
			</div>
			
			<?php
			}
		}
			
	}
	
	//making sure the decimal places for each price variable is the same
	$total = number_format($total, 2);
	$tax = number_format($tax, 2);
	$delivery = number_format($delivery, 2);
	$ftotal = number_format($ftotal, 2);
	//storing data into orders and orderline if the user clicks the submit button 
	$cust_id = $_SESSION['cust_id'];
	 if (isset($_POST['submitbutton'])){
        require('db.php');
        $query = "INSERT INTO orders (CustomerID, total) VALUES ($cust_id, $ftotal)";
		$result = mysqli_query($con, $query);
		$order_id = mysqli_insert_id($con);
		foreach($_SESSION['cart'] as $x => $val){
            $item_id = $val['ID'];
            $quantity = $val['Quantity'];
            $query = "INSERT INTO order_line (OrderID, ItemID, Quantity) VALUES ($order_id, $item_id, $quantity)";
			$result = mysqli_query($con, $query);
		}
		if ($result) {
			//re direct user to the checkout page if the purchase is succesful 
			echo'<script> window.location="checkout.php"; </script> ';
			//empty basket
			empty($_SESSION['cart']);
		}
	 }
	?>
	<!-- Price box-->
	<div class="summary">
        <div class="summary-total-items"><span class="total-items"></span> Items in your Bag (<?php echo $no_items ?>) </div>
        <div class="summary-subtotal">
          <div class="subtotal-title">Subtotal</div>
          <div class="subtotal-value final-value" id="basket-subtotal">£ <?php echo $total ; ?></div>
        </div>		
		<form method="post" name="purchase">
        <input type="submit" style="cursor: pointer;" class ="checkout-cta summary-checkout" name="submitbutton" value="Checkout" />
        </form>

	</main>
</p>
  </main>
</body>

</html>
<style>
h2 {
	font-size: 25px;
	color:black;
	font-weight:200;
	margin-left: -90px;
    padding-top: 30px;
}
.messa{
	margin-left: 435px;
	margin-top:150px;
    width: 1000px;
    padding: 0px 25px;
	position:absolute:
	font-size: 20px;	
}
.qua{
	margin-left:0px;
	margin-top:0px;
}
.product-details {
  padding: 0em;
  box-sizing: border-box;
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
.price{
	text-align: center:
}
.imag {
  display: block;
  margin-left: auto;
  padding-top: 0px;
  padding-left: 60px;
  padding-right: 0px;
}
.w10-padding-100 {
	padding-top: 0px;
	padding-bottom: 0px;
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
.dropdown {
  position: relative;
  display: inline-block;
  margin: 20px;
  padding: 5px 10px;
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
li {
  float: right;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  border: 1px #f4f4f4;
  background-color: #f4f4f4;
}
@charset "utf-8";
@import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700,600);
html,
html a {
  -webkit-font-smoothing: antialiased;
  text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.004);
}
body {
  background-color: #fff;
  color: #666;
  font-family: 'Open Sans', sans-serif;
  font-size: 62.5%;
  margin: 0 auto;
  line-height: 1.5;
}
strong {
  font-weight: bold;
}
p {
  margin: 0.75rem 0 0;
}
h1 {
  font-size: 0.75rem;
  font-weight: normal;
  margin: 0;
  padding: 0;
}
main {
  clear: both;
  font-size: 0.85rem;
  margin: 0 auto;
  overflow: hidden;
  padding: 1rem 0;
  width: 100%;
}
ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
li {
  color: #111;
  display: inline-block;
  padding: 0.5rem 0;
}
.item {
  width: 55%;
  margin-right: -350px;
}
.remove button {
  background-color: transparent;
  color: #777;
  float: none;
  text-decoration: underline;
  text-transform: uppercase;
}
.summary-checkout {
  display: block;
}
.checkout-cta {
  display: block;
  float: none;
  font-size: 0.75rem;
  text-align: center;
  text-transform: uppercase;
  padding: 0.625rem 0;
  width: 100%;
  background-color: #606060;
  color: white;
  padding:15px;
}
</style>