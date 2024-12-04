<?php
session_start();
include("auth_session.php");
include 'header.php'; // Include the header
require('db.php'); // Database connection

// Get the product ID and sanitize input
$var = htmlspecialchars($_GET['id'] ?? '', ENT_QUOTES, 'UTF-8');

// Fetch product details
$query = $con->prepare("SELECT * FROM products WHERE ItemName = ?");
$query->bind_param("s", $var);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();

// Handle invalid product ID
if (!$row) {
    echo "<h3>Product not found.</h3>";
    exit;
}

$stock = $row["Stock"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $var; ?> Details</title>
    <link rel="stylesheet" href="styles/item.css"> <!-- Link to the optimized CSS file -->
</head>


<body>
    <div class="product-details">
        <h1><?php echo $var; ?></h1>
        <div class="product-image">
            <img src="img/<?php echo $row['Image']; ?>" alt="<?php echo $var; ?>" width="490" height="490">
        </div>
        <div class="product-info">
            <p><strong>Brand:</strong> <?php echo $row["Brand"]; ?></p>
            <p><strong>Price:</strong> £<?php echo $row["Price"]; ?></p>
            <ul>
                <li><strong>Item:</strong> <?php echo $row["ItemName"]; ?></li>
                <li><strong>Colour:</strong> <?php echo $row["Colour"]; ?></li>
                <li><strong>Size:</strong> <?php echo $row["Size"]; ?></li>
                <li><strong>Stock:</strong> <?php echo $stock; ?></li>
            </ul>
        </div>

        <!-- Add to Cart Form -->
        <form action="" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?php echo $stock; ?>" required>
            <button type="submit">Add to Cart</button>
        </form>

        <!-- Buy Now and Back to Shop Buttons -->
        <div class="actions">
            <a href="checkout.php" class="btn">Buy It Now</a>
            <a href="shop.php" class="btn">Back to Shop</a>
        </div>
    </div>

    <?php
    // Handle adding to cart
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
        $quantity = (int) $_POST['quantity'];

        if ($quantity > 0 && $quantity <= $stock) {
            if (isset($_SESSION['cart'][$var])) {
                $newQuantity = $_SESSION['cart'][$var]['Quantity'] + $quantity;

                if ($newQuantity > $stock) {
                    echo "<div class='popup'>Invalid Quantity: Exceeds stock.</div>";
                } else {
                    $_SESSION['cart'][$var]['Quantity'] = $newQuantity;
                }
            } else {
                $_SESSION['cart'][$var] = [
                    'ID' => $row["ItemID"],
                    'Quantity' => $quantity,
                    'Price' => $row["Price"]
                ];
            }
        } else {
            echo "<div class='popup'>Invalid Quantity: Must be between 1 and $stock.</div>";
        }
    }
    ?>

    <script>
        // Close popup
        function closePopup() {
            document.querySelector('.popup').style.display = 'none';
        }
    </script>
</body>

</html>
