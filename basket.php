<?php
include("auth_session.php");
include 'header.php'; // Include the header
require('db.php'); // Include the database connection

// Initialize basket if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle removing an item from the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    $itemID = $_POST['item_id'];
    unset($_SESSION['cart'][$itemID]);
}

// Handle checkout process
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    // Fetch wallet details
    $stmt = $con->prepare("SELECT * FROM wallets WHERE CustomerID = ?");
    $stmt->bind_param("i", $_SESSION['CustomerID']);
    $stmt->execute();
    $result = $stmt->get_result();
    $wallet = $result->fetch_assoc();

    if (!$wallet) {
        echo "<script>alert('No wallet found. Please create one.');</script>";
        exit;
    }

    $totalCost = 0;

    // Calculate total cost
    foreach ($_SESSION['cart'] as $itemID => $cartItem) {
        $stmt = $con->prepare("SELECT * FROM Products WHERE ItemID = ?");
        $stmt->bind_param("i", $itemID);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        if (!$product || $product['Stock'] < $cartItem['quantity']) {
            echo "<script>alert('Insufficient stock for " . $product['ItemName'] . "');</script>";
            exit;
        }

        $totalCost += $product['Price'] * $cartItem['quantity'];
    }

    if ($wallet['Balance'] < $totalCost) {
        echo "<script>alert('Insufficient balance. Please top up your wallet.');</script>";
        exit;
    }

    // Deduct balance from wallet and update stock
    $newBalance = $wallet['Balance'] - $totalCost;
    $stmt = $con->prepare("UPDATE wallets SET Balance = ? WHERE WalletID = ?");
    $stmt->bind_param("di", $newBalance, $wallet['WalletID']);
    $stmt->execute();

    foreach ($_SESSION['cart'] as $itemID => $cartItem) {
        $stmt = $con->prepare("UPDATE Products SET Stock = Stock - ? WHERE ItemID = ?");
        $stmt->bind_param("ii", $cartItem['quantity'], $itemID);
        $stmt->execute();
    }

    // Add transaction to blockchain
    $transaction = [
        'sender' => $wallet['WalletAddress'],
        'recipient' => 'SHOP',
        'amount' => $totalCost
    ];
    $ch = curl_init('http://localhost:5001/transactions/new');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($transaction));
    $response = curl_exec($ch);
    curl_close($ch);

    // Mine the block
    $ch = curl_init("http://localhost:5001/mine");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);

    // Clear the cart
    $_SESSION['cart'] = [];
    echo "<script>alert('Purchase successful!'); window.location.href='shop.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="basket-container">
    <h1>Your Basket</h1>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your basket is empty. <a href="shop.php">Go back to shop</a>.</p>
    <?php else: ?>
        <table class="basket-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grandTotal = 0;
                foreach ($_SESSION['cart'] as $itemID => $cartItem):
                    $stmt = $con->prepare("SELECT * FROM Products WHERE ItemID = ?");
                    $stmt->bind_param("i", $itemID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $product = $result->fetch_assoc();
                    if (!$product) continue;

                    $itemTotal = $product['Price'] * $cartItem['quantity'];
                    $grandTotal += $itemTotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['ItemName']); ?></td>
                        <td><?php echo $cartItem['quantity']; ?></td>
                        <td>£<?php echo number_format($product['Price'], 2); ?></td>
                        <td>£<?php echo number_format($itemTotal, 2); ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="item_id" value="<?php echo $itemID; ?>">
                                <button type="submit" name="remove">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><strong>Grand Total:</strong> £<?php echo number_format($grandTotal, 2); ?></p>
        <form method="post">
            <button type="submit" name="checkout">Checkout</button>
        </form>
    <?php endif; ?>
</div>
=======
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

			while ($row = $result->fetch_assoc()) {
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
				<div class="subtotal-value final-value" id="basket-subtotal">£ <?php echo $total; ?></div>
			</div>
			<!-- Add the blockchain checkout button -->
			<form action="checkout.php" method="get">
				<button type="submit" class="checkout-cta summary-checkout">Proceed to Checkout</button>
			</form>
		</div>


</main>
  
</body>
</html>

<style>
.basket-container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    text-align: center;
}

.basket-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.basket-table th, .basket-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

.basket-table th {
    background-color: #f2f2f2;
}

button {
    padding: 8px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
</style>
