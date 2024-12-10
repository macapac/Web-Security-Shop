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

	//Adding here CSRF protection:
	if (!isset($_SESSION['csrf_token'])) {
		$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
	}

	if (isset($_GET['remove'])) {
		$remove = filter_var($_GET['remove'], FILTER_SANITIZE_STRING);
		if (!empty($remove)) {
			unset($_SESSION['cart'][$remove]);
		}
	}
	if (empty($_SESSION['cart'])) {
		//if cart is empty display the prices as 0
		$total = 0;
		$amount = 0;
		$no_items = 0;
		echo "<div class='messa'>
               <h2>Your Basket Is Currently Empty</h2>
			  		<p>&nbsp;</p>
			  		<p>&nbsp;</p>
            </div>";
	} else {
		//if not empty, intialising variables
		$total = 0;
		$amount = 0;
		$no_items = 0;
		foreach ($_SESSION['cart'] as $item => $x) {
			$amount = $x["Quantity"];
			$no_items += $amount;
			require('db.php');

			$stmt = $con->prepare("SELECT * FROM products WHERE ItemName = ?");
			$stmt->bind_param("s", $item);
			$stmt->execute();
			$result = $stmt->get_result();

			while ($row = $result -> fetch_assoc()) {
				$price = $row["Price"];
				$total = ($price * $no_items);
				?>
				<!-- Displaying items in the basket -->
				<div class="w3-row-padding">
					<div class="w3-display-container">
						<div class="styling">
							<div class="basket-product">
								<div class="item">
									<div class="product-image">
										<!-- Displaying item image -->
										<div style="display: inline-block" class="pic">
											<?php echo "<img src='img/" . htmlspecialchars($row['Image'], ENT_QUOTES, 'UTF-8') . "' id='myimage'  height='210' width ='220'>"; ?>
										</div>
									</div>
								</div>
								<strong>
									<div class="product-details item-quantity">
										<!-- Displaying item name -->
										<div class="w3-display-bottom w3-white w3-padding">
											<p><?php echo htmlspecialchars($row["ItemName"], ENT_QUOTES, 'UTF-8'); ?> </p>
										</div>
										<!-- Displaying item size -->
										<div class="w3-display-bottom w3-white w3-padding">
											<p>Size <?php echo htmlspecialchars($row["Size"], ENT_QUOTES, 'UTF-8'); ?> </p>
										</div>
										<!-- Displaying quantity -->
										<?php echo "<strong><div class='qua product-details'> <p>Quantity :</p>$amount</div></strong>"; ?>
										<p>&nbsp;</p>
										<p>&nbsp;</p>
										<!-- Displaying remove button -->
										<?php echo '<div><a class="remov" href="?remove=' . $item . '">Remove</a></div>'; ?>
									</div>
									<div style="margin-left: 125px;" class="price">
										<p>£ <?php echo htmlspecialchars($row["Price"] * $amount, ENT_QUOTES, 'UTF-8'); ?> </p>
									</div>
								</strong>
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
	if (isset($_POST['submitbutton'])) {
		require('db.php');

		$stmt_order = $con->prepare("INSERT INTO orders (CostumerID, total) VALUES (?, ?)");
		$stmt_order->bind_param("id", $cust_id, $total);
		$stmt_order->execute();
		$order_id = $con->insert_id;

		foreach ($_SESSION['cart'] as $x => $val) {
			$item_id = $val['ID'];
			$quantity = $val['Quantity'];

			$stmt_outerline = $con->prepare("INSERT INTO order_line (OrderID, ItemID, Quantity) VALUES (?, ?, ?)");
			$stmt_outerline->bind_param("iii", $order_id, $item_id, $quantity);
			$stmt_outerline->execute();
		}
		if ($stmt_order && $stmt_outerline) {
			//re direct user to the checkout page if the purchase is succesful 
			echo '<script> window.location="payment.php"; </script> ';
			//empty basket
			empty($_SESSION['cart']);
		}
	}
	?>
		<!-- Price box-->
		<div class="summary">
			<div class="summary-total-items"><span class="total-items"></span> Items in your Bag
				(<?php echo $no_items ?>) </div>
			<div class="summary-subtotal">
				<div class="subtotal-title">Total</div>
				<div class="subtotal-value final-value" id="basket-subtotal">£ <?php echo $ftotal; ?></div>
			</div>
			<form method="post" name="purchase">
				<input type="submit" style="cursor: pointer;" class="checkout-cta summary-checkout" name="submitbutton"
					value="Pay" />
			</form>

</main>
</body>
</html>