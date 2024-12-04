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
    <style>
      /* Styling for the popup close button */
      .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 16px;
        font-weight: bold;
        color: black;
        cursor: pointer;
      }

      .mes {
        position: fixed;
        background-color: white;
        border-style: solid;
        border-color: black;
        padding: 40px;
        width: 300px;
        margin-left: 460px;
        margin-top: -300px;
        text-align: center;
        font-family: sans-serif;
      }
    </style>
  </head>

  <div class="w3-row-padding w3-padding-16 w3-center" id="food">
    <div class="style-quarter">
      <h1><?php echo $var; ?></h1>

      <?php
      if ($row) {
        $stock = $row["Stock"];
        ?>
        <div class="w3-row-padding">
          <div class="w3-display-container">
            <div class="styling">
              <div class="pic">
                <?php echo "<img src='img/" . $row['Image'] . "' id='myimage' height='490' width ='490'>"; ?>
              </div>
              <div style="text-transform:uppercase; font-size: 20px;" class="w3-display-bottom w3-white w3-padding">
                <?php echo $row["Brand"]; ?>
              </div>
              <div style="font-weight: 700;" class="w3-display-bottom w3-white w3-padding">
                <p>£<?php echo $row["Price"]; ?> </p>
              </div>
              <ol>
                <div class="w3-display-bottom w3-white w3-padding">
                  <p>• <?php echo $row["ItemName"]; ?> </p>
                </div>
                <div class="w3-display-bottom w3-white w3-padding">
                  <p>• Colour: <?php echo $row["Colour"]; ?> </p>
                </div>
                <div class="w3-display-bottom w3-white w3-padding">
                  <p>• Size: <?php echo $row["Size"]; ?> </p>
                </div>
                <div class="w3-display-bottom w3-white w3-padding">
                  <p>• Stock: <?php echo $stock; ?> </p>
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

      // Check if requested quantity is valid
      if ($quantity > 0 && $quantity <= $stock) {
        // Check if the item already exists in the cart
        if (isset($_SESSION['cart'][$var])) {
          $newQuantity = $_SESSION['cart'][$var]['Quantity'] + $quantity;

          // Ensure new quantity does not exceed stock
          if ($newQuantity > $stock) {
            echo "<div class='mes' id='errorPopup'>
                    <span class='close-btn' onclick='closePopup()'>×</span>
                    <h3>Invalid Quantity</h3>
                    <p>The total quantity in cart exceeds available stock. Please choose a lower quantity.</p>
                  </div>";
          } else {
            $_SESSION['cart'][$var]['Quantity'] = $newQuantity;
          }
        } else {
          // Add item to cart if it doesn't exist yet
          $_SESSION['cart'][$var] = array('ID' => $row["ItemID"], 'Quantity' => $quantity, 'Price' => $row["Price"]);
        }
      } else {
        echo "<div class='mes' id='errorPopup'>
                <span class='close-btn' onclick='closePopup()'>×</span>
                <h3>Invalid Quantity</h3>
                <p>The quantity must be between 1 and available stock. Please adjust and try again.</p>
              </div>";
      }
    }
    ?>

    <!-- Add to basket button, and quantity box-->
    <form action="" method="post" name="addtobasket">
      <input style="display:block; margin-left: 560px; margin-bottom:35px;" type="number" name="quantity" value="1"
        min="1" max="<?php echo $stock; ?>" size="2" />
      <input class="summary-checkout checkout-cta" type="submit" value="Add to Cart"
        style="cursor: pointer; font-color:#606060;" />
    </form>

    <!-- Buy it now button -->
    <div style="cursor: pointer;" class="summary-checkout">
      <button type="submit" value="Checkout" class="checkout-ctar"><a href="checkout.php"
          style="text-decoration: none; font-weight: 700;letter-spacing:.08em; color: white;">Buy It Now</a></button>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <!-- Back to shop button -->
    <div style="cursor: pointer;">
      <button class="backtoshop"><a href="shop.php"
          style="text-decoration: none; font-weight: 700;letter-spacing:.08em; color: #3a3a3a;"><i
            class="arrow left"></i> Back To Shop</a></button>
    </div>

    <!-- JavaScript to close the popup -->
    <script>
      function closePopup() {
        document.getElementById('errorPopup').style.display = 'none';
      }
    </script>
</body>

</html>