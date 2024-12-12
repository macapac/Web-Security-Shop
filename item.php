<?php
include("auth_session.php");
include 'header.php'; // Include the header
require('db.php'); // Database connection

// Passing the itemID to this page as a parameter
if (isset($_GET['id'])) {
    $var = $_GET['id'];
    $stmt = $con->prepare("SELECT * FROM products WHERE ItemName = ?");
    $stmt->bind_param("s", $var);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} else {
    header("Location: shop.php");
    exit();
}
?>

<body>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
    </head>

    <div class="w3-row-padding w3-padding-16 w3-center" id="food">
        <div class="style-quarter">
            <h1><?php echo htmlspecialchars($var, ENT_QUOTES, 'UTF-8'); ?></h1>

            <?php
            if ($row) {
                $stock = $row["Stock"];
                ?>
                <div class="w3-row-padding">
                    <div class="w3-display-container">
                        <div class="styling">
                            <div class="pic">
                                <?php echo "<img src='img/" . htmlspecialchars($row['Image'], ENT_QUOTES, 'UTF-8') . "' id='myimage' height='490' width ='490'>"; ?>
                            </div>
                            <div style="text-transform:uppercase; font-size: 20px;" class="w3-display-bottom w3-white w3-padding">
                                <?php echo htmlspecialchars($row["Brand"], ENT_QUOTES, 'UTF-8'); ?>
                            </div>
                            <div style="font-weight: 700;" class="w3-display-bottom w3-white w3-padding">
                                <p>£<?php echo number_format($row["Price"], 2); ?></p>
                            </div>
                            <ol>
                                <div class="w3-display-bottom w3-white w3-padding">
                                    <p>• <?php echo htmlspecialchars($row["ItemName"], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                                <div class="w3-display-bottom w3-white w3-padding">
                                    <p>• Colour: <?php echo htmlspecialchars($row["Colour"], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                                <div class="w3-display-bottom w3-white w3-padding">
                                    <p>• Size: <?php echo htmlspecialchars($row["Size"], ENT_QUOTES, 'UTF-8'); ?></p>
                                </div>
                                <div class="w3-display-bottom w3-white w3-padding">
                                    <p>• Stock: <?php echo $stock; ?></p>
                                </div>
                            </ol>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <?php
        // Handling quantity and cart update
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
            $quantity = (int) $_POST['quantity'];

            // Validate the quantity input
            if ($quantity > 0 && $quantity <= $stock) {
                if (isset($_SESSION['cart'][$row['ItemID']])) {
                    // Increment quantity if the item is already in the cart
                    $_SESSION['cart'][$row['ItemID']]['quantity'] += $quantity;
                } else {
                    // Add item to cart
                    $_SESSION['cart'][$row['ItemID']] = [
                        'ItemName' => $row['ItemName'],
                        'Price' => $row['Price'],
                        'quantity' => $quantity
                    ];
                }
                echo "<script>alert('Item added to cart!');</script>";
            } else {
                echo "<script>alert('Invalid quantity. Please select a valid amount.');</script>";
            }
        }
        ?>

        <!-- Add to basket form -->
        <form action="" method="post" name="addtobasket">
            <input style="display:block; margin-left: 560px; margin-bottom:35px;" type="number" name="quantity" value="1"
                   min="1" max="<?php echo $stock; ?>" size="2" />
            <input class="summary-checkout checkout-cta" type="submit" value="Add to Cart"
                   style="cursor: pointer; font-color:#606060;" />
        </form>

        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <!-- Back to shop button -->
        <div style="cursor: pointer;">
            <button class="backtoshop"><a href="shop.php"
                                          style="text-decoration: none; font-weight: 700;letter-spacing:.08em; color: #3a3a3a;"><i
                        class="arrow left"></i> Back To Shop</a></button>
        </div>

        <script>
            function closePopup() {
                document.getElementById('errorPopup').style.display = 'none';
            }
        </script>
</body>
</html>
